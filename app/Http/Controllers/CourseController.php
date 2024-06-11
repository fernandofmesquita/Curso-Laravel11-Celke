<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){

        //Receber dado do DB

        // $courses = Course::where('id', 1000)->get();
        
        // $courses = Course::paginate(1);
        
        $courses = Course::orderBy('id', 'ASC')->get();

        // Carregar a View
        return view('courses.index', ['courses' => $courses]);
    }

    // Visualizar o curso
    public function show(Course $course){
        
        // Como foi respeita todas as regras de nomenclatura do laravel, não foi
        // preciso utilizar o request para filtrar, foi utilizado somente a model
        // $course = Course::where('id', $request->course)->first();

        // Carregar a View
        return view('courses.show', ['course' => $course]);
    }

    // Formulario para cadastrar o curso
    public function create(){
        
        // Carregar a View
        return view('courses.create');
    }

    // Cadastrar o Curso no Banco de Dados
    public function store(CourseRequest $request){
        
        //validar os dados do request
        $request->validated();
        // Salvar as informações do form no DB
        Course::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        
        return redirect()->route('courses.index')
        ->with('success', 'Curso cadastrado com sucesso');
    }

     // Formulario para editar o curso
     public function edit(Course $course){
        
        // dd($course);

        // Carregar a View
        return view('courses.edit', ['course' => $course]);
    }

     // Editar o Curso no Banco de Dados
     public function update(CourseRequest $request, Course $course){
        
        // dd($course); 
        // dd($request); 

        //validar os dados do request
        $request->validated();

        // Editar no Banco de Dados
        $course->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        // Carregar a View
        return redirect()->route('courses.index')
        ->with('success', 'Curso Editado com sucesso');    
    }

    
     // Excluir o Curso no Banco de Dados
     public function destroy(Course $course){
        
        // Excluir o registro
        $course->delete();

        // Carregar a View

        return redirect()->route('courses.index')
        ->with('success', 'Curso excluido com Sucesso');
    }
}
