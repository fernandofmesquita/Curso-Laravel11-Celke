<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica se existe e senão existir, cadastra na tabela Roles o nome do papel
        if(!Role::where('name', 'Super Admin')->first()){
            Role::create([
                'name' => 'Super Admin',
            ]);
        }
        
        // Verifica se existe e senão existir, cadastra na tabela Roles o nome do papel
        if(!Role::where('name', 'Admin')->first()){
            $admin = Role::create([
                'name' => 'Admin',
            ]);
        } else {
            $admin = Role::where('name', 'Admin')->first();
        }

            // Dar permissão para o papel e salva o relacionamento na tabela role_has_permissions
            $admin->givePermissionTo([
                'index-course',
                'show-course',
                'create-course',
                'edit-course',
                'destroy-course',

                'index-classe',
                'show-classe',
                'create-classe',
                'edit-classe',
                'destroy-classe',

                'index-user',
                'show-user',
                'create-user',
                'edit-user',
                'editPassword-user',
                'destroy-user',

                'index-role',
                'store-role',
                'update-role',

                'index-role-permission',
                
            ]);

            $admin->revokePermissionTo([
                'store-role',
                'update-role',
            ]);
        
        
        // Verifica se existe e senão existir, cadastra na tabela Roles o nome do papel
        if(!Role::where('name', 'Professor')->first()){
            $teacher = Role::create([
                'name' => 'Professor',
            ]);
        } else {
            $teacher = Role::where('name', 'Professor')->first();
        }

            // Dar permissão para o papel e salva o relacionamento na tabela role_has_permissions
            $teacher->givePermissionTo([
                'index-course',
                'show-course',
                'create-course',
                'edit-course',
                'destroy-course',

                'index-classe',
                'show-classe',
                'create-classe',
                'edit-classe',
                'destroy-classe',

                'index-user',
                'show-user',
            ]);
        
        
        // Verifica se existe e senão existir, cadastra na tabela Roles o nome do papel
        if(!Role::where('name', 'Tutor')->first()){
            $tutor = Role::create([
                'name' => 'Tutor',
            ]);
        } else {
            $tutor = Role::where('name', 'Tutor')->first();
        }

            // Dar permissão para o papel e salva o relacionamento na tabela role_has_permissions
            $tutor->givePermissionTo([
                'index-course',
                'show-course',
                'edit-course',

                'index-classe',
                'show-classe',
                'edit-classe',

                'index-user',
                
            ]);

            $tutor->revokePermissionTo([
                'index-user',
            ]);
        
        
        // Verifica se existe e senão existir, cadastra na tabela Roles o nome do papel
        if(!Role::where('name', 'Aluno')->first()){
            Role::create([
                'name' => 'Aluno',
            ]);
        } else {
            $aluno = Role::where('name', 'Aluno')->first();
        }
    }

}
