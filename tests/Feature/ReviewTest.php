<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Review;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_user_can_list_all_resto() {
        $count = 5;
        Review::factory()->count($count)->create();

        $user = User::factory()->createOne();
        Sanctum::actingAs($user);

        $this->getJson(route('reviews.index')) 
            ->assertOk()
            ->assertJsonCount($count);
    }

    public function test_user_can_create_resto() {
        $data = Review::factory()->makeOne()->toArray();

        
        $user = User::factory()->createOne();
        Sanctum::actingAs($user);


        $this->postJson(route('reviews.store'), $data) 
            ->assertCreated()
            ->assertJsonStructure(array_keys($data));
    }

    public function test_user_can_show_resto() {
        $data = Review::factory()->createOne();
        

    
        $user = User::factory()->createOne();
        Sanctum::actingAs($user);

        $this->getJson(route('reviews.show', $data))     
            ->assertOk()
            ->assertJsonStructure(array_keys($data->toArray()));
    }

    public function test_user_can_edit_resto() {
        $updatedData = Review::factory()->makeOne()->toArray();
        $data = Review::factory()->createOne();

        
        $user = User::factory()->createOne();
        Sanctum::actingAs($user);

        $this->patchJson(route('reviews.update', $data), $updatedData)
            ->assertOk()
            ->assertJsonStructure(array_keys($updatedData));
    }

    public function test_user_can_delete_resto() {
        
        $data = Review::factory()->createOne();

        
        $user = User::factory()->createOne();
        Sanctum::actingAs($user);

        $this->deleteJson(route('reviews.destroy', $data))
            ->assertOk()
            ->assertJsonStructure(array_keys($data->toArray()));
    }
}
