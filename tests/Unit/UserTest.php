<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_projects()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    public function a_user_has_invited_project()
    {
        $user = $this->signIn();

        $user2 = User::factory()->create();

        ProjectFactory::ownedBy($user)->create();

        $this->assertCount(1, $user->allProjects());


        ProjectFactory::ownedBy($user2)->create()->invite($user);

        $this->assertCount(2, $user->allProjects());


    }

}
