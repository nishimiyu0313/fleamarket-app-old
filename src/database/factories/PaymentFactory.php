<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\Item;
use app\Models\User;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'item_id' => Item::factory(),
            'content' => $this->faker->sentence,
            'postal_code' => '123-4567',
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'status' => \App\Models\Payment::STATUS_COMPLETED,
        ];
    }
}
