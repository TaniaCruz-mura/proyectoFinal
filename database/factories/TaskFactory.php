<?php
 
namespace Database\Factories;
 
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
 
class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['pendiente', 'en_progreso', 'completada']),
            'priority' => fake()->randomElement(['baja', 'media', 'alta']),
            'due_date' => fake()->dateTimeBetween('now', '+2 months'),
            'assignee_id' => User::factory(),
        ];
    }
}
