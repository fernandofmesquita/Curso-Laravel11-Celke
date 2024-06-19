<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'superadmin@superadmin.com')->first()){
            $superAdmin = User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@superadmin.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

            // Atribuir papel para o usuário
            $superAdmin->assignRole('Super Admin');

        }

        if (!User::where('email', 'admin@admin.com')->first()){
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

            // Atribuir papel para o usuário
            $admin->assignRole('Admin');

        }

        if (!User::where('email', 'professor@professor.com')->first()){
            $teacher = User::create([
                'name' => 'Professor',
                'email' => 'professor@professor.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

            // Atribuir papel para o usuário
            $teacher->assignRole('Professor');

        }

        if (!User::where('email', 'tutor@tutor.com')->first()){
            $tutor = User::create([
                'name' => 'Tutor',
                'email' => 'tutor@tutor.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

            // Atribuir papel para o usuário
            $tutor->assignRole('Tutor');

        }

        if (!User::where('email', 'aluno@aluno.com')->first()){
            $student = User::create([
                'name' => 'Aluno',
                'email' => 'aluno@aluno.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

            // Atribuir papel para o usuário
            $student->assignRole('Aluno');

        }
    }
}
