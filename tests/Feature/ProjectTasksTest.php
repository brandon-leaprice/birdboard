<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
   use RefreshDatabase;

    /** @test */
    function guests_cannot_add_tasks()
    {
        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }


    /** @test */
    function only_the_owner_of_the_project_may_add_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', $attributes = ['body' => 'Test Task'])
            ->assertStatus(403);


        $this->assertDatabaseMissing('tasks', $attributes);
    }

    /** @test */
    function only_the_owner_of_the_project_may_update_tasks()
    {

        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks[0]->path(), $attributes = ['body' => 'changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $attributes);
    }

   /** @test */
   public function a_project_can_have_tasks()
   {

       $project = ProjectFactory::create();

       $this->actingAs($project->owner)->post($project->path() . '/tasks', ['body' => 'Test Task']);

       $this->get($project->path())
           ->assertSee('Test Task');
   }

    /** @test */
    function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), $attributes =[
                'body' => 'changed',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', $attributes);
    }

   /** @test */
    public function a_task_can_be_completed()
    {

        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), $attributes = [
            'body' => 'Changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    /** @test */
    public function a_task_can_be_incomplete()
    {

        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path(),  [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->patch($project->tasks[0]->path(), $attributes = [
            'body' => 'changed',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', $attributes);
    }

   /** @test */
    public function a_task_requires_a_body()
    {

        $project = ProjectFactory::create();

        $attributes = Task::factory()->raw(['body' => '']);

        $this->actingAs($project->owner)->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');

    }


}
