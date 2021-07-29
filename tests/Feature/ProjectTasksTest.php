<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   public function a_project_can_have_tasks()
   {
       $this->signIn();

       $project = Project::factory()->create(['owner_id' => \Auth::id()]);

       $this->post($project->path() . '/tasks', ['body' => 'Test Task']);

       $this->get($project->path())
           ->assertSee('Test Task');
   }

   /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = Project::factory()->create(['owner_id' => \Auth::id()]);

        $attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');

    }

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

        $this->post($project->path() . '/tasks', ['body' => 'Test Task'])
            ->assertStatus(403);


        $this->assertDatabaseMissing('tasks', ['body' => 'Test Task']);
    }
}
