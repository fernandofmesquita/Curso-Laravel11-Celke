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
        if (!User::where('email', 'admin@admin.com')->first()){
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

        }
        
        if (!User::where('email', 'maria@maria.com')->first()){
            User::create([
                'name' => 'Maria',
                'email' => 'maria@maria.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

        }

        if (!User::where('email', 'joao@joao.com')->first()){
            User::create([
                'name' => 'João',
                'email' => 'joao@joao.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

        }

        if (!User::where('email', 'marcos@marcos.com')->first()){
            User::create([
                'name' => 'Marcos',
                'email' => 'marcos@marcos.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

        }

        if (!User::where('email', 'jose@jose.com')->first()){
            User::create([
                'name' => 'José',
                'email' => 'jose@jose.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

        }
    }
}
