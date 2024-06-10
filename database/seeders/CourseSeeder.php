<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Course::Where('name', 'Curso de Laravel - T1')->first()){
            Course::create([
                'name' => 'Curso de Laravel - T1',
            ]);
        }

        if (!Course::Where('name', 'Curso de Laravel - T2')->first()){
            Course::create([
                'name' => 'Curso de Laravel - T2',
            ]);
        }

        if (!Course::Where('name', 'Curso de Laravel - T3')->first()){
            Course::create([
                'name' => 'Curso de Laravel - T3',
            ]);
        }
    }
}
