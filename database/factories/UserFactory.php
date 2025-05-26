<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => fake()->name(),
            'apellidos' => fake()->lastName(),
            'cedula' => fake()->unique()->numerify('###########'),
            'sexo' => fake()->randomElement(['M', 'F']),
            'nacionalidad' => fake()->country(),
            'telefono' => fake()->phoneNumber(),
            'direccion' => fake()->address(),
            'pais' => fake()->country(),
            'estado' => fake()->state(),
            'ciudad' => fake()->city(),
            'rol' => 3, // 3: Usuario cliente
            'foto' => '/assets/img/avatar.png',
            'estatus' => true, // true: activo
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
