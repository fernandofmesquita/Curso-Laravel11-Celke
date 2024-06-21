<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['title' => 'Listar Cursos', 'name' => 'index-course'],
            ['title' => 'Visualizar Curso', 'name' => 'show-course'],
            ['title' => 'Cadastrar Curso ', 'name' => 'create-course'],
            ['title' => 'Editar Curso', 'name' => 'edit-course'],
            ['title' => 'Apagar Curso', 'name' => 'destroy-course'],

            ['title' => 'Listar Aulas', 'name' => 'index-classe'],
            ['title' => 'Visualizar Aula', 'name' => 'show-classe'],
            ['title' => 'Cadastrar Aula', 'name' => 'create-classe'],
            ['title' => 'Editar Aula', 'name' => 'edit-classe'],
            ['title' => 'Apagar Aula', 'name' => 'destroy-classe'],

            ['title' => 'Listar Usuários', 'name' => 'index-user'],
            ['title' => 'Visualizar Usuário', 'name' => 'show-user'],
            ['title' => 'Cadastrar Usuário', 'name' => 'create-user'],
            ['title' => 'Editar Usuário', 'name' => 'edit-user'],
            ['title' => 'Editar senha do Usuário', 'name' => 'editPassword-user'],
            ['title' => 'Apagar Usuário', 'name' => 'destroy-user'],

            ['title' => 'Listar Papeis', 'name' => 'index-role'],
            ['title' => 'Cadastrar Papel', 'name' => 'store-role'],
            ['title' => 'Editar Papel', 'name' => 'update-role'],
            ['title' => 'Apagar Papel', 'name' => 'destroy-role'],

            ['title' => 'Listar Permissões', 'name' => 'index-role-permission'],
            ['title' => 'Editar Permissões', 'name' => 'update-role-permission'],

            ['title'=> 'Listar páginas', 'name' => 'index-permission'],
            ['title'=> 'Visualizar página', 'name' => 'show-permission'],
            ['title'=> 'Cadastrar página', 'name' => 'create-permission'],
            ['title'=> 'Editar página', 'name' => 'edit-permission'],
            ['title'=> 'Apagar página', 'name' => 'destroy-permission'],

        ];

        foreach($permissions as $permission){
            $existingPermission = Permission::where('name', $permission['name'])->first();

            if(!$existingPermission){
                Permission::create([
                    'title' => $permission['title'],
                    'name' => $permission['name'],
                    'guard_name' => 'web',
                ]);
            }
        }

    }
}
