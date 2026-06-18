<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
 
class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            'ver proyecto', 'crear proyecto', 'editar proyecto',
            'eliminar proyecto', 'gestionar miembros', 'crear tarea',
            'asignar tarea', 'comentar', 'gestionar usuarios',
        ];
 
        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }
 
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());
 
        $lider = Role::firstOrCreate(['name' => 'lider']);
        $lider->givePermissionTo([
            'ver proyecto', 'crear proyecto', 'editar proyecto',
            'gestionar miembros', 'crear tarea', 'asignar tarea', 'comentar',
        ]);
 
        $colaborador = Role::firstOrCreate(['name' => 'colaborador']);
        $colaborador->givePermissionTo([
            'ver proyecto', 'crear tarea', 'comentar',
        ]);
 
        $invitado = Role::firstOrCreate(['name' => 'invitado']);
        $invitado->givePermissionTo([
            'ver proyecto', 'comentar',
        ]);
    }
}
