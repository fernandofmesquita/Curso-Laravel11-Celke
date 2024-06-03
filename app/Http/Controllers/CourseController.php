<?php

namespace App\Http\Controllers;

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
    public function store(){
        
        dd('Cadastrar');
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
