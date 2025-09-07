<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Condition;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_いいねアイコンを押下することによって、いいねした商品として登録することができる()
    {
        /** @var \App\Models\User $user */

        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'condition_id' => $condition->id,
            'user_id' => $user->id,
        ]);


        $response = $this->actingAs($user)->post("/item/{$item->id}/like");

        $response->assertStatus(302);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
     }

    public function test_追加済みのアイコンは色が変化する()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'condition_id' => $condition->id,
        ]);

        
        $user->likedItems()->attach($item->id);


        $response = $this->actingAs($user)->get("/item/{$item->id}");

       
        $response->assertSee('unlike-submit');
    }

    public function test_再度いいねアイコンを押下することによって、いいねを解除することができる()
    {
        /** @var \App\Models\User $user */

        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'condition_id' => $condition->id,
            'user_id' => $user->id,
        ]);

        $user->likedItems()->attach($item->id);


        $response = $this->actingAs($user)->delete("/item/{$item->id}/unlike");

        $response->assertStatus(302);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
    
}
