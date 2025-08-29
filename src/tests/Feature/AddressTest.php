<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\User;

class AddressTest extends TestCase 
{

    use RefreshDatabase;

    public function test_送付先住所変更画面にて登録した住所が商品購入画面に反映されている()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // プロフィール（住所情報）作成・更新
        $profileData = [
            'name' => 'テストユーザー',
            'postal_code' => '123-4567',
            'address' => '東京都新宿区西新宿2-8-1',
            'building' => '新宿ビル101',
            'image' => '',
        ];
        $user->profile()->updateOrCreate([], $profileData);

        // 商品（購入対象）作成
        $condition = Condition::factory()->create();
        $item = Item::factory()->create(['condition_id' => $condition->id]);

        // 購入画面にアクセス（ログインユーザーとして）
        $response = $this->actingAs($user)->get("/purchase/{$item->id}");

        // ステータス200で表示成功をチェック
        $response->assertStatus(200);

        // 住所が画面に含まれているかチェック
        $response->assertSee($profileData['postal_code']);
        $response->assertSee($profileData['address']);
        $response->assertSee($profileData['building']);
    }
    }