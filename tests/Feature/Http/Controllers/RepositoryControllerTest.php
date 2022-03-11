<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Repository;
use App\Models\User;

class RepositoryControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    public function test_guest()
    {
        $this->get('repositories')->assertRedirect('login');        //index
        $this->get('repositories/1')->assertRedirect('login');      //show
        $this->get('repositories/1/edit')->assertRedirect('login'); //edit
        $this->put('repositories/1')->assertRedirect('login');      //update
        $this->delete('repositories/1')->assertRedirect('login');   //destroy
        $this->get('repositories/create')->assertRedirect('login'); //create
        $this->post('repositories',[])->assertRedirect('login');    //store

    }
    
    public function test_store(){
        $data = [
            'url' => $this->faker->url,
            'descripcion' => $this->faker->text,
        ];
        
        $user = User::factory()->create();
        
        $this
            ->actingAs($user)
            ->post('repositories',$data)
            ->assertRedirect('repositories');
            
        $this->assertDatabaseHas('repositories', $data);
    }
    
    public function test_update(){
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);
        $data = [
            'url' => $this->faker->url,
            'descripcion' => $this->faker->text,
        ];
        
        
        $this
            ->actingAs($user)
            ->put("repositories/$repository->id",$data)
            ->assertRedirect("repositories/$repository->id/edit");
        
            
        $this->assertDatabaseHas('repositories', $data);
    }

    public function test_update_policy()
    {
        $user = User::factory()->create();              //id = 1
        $repository = Repository::factory()->create();  //user_id = 2
        $data = [
            'url' => $this->faker->url,
            'descripcion' => $this->faker->text,
        ];

        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", $data)
            ->assertStatus(403);    //403 Forbiden

    }

    public function test_destroy()
    {
        $repository = Repository::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->delete("repositories/$repository->id")
            ->assertRedirect('repositories');


        $this->assertDatabaseMissing('repositories',[
            'id' => $repository->id,
            'url' => $repository->url,
            'descripcion' => $repository->descripcion,
        ]);
    }


    //Validate Tests
    
    public function test_validate_store()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('repositories', [])
            ->assertStatus(302)
            // ->assertRedirect()
            ->assertSessionHasErrors(['url', 'descripcion']);
    }

    public function test_validate_update()
    {
        $repository = Repository::factory()->create();
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['url', 'descripcion']);

    }
}
