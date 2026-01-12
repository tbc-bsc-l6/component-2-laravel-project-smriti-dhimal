<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    protected $model = Module::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'module' => fake()->words(3, true),
            'available' => fake()->boolean(80),
            'teacher_id' => null,
        ];

    }

    public function available() : static
    {
        return $this->state(fn (array $attributes)=>[
            'available'=> true,
        ]);
    }

    public function unavailable() : static
    {
        return $this->state(fn (array $attributes)=>[
            'available'=> false,
        ]);
    }
}