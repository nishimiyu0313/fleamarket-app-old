<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Condition;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class ItempurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_「購入する」ボタンを押下すると購入が完了する()
    {
        /** @var \App\Models\User $user */

        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);
        $condition = Condition::factory()->create();
        Profile::factory()->create([
            'user_id' => $user->id,
            'postal_code' => '123-4567',
            'address' => '東京都新宿区',
            'building' => 'サンプルビル101',
        ]);
        $item = Item::factory()->create([
            'condition_id' => $condition->id,
            'is_sold' => false,
        ]);
        //dump('作成されたアイテムID:', $item->id);
        

        // 購入処理をPOSTで実行（ログイン済みユーザーとして）
        $response = $this->actingAs($user)->post("/purchase/{$item->id}", [
            'content' => 'カード払い',
            'postal_code' => '123-4567',
            'address' => '東京都新宿区',
            'building' => 'サンプルビル101',

        ]);
        //$response->dump();
        //dump('モデル上のis_sold:', $item->is_sold);
        
        // 処理後はリダイレクトを想定（例: 商品詳細ページなど）
        $response->assertStatus(302);
        $response->assertRedirect("/");
        //dump($response->headers->get('Location'));
       // $item->refresh();
        $this->assertDatabaseHas('payments', [
            'item_id' => $item->id,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'is_sold' => 1,
        ]);//$this->assertTrue($item->is_sold);
    }

    public function test_購入済み商品は商品一覧で_sold_と表示される()
    {
        /** @var \App\Models\User $user */

        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);
        $condition = Condition::factory()->create();

        // 未購入商品を作成
        $item = Item::factory()->create([
            'condition_id' => $condition->id,
            'is_sold' => false,
        ]);

        // 商品購入
        $this->actingAs($user)->post("/purchase/{$item->id}", [
            'content' => 'カード払い',
            'postal_code' => '123-4567',
            'address' => '東京都新宿区',
            'building' => 'サンプルビル101',
        ]);

        // 商品一覧ページにアクセス
        $response = $this->get('/');

        // レスポンス内に「sold」の表示があるか確認
        $response->assertStatus(200);
        $response->assertSeeText('Sold');
    }

    public function test_購入した商品がプロフィール購入履歴に表示される()
    {
        /** @var \App\Models\User $user */

        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'condition_id' => $condition->id,
            'is_sold' => false,
            'name' => 'テスト商品A', // 表示確認用
        ]);

        // 購入処理
        $this->actingAs($user)->post("/purchase/{$item->id}", [
            'content' => 'カード払い',
            'postal_code' => '123-4567',
            'address' => '東京都新宿区',
            'building' => 'サンプルビル101',
        ]);

        // 購入後、「プロフィール/購入した商品一覧」にアクセス
        $response = $this->actingAs($user)->get('/mypage/buy');

        // ステータスと商品タイトルの表示を確認
        $response->assertStatus(200);
        $response->assertSeeText('テスト商品A');
    }
}
 