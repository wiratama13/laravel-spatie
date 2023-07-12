<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCanShowRole(): void
    {
        $user = User::role('IT')->get()->random();

        $this->actingAs($user);
        
        // url
        $this->get('/roles')
            ->assertOk();
    }

    public function testCannotShowRole()
    {
        $user = User::role('staff')->get()->random();
        $this->actingAs($user)

        // url
        ->get('roles')
        ->assertStatus(403);
    }

    public function testShowRoleNotLogin()
    {
    
        $this->get('roles')
            ->assertRedirect('login')
            ->assertStatus(302);
    
    }

    public function testCanCreateRole()
    {
        $user = User::role('it')->get()->random();
            $this->actingAs($user);
        $this->get('/roles/create')
            ->assertOk();
    }

    public function testCannotCreateRole()
    {
        $user = User::role('staff')->get()->random();
        $this->actingAs($user);
        $this->get('/roles/create')
            ->assertStatus(403)
            ->assertSeeText('unauthorized.');
    }

    public function testCannotCreateRoleNotLogin()
    {
        $this->get('roles/create')
            ->assertRedirect('login')
            ->assertStatus(302);
    }
}
