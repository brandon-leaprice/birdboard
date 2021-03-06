<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectsTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $project = Project::factory()->create();


        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    /** @test */
    public function it_belongs_to_a_owner()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf('App\Models\User', $project->owner);
    }

    /** @test */
    public function it_can_add_task()
    {
        $project = Project::factory()->create();

        $project->addTask('Test Task');

        $this->assertCount(1, $project->tasks);
    }

    /** @test */
    public function it_can_invite_a_user()
    {
        $project = Project::factory()->create();

        $project->invite($user = User::factory()->create());

        $this->assertTrue($project->members->contains($user));
    }

}
