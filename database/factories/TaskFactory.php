<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_date = Carbon::now();
        $end_date = $start_date->copy()->addDays(60);
        return [
            'name' => fake()->word(),
            'description' => fake()->text(),
            'status' => fake()->boolean(),
            'image' => fake()->imageUrl(350, 350),
            'date' => fake()->dateTimeBetween($start_date, $end_date),
            'id_user' => User::pluck('id')->random(),
        ];
    }
}
