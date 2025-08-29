<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Condition;
use App\Models\User;


class SearchTest extends TestCase
{
    public function test_「商品名」で部分一致検索ができる()
    {
        /** @var \App\Models\User $user */

        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        Item::factory()->create(['name' => '青いりんご', 'condition_id' => $condition->id]);
        Item::factory()->create(['name' => '赤いりんご', 'condition_id' => $condition->id]);
        Item::factory()->create(['name' => 'バナナ', 'condition_id' => $condition->id]);

        $response = $this->actingAs($user)->get('/item/search?keyword=りんご');

        $response->assertSee('青いりんご');
        $response->assertSee('赤いりんご');

        $response->assertDontSee('バナナ');
    }

   
}
