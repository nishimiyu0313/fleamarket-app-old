<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            ['user_id' => '1', 'name' => '腕時計', 'brand_name' => '', 'price' => '15000', 'description' => 'スタイリッシュなデザインのメンズ腕時計', 'image' => 'img/Clock.jpg', 'condition_id' => '1'],
            ['user_id' => '1', 'name' => 'HDD', 'brand_name' => '', 'price' => '5000', 'description' => '高速で信頼性の高いハードディスク', 'image' => 'img/Disk.jpg', 'condition_id' => '2'],
            ['user_id' => '1', 'name' => '玉ねぎ3束', 'brand_name' => '', 'price' => '300', 'description' => '新鮮な玉ねぎ3束のセット', 'image' => 'img/onion.jpg', 'condition_id' => '3'],
            ['user_id' => '1', 'name' => '革靴', 'brand_name' => '', 'price' => '4000', 'description' => 'クラシックなデザインの革靴', 'image' => 'img/Shoes.jpg', 'condition_id' => '4'],
            ['user_id' => '1', 'name' => 'ノートPC', 'brand_name' => '', 'price' => '45000', 'description' => '高性能なノートパソコン', 'image' => 'img/Laptop.jpg', 'condition_id' => '1'],
            ['user_id' => '1', 'name' => 'マイク', 'brand_name' => '', 'price' => '8000', 'description' => '高音質のレコーディング用マイク', 'image' => 'img/Mic.jpg', 'condition_id' => '2'],
            ['user_id' => '1', 'name' => 'ショルダーバッグ', 'brand_name' => '', 'price' => '3500', 'description' => 'おしゃれなショルダーバッグ', 'image' => 'img/pocket.jpg', 'condition_id' => '3'],
            ['user_id' => '1', 'name' => 'タンブラー', 'brand_name' => '', 'price' => '500', 'description' => '使いやすいタンブラー', 'image' => 'img/Tumbler.jpg', 'condition_id' => '4'],
            ['user_id' => '1', 'name' => 'コーヒーミル', 'brand_name' => '', 'price' => '4000', 'description' => '手動のコーヒーミル', 'image' => 'img/Grinder.jpg', 'condition_id' => '1'],
            ['user_id' => '1', 'name' => 'メイクセット', 'brand_name' => '', 'price' => '2500', 'description' => '便利なメイクアップセット', 'image' => 'img/makeup.jpg', 'condition_id' => '2'],
        ]);
    }
}
