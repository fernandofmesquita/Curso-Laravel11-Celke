<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClasseController extends Controller
{
    public function index(Course $course)
    {
        // Recuperar as aulas do banco de dados do respectivo curso
        $classes = Classe::with('course')
            ->where('course_id', $course->id)
            ->orderBy('order_classe')
            ->paginate(10);
        
        // Carrega a view Index do curso especificado
        return view('classes.index', ['menu' => 'courses', 'course' => $course,'classes' => $classes]);
    }

    // Recuperar o curso do banco de dados e injeta na variavel $course
    public function create(Course $course)
    {
        // Carrega a view e passa os dados do Curso
        return view('classes.create', ['menu' => 'courses', 'course' => $course]);
    }

    // Recupera dos dados do formulário create
    public function store(ClasseRequest $request)
    {
        // Validação do Formulário
        $request->validated();

        // Procura a ultima aula cadastrada do curso
        $lastOrderClasse = Classe::where('course_id', $request->course_id)
                ->orderBy('order_classe', 'DESC')
                ->first();

        // Inicia a transação do Banco de Dados
        DB::beginTransaction();

        // Testa cadastrar no Banco de dados
        try {

            // Cadastra no banco de dados os dados do formulário
            $classe = Classe::create([
                'name' => $request->name,
                'description' => $request->description,
                // 'order_classe' => <condição> ? <se sim> : <se não>,
                // [existe uma $lastOrderClasse] ? [se sim lastOrderClasse + 1] : [senão será 1]
                'order_classe' => $lastOrderClasse ? $lastOrderClasse->order_classe + 1 : 1,
                'course_id' => $request->course_id
            ]);

            // Confirma a transação no Banco de Dados
            DB::commit();
            
            // Registrar no Log
            Log::info('Aula Cadastrada', ['classe_id' => $classe->id, 'course_id'=> $classe->course_id ]);

            // Carrega a view show da aula especificada
            return redirect()->route('classes.show', ['classe' => $classe->id])
                ->with('success', 'Aula Cadastrada com sucesso');
        
        } catch(Exception $e)
        {
            //Desfaz a transação no Banco de Dados
            DB::rollBack();

            // Registrar no Log
            Log::notice('Aula não Cadastrada', ['error' => $e->getMessage() ]);

            return back()->withInput()->with('error', 'Não foi possível cadastrar a Aula');

        }
    }

    // Recupera os dados da aula e injeta na variavel $classe
    public function edit(Classe $classe)
    {
        // Carrega a view e passa os dados da Aula
        return view('classes.edit', ['menu' => 'courses', 'classe' => $classe]);
    }



    // Recupera dos dados do formulário edit
    public function update(ClasseRequest $request, Classe $classe)
    {
        $request->validated();
        
        // Inicia a transação do Banco de Dados
        DB::beginTransaction();

        // Testa cadastrar no Banco de dados
        try {

            // Edita no banco de dados os dados do formulário
            $classe->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            // Confirma a transação no Banco de Dados
            DB::commit();

            // Registrar no Log
            Log::info('Aula Editada', ['classe_id' => $classe->id, 'course_id'=> $classe->course_id ]);

            // Carrega a view show da aula especificada
            return redirect()->route('classes.show', ['classe' => $classe->id])
                ->with('success', 'Aula Editada com sucesso');

                  
        } catch(Exception $e)
        {
            //Desfaz a transação no Banco de Dados
            DB::rollBack();

            // Registrar no Log
            Log::notice('Aula não Cadastrada', [
                'classe_id' => $classe->id, 
                'course_id'=> $classe->course_id, 
                'error' => $e->getMessage() ]);

            return back()->withInput()->with('error', 'Não foi possível cadastrar a Aula');

        }
    }

    // Recupera as Informações de Uma aula no Banco de Dados
    public function show(Classe $classe)
    {
        // Retorna a View da Aula especificada
        return view('classes.show', ['menu' => 'courses', 'classe' => $classe]);
    }


    // Recupera as Informações de Uma aula no Banco de Dados
    public function destroy(Classe $classe)
    {
        // Inicia uma Transação no banco de Dados
        DB::beginTransaction();

        // Tenta excluir a aula
        try {
            $classe->delete();

            // Confirma a transação no Banco de Dados
            DB::commit();

            // Registrar no Log
            Log::info('Aula Deletada', ['classe_id' => $classe->id, 'course_id'=> $classe->course_id ]);

            // Retorna para a lista de Aulas do Curso
            return redirect()->route('classes.index', ['course' => $classe->course_id])
            ->with('success', 'Aula Excluida com sucesso');

        } catch (Exception $e) {
            
            // Desfaz a transação no Banco de Dados
            DB::rollBack();

            // Registrar no Log
            Log::notice('Aula não Deletada', [
                'classe_id' => $classe->id, 
                'course_id'=> $classe->course_id, 
                'error' => $e->getMessage() ]);

            // Pega o codigo do erro
            $errorCod = $e->getCode();

            // Retorna para a lista de Aulas do Curso
            return redirect()->route('classes.index', ['course' => $classe->course_id])
            ->with('error', "Aula não excluida. (Erro: $errorCod)");
        }

    }
}
