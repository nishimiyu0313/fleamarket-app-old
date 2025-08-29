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
        dump('作成されたアイテムID:', $item->id);
        

        // 購入処理をPOSTで実行（ログイン済みユーザーとして）
        $response = $this->actingAs($user)->post("/purchase/{$item->id}", [
            'content' => '購入コメントなど任意の文字列',
        ]);
        $response->dump();
        //dump('モデル上のis_sold:', $item->is_sold);
        
        // 処理後はリダイレクトを想定（例: 商品詳細ページなど）
        $response->assertStatus(302);
        $response->assertRedirect("/");
        //dump($response->headers->get('Location'));
        $item->refresh();

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'is_sold' => 1,
        ]);
        // DB上で購入済みに更新されていることを確
        //dump('モデル上のis_sold:', $item->is_sold);
        //dump($isSoldFromDb);

        $this->assertTrue($item->is_sold);
        //dump($item->is_sold);    // ← これに変更（止まらない）
       // $response->dump();
     
       

       
        //$this->assertTrue($item->is_sold);
    }

    public function test_購入処理が成功するとフラグが立つ()
    {

        /** @var \App\Models\User $user */

        $user = User::factory()->create();
        $condition = Condition::factory()->create();

        $item = Item::factory()->create([
            'condition_id' => $condition->id,
            'is_sold' => false
        ]);

        $this->actingAs($user)->post("/purchase/{$item->id}");

        $item->refresh();
        $this->assertTrue($item->is_sold);
    }
}
 