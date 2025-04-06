<?php

namespace Database\Factories;

use App\Models\Csoki;
use Illuminate\Database\Eloquent\Factories\Factory;

class CsokiFactory extends Factory
{
    protected $model = Csoki::class;

    public function definition()
    {
        return [
            'nev' => $this->faker->word, // Random name
            'ara' => $this->faker->numberBetween(100, 5000), // Random price
            'raktaron' => $this->faker->boolean, // Random stock status
        ];
    }
}