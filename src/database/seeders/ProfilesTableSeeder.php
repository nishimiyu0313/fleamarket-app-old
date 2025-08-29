<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'user_id' => 1,
            'name' => '山田太郎',
            'postal_code' => '123-4567',
            'address' => '東京都新宿区',
            'building' => '新宿ビル101号室',
            'image' => 'sample/profilesample.jpg'
        ]);
        Profile::create([
            'user_id' => 2,
            'name' => '山田次郎',
            'postal_code' => '123-4567',
            'address' => '東京都新宿区',
            'building' => '新宿ビル101号室',
            'image' => 'sample/profilesample.jpg'
        ]);
    }
}
