<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\User;
use App\Models\Comment;
use App\Models\Profile;



class DetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_商品詳細に必要な情報が表示される()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $condition = Condition::factory()->create();
        $category = Category::factory()->create();

        // 商品を作成（カテゴリや状態もセット）
        $item = Item::factory()->create([
            'name' => '青いりんご',
            'brand_name' => 'Apple Inc.',
            'price' => 1000,
            'description' => '新鮮な青いりんごです。',
            'condition_id' => $condition->id,
            
            'image' => 'sample.jpg',
        ]);

        $item->categories()->attach($category->id);

        // いいね数やコメントを作成（例）
        $likeUsers = User::factory()->count(3)->create();
        foreach ($likeUsers as $likeUser) {
            $likeUser->likedItems()->attach($item->id);
        }

        // コメントを2件作成、ユーザーも紐づける
        $commentUsers = User::factory()->count(2)->create();

        foreach ($commentUsers as $commentUser) {

            Profile::factory()->create([
                'user_id' => $commentUser->id,
                'name' => 'テストユーザー',
            ]);

            Comment::factory()->create([
                'item_id' => $item->id,
                'user_id' => $commentUser->id,
                'content' => 'コメントテスト',
            ]);
        }

        // 商品詳細ページにアクセス（認証が必要なら actingAs）
        $response = $this->actingAs($user)->get('/item/' . $item->id);

        // 画像タグのsrcチェック（画像表示）
        $response->assertSee('sample.jpg');

        // 商品名、ブランド名、価格、説明
        $response->assertSee('青いりんご');
        $response->assertSee('Apple Inc.');
        $response->assertSee('1000');
        $response->assertSee('新鮮な青いりんごです。');

        // 商品情報（カテゴリ名、商品の状態）
        $response->assertSee($category->name);
        $response->assertSee($condition->name);

        // いいね数（数字だけ）
        $response->assertSee('3');

        // コメント数（2）
        $response->assertSee('2');

        // コメント内容とコメントユーザー名
        foreach ($commentUsers as $commentUser) {
            $response->assertSee($commentUser->profile->name);
            $response->assertSee('コメントテスト');
        }
    }
    public function test_複数選択されたカテゴリが表示されているか()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'name' => 'テスト商品',
            'user_id' => $user->id,
            'image' => 'sample.jpg',
            'condition_id' => $condition->id,
        ]);

        $categories = Category::factory()->count(3)->create([
            // nameだけ自動でもOK
        ]);
      

        // 複数カテゴリを紐づける
        $item->categories()->attach($categories->pluck('id'));

        // 商品詳細ページへアクセス
        $response = $this->actingAs($user)->get('/item/' . $item->id);

        // 各カテゴリ名が表示されていることを確認
        foreach ($categories as $category) {
        
            $response->assertSee($category->content);
        }
    }
    }
