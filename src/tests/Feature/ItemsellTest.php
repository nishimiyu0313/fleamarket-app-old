<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Item;
use  Illuminate\Support\Facades\Storage;


class ItemsellTest extends TestCase
{
    use RefreshDatabase;

    public function test_商品出品画面にて必要な情報が保存できること（カテゴリ、商品の状態、商品名、商品の説明、販売価格）()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        Storage::fake('public');
        $file = UploadedFile::fake()->create('dummy.jpeg', 100, 'image/jpeg');

        $condition = Condition::factory()->create();
        



        $category = Category::factory()->create();
        // 送信するフォームデータ（カテゴリ、状態、名前、説明、価格）
        $data = [
            'name' => 'テスト商品',
            'description' => 'これはテスト用の商品です',
            'image' => $file,        
            'price' => 1500,
            'category' => [$category->id],
            'condition' => 1,

        ];
        //dd($data);


        // 商品出dd($condition->id);品用のPOSTリクエストを送る（ルートは適宜変更してね）
        $response = $this->post('/sell', $data);

        // リダイレクトなど成功のレスポン/sellスを確認        // 多くは保存後リダイレクトされるので302期待
        $response->assertRedirect('/');   // 例えば商品一覧ページにリダイレクトされる想定


        // DBに保存されているかを確認
        $this->assertDatabaseHas('items', [
            'name' => 'テスト商品',
            'description' => 'これはテスト用の商品です',
            'condition_id' => 1,
            'price' => 1500,
        ]);
        $item = Item::where('name', 'テスト商品')->first();

        // $this->assertDatabaseHas('category_item', [
        //     'item_id' => $item->id,
        //     'category_id' => $category->id,
        // ]);
        $this->assertCount(1, Storage::disk('public')->files('images'));
    }
    }