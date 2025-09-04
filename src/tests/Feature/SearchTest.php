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

    public function test_検索キーワードがマイリストでも保持されている()
    {
        /** @var \App\Models\User $user */
        
        $user = User::factory()->create();

        // 2つの商品を作成：1つは「バッグ」、1つは「靴」
        $bag = Item::factory()->create([
            'name' => 'バッグ',
        ]);
        $shoes = Item::factory()->create([
            'name' => '革靴',
        ]);

        // バッグだけをお気に入り登録（マイリスト）
        $user->favorites()->attach($bag->id);

        // 検索キーワード「バッグ」で商品一覧にアクセス
        $response = $this->actingAs($user)->get('/items?keyword=バッグ');
        $response->assertStatus(200);
        $response->assertSeeText('バッグ');
        $response->assertDontSeeText('革靴');

        // 同じキーワードでマイリストページにもアクセス
        $response = $this->actingAs($user)->get('/mylist?keyword=バッグ');
        $response->assertStatus(200);

        // 検索結果に「バッグ」は含まれるが、「靴」は含まれない
        $response->assertSeeText('バッグ');
        $response->assertDontSeeText('革靴');
    }
}
