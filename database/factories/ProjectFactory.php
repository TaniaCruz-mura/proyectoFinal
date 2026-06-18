<?php
 
namespace Database\Factories;
 
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
 
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->catchPhrase(),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['activo', 'pausado', 'finalizado']),
            'owner_id' => User::factory(),
        ];
    }
}
