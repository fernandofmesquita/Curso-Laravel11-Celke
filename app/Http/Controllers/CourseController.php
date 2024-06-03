<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){
        
        // Carregar a View
        return view('courses.index');
    }

    // Visualizar o curso
    public function show(){
        
        // Carregar a View
        return view('courses.show');
    }

    // Formulario para cadastrar o curso
    public function create(){
        
        // Carregar a View
        return view('courses.create');
    }

    // Cadastrar o Curso no Banco de Dados
    public function store(Request $request){
        
        // Salvar as informações do form no DB
        Course::create([
            'name' => $request->name
        ]);
        
        return redirect()->route('courses.create')->with('success', 'Curso cadastrado com sucesso');
    }

     // Formulario para editar o curso
     public function edit(){
        
        // Carregar a View
        return view('courses.edit');
    }

     // Editar o Curso no Banco de Dados
     public function update(){
        
        dd('Editar');
    }

    
     // Excluir o Curso no Banco de Dados
     public function destroy(){
        
        dd('Excluir');
    }
}
