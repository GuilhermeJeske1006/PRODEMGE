<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adress>
 */
class AdressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo_endereco' => fake()->boolean(),
            'estado' => fake()->state(), // 'SP
            'cep' => fake()->postcode(),
            'logradouro' => fake()->address(),
            'bairro' => fake()->address(),
            'cidade' => fake()->address(),
            'complemento' => fake()->address(),
            'numero' => fake()->numerify(),
            'user_id' => fake()->numberBetween(
                $min = 1,
                $max = 10
            ),
        ];
    }
}
