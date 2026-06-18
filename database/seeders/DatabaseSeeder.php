<?php
 
namespace Database\Seeders;
 
use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
 
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);
 
        $admin = User::factory()->create([
            'name' => 'Admin General',
            'email' => 'admin@gestorpro.test',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');
 
        $lider = User::factory()->create([
            'name' => 'Lider Demo',
            'email' => 'lider@gestorpro.test',
            'password' => Hash::make('password'),
        ]);
        $lider->assignRole('lider');
 
        $colaborador = User::factory()->create([
            'name' => 'Colaborador Demo',
            'email' => 'colaborador@gestorpro.test',
            'password' => Hash::make('password'),
        ]);
        $colaborador->assignRole('colaborador');
 
        $invitado = User::factory()->create([
            'name' => 'Invitado Demo',
            'email' => 'invitado@gestorpro.test',
            'password' => Hash::make('password'),
        ]);
        $invitado->assignRole('invitado');
 
        $project = Project::factory()->create([
            'name' => 'Rediseno Web Institucional',
            'owner_id' => $lider->id,
        ]);
 
        $project->members()->attach($lider->id, ['project_role' => 'lider']);
        $project->members()->attach($colaborador->id, ['project_role' => 'colaborador']);
        $project->members()->attach($invitado->id, ['project_role' => 'invitado']);
 
        $tasks = Task::factory()->count(8)->create([
            'project_id' => $project->id,
            'assignee_id' => $colaborador->id,
        ]);
 
        foreach ($tasks as $task) {
            Comment::factory()->count(2)->create([
                'task_id' => $task->id,
                'user_id' => $colaborador->id,
            ]);
        }
 
        User::factory()->count(5)->create();
        Project::factory()->count(3)->create(['owner_id' => $lider->id]);
    }
}
