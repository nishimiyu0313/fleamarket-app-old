<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Item;



class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'user_id' => 2,
            'item_id' => 1,
            'content' => 'コンビニ払い',
            'postal_code' => '123-4567',
            'address' => '東京都新宿区',
            'building' => '新宿ビル101号室',
        ]);
        Payment::create([
            'user_id' => 2,
            'item_id' => 2,
            'content' => 'カード払い',
            'postal_code' => '234-5678',
            'address' => '大阪市中央区',
            'building' => '大阪ビル202号室',
        ]);
    }
}
