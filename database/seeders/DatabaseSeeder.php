<?php
 
namespace Database\Seeders;
 
use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
 
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory()->count(6)->create();
 
        $project = Project::factory()->create([
            'owner_id' => $users->first()->id,
        ]);
 
        $project->members()->attach($users->pluck('id'), ['project_role' => 'colaborador']);
 
        $tasks = Task::factory()->count(8)->create([
            'project_id' => $project->id,
        ]);
 
        foreach ($tasks as $task) {
            Comment::factory()->count(2)->create(['task_id' => $task->id]);
        }
    }
}
