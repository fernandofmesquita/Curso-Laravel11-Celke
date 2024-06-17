<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){

        //Receber dado do DB

        // $courses = Course::where('id', 1000)->get();
                
        // $courses = Course::orderBy('id', 'ASC')->get();
        
        $courses = Course::orderBy('id', 'ASC')->paginate(10);


        // Carregar a View
        return view('courses.index', ['menu' => 'courses', 'courses' => $courses]);
    }

    // Visualizar o curso
    public function show(Course $course){
        
        // Como foi respeita todas as regras de nomenclatura do laravel, não foi
        // preciso utilizar o request para filtrar, foi utilizado somente a model
        // $course = Course::where('id', $request->course)->first();

        // Carregar a View
        return view('courses.show', ['menu' => 'courses', 'course' => $course]);
    }

    // Formulario para cadastrar o curso
    public function create(){
        
        // Carregar a View
        return view('courses.create', ['menu' => 'courses']);
    }

    // Cadastrar o Curso no Banco de Dados
    public function store(CourseRequest $request){
        
        //validar os dados do request
        $request->validated();

        // Abrir query no banco de dados
        DB::beginTransaction();

        // Tenta salvar no Banco de Dados
        try {
            // Salvar as informações do form no DB
            $course = Course::create([
                'name' => $request->name,
                'price' => $request->price,
            ]);
            
            // Confirma a transação
            DB::commit();

            // Registrar no Log
            Log::info('Curso Cadastrado', ['course_id' => $course->id ]);

            return redirect()->route('courses.show', ['course' => $course->id])
            ->with('success', 'Curso cadastrado com sucesso');

        } catch (Exception $e){

            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Curso não Cadastrado', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Curso não foi cadastrado');

        }
    }

     // Formulario para editar o curso
     public function edit(Course $course){
        
        // dd($course);

        // Carregar a View
        return view('courses.edit', ['menu' => 'courses', 'course' => $course]);
    }

     // Editar o Curso no Banco de Dados
     public function update(CourseRequest $request, Course $course){
        
          //validar os dados do request
        $request->validated();
        
        // Abrir query no banco de dados
        DB::beginTransaction();

        // Tenta editar no Banco de Dados
        try {

            // Editar no Banco de Dados
            $course->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);

            // Confirma a transação
            DB::commit();

            // Registrar no Log
            Log::info('Curso Editado', ['course_id' => $course->id ]);

            // Carregar a View
            return redirect()->route('courses.show', ['course' => $course->id])
            ->with('success', 'Curso Editado com sucesso');  
            
        } catch (Exception $e){

            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Curso não Editado', ['course_id' => $course->id, 'error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Curso não foi Editado');

        }
  
    }

    
     // Excluir o Curso no Banco de Dados
     public function destroy(Course $course){
        
        // Abrir query no banco de dados
        DB::beginTransaction();

        // Tenta excluir no Banco de Dados
        try {
            // Excluir o registro
            $course->delete();

            // Confirma a transação
            DB::commit();

            // Registrar no Log
            Log::info('Curso Deletado', ['course_id' => $course->id ]);

            // Carregar a View
            return redirect()->route('courses.index')
            ->with('success', 'Curso excluido com Sucesso');

        } catch (Exception $e) {
            
            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Curso não Deletado', ['course_id' => $course->id, 'error' => $e->getMessage()]);
            
            $errorCod = $e->getCode();
            return redirect()->route('courses.index')
            ->with('error', "Curso: $course->name não pode ser excluido. (Erro: $errorCod)");

        }
    }
}
