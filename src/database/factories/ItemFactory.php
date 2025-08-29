<?php

namespace Database\Factories;

use app\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'condition_id' => 1, // 条件に合わせて適切な値に
            'name' => $this->faker->word(),
            'brand_name' => $this->faker->company(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(1000, 100000),
            'image' => 'sample.jpg', // テスト用に仮の画像ファイル名
            'is_sold' => false,
        ];
    }
}
