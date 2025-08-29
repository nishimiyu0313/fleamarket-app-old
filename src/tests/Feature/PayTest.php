<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Condition;


class PayTest extends TestCase
{
    use RefreshDatabase;

    public function test_小計画面で変更が即時反映される()
    {
        /** @var \App\Models\User $user */

        $user = User::factory()->create();

        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'price' => 1000,
            'condition_id' => $condition->id,
        ]);

        \App\Models\Payment::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'postal_code' => '123-4567',
            'address' => '東京都新宿区西新宿2-8-1',
            'building' => '新宿ビル101',
        ]);

        $response = $this->actingAs($user)->get("/purchase/{$item->id}");

        $response->assertStatus(200);
        $response->assertSee('1000');  
        $response->assertSee('カード払い'); 
    }
    }