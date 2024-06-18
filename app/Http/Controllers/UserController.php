<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'ASC')->get();

        return view('users.index', ['menu' => 'users', 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Carregar a View
        return view('users.create', ['menu' => 'users']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        //validar os dados do request
        $request->validated();

        // Abrir query no banco de dados
        DB::beginTransaction();

        // Tenta salvar no Banco de Dados
        try {
            // Salvar as informações do form no DB
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password, ['rounds' => 12]),
            ]);
            
            // Confirma a transação
            DB::commit();

            // Registrar no Log
            Log::info('Usuário Cadastrado', ['user_id' => $user->id ]);

            return redirect()->route('users.show', ['user' => $user->id])
            ->with('success', 'Usuário cadastrado com sucesso');

        } catch (Exception $e){

            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Usuário não Cadastrado', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Usuário não foi cadastrado');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
       return view('users.show', ['menu' => 'users', 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', ['menu' => 'users', 'user' => $user]);
    }

     /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        //validar os dados do request
        $request->validated();
        
        // Abrir query no banco de dados
        DB::beginTransaction();

        // Tenta editar no Banco de Dados
        try {

            // Editar no Banco de Dados
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Confirma a transação
            DB::commit();

            // Registrar no Log
            Log::info('Senha do Usuário Editada', ['user_id' => $user->id ]);

            // Carregar a View
            return redirect()->route('users.show', ['user' => $user->id])
            ->with('success', 'Senha do Usuário Editada com sucesso');  
            
        } catch (Exception $e){

            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Usuário não Editado', ['user_id' => $user->id, 'error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Usuário não foi Editado');

        }

    }

    public function editPassword(User $user)
    {
        return view('users.edit-password', ['menu' => 'users', 'user' => $user]);
    }

     // Editar no banco de dados a senha do usuário
    public function updatePassword(Request $request, User $user)
    {

        // Validar o formulário
        $request->validate(
        [
            'password' => 'required|min:6',
        ], 
        [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);
        // Abrir query no banco de dados
        DB::beginTransaction();

        // Tenta editar no Banco de Dados
        try {

            // Editar no Banco de Dados
            $user->update([
                'password' => Hash::make($request->password, ['rounds' => 12]),
            ]);

            // Confirma a transação
            DB::commit();

            // Registrar no Log
            Log::info('Senha do Usuário Editada', ['user_id' => $user->id ]);

            // Carregar a View
            return redirect()->route('users.show', ['user' => $user->id])
            ->with('success', 'Senha do Usuário Editada com sucesso');  
            
        } catch (Exception $e){

            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Senha do Usuário não foi Editada', ['user_id' => $user->id, 'error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Senha do Usuário não foi Editada');

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Abrir query no banco de dados
        DB::beginTransaction();

        // Tenta excluir no Banco de Dados
        try {
            // Excluir o registro
            $user->delete();

            // Confirma a transação
            DB::commit();

            // Registrar no Log
            Log::info('Usuário Deletado', ['user_id' => $user->id ]);

            // Carregar a View
            return redirect()->route('users.index')
            ->with('success', 'Usuário excluido com Sucesso');

        } catch (Exception $e) {
            
            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Usuário não Deletado', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            
            $errorCod = $e->getCode();
            return redirect()->route('users.index')
            ->with('error', "Usuário: $user->name não pode ser excluido. (Erro: $errorCod)");

        }
    }
}
