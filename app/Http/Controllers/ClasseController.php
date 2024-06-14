<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index(Course $course)
    {
        // Recuperar as aulas do banco de dados do respectivo curso
        $classes = Classe::with('course')
            ->where('course_id', $course->id)
            ->orderBy('order_classe')
            ->get();
        
        // Carrega a view Index do curso especificado
        return view('classes.index', ['course' => $course,'classes' => $classes]);
    }

    // Recuperar o curso do banco de dados e injeta na variavel $course
    public function create(Course $course)
    {
        // Carrega a view e passa os dados do Curso
        return view('classes.create', ['course' => $course]);
    }

    // Recupera dos dados do formulário create
    public function store(ClasseRequest $request)
    {
        $request->validated();
        // Procura a ultima aula cadastrada do curso
        $lastOrderClasse = Classe::where('course_id', $request->course_id)
                ->orderBy('order_classe', 'DESC')
                ->first();

        // Cadastra no banco de dados os dados do formulário
        $classe = Classe::create([
            'name' => $request->name,
            'description' => $request->description,
            // 'order_classe' => <condição> ? <se sim> : <se não>,
            // [existe uma $lastOrderClasse] ? [se sim lastOrderClasse + 1] : [senão será 1]
            'order_classe' => $lastOrderClasse ? $lastOrderClasse->order_classe + 1 : 1,
            'course_id' => $request->course_id
        ]);

        // Carrega a view show da aula especificada
        return redirect()->route('classes.show', ['classe' => $classe->id])
            ->with('success', 'Aula Cadastrada com sucesso');
    }

    // Recupera os dados da aula e injeta na variavel $classe
    public function edit(Classe $classe)
    {
        // Carrega a view e passa os dados da Aula
        return view('classes.edit', ['classe' => $classe]);
    }



    // Recupera dos dados do formulário edit
    public function update(ClasseRequest $request, Classe $classe)
    {
        $request->validated();

        // Edita no banco de dados os dados do formulário
        $classe->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Carrega a view show da aula especificada
        return redirect()->route('classes.show', ['classe' => $classe->id])
            ->with('success', 'Aula Editada com sucesso');
    }

    public function show(Classe $classe)
    {
        // dd($classe);
        return view('classes.show', ['classe' => $classe]);
    }

    public function destroy(Classe $classe)
    {
        $classe->delete();

        return redirect()->route('classes.index', ['course' => $classe->course_id])
        ->with('success', 'Aula Excluida com sucesso');
    }
}
