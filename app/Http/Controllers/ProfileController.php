<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::where('id', Auth::id())->first();
       return view('profile.show', ['user' => $user]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = User::where('id', Auth::id())->first();
        return view('profile.edit', ['user' => $user]);
    }

     /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::where('id', Auth::id())->first();

        //validar os dados do request
        $request->validate(
        [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ], 
        [
            'name.required' => 'Campo nome é obrigatório!',
            'email.required' => 'Campo e-mail é obrigatório!',
            'email.email' => 'Necessário enviar e-mail válido!',
            'email.unique' => 'O e-mail já está cadastrado!',
        ]);
        
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
            Log::info('Perfil Editado', ['user_id' => $user->id, 'action_user_id' => Auth::id()]);

            // Carregar a View
            return redirect()->route('profile.show')
            ->with('success', 'Perfil editado com sucesso');  
            
        } catch (Exception $e){

            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Perfil não Editado', ['user_id' => $user->id, 'action_user_id' => Auth::id(), 'error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Perfil não foi Editado');

        }

    }

    public function editPassword()
    {
        $user = User::where('id', Auth::id())->first();

        return view('profile.edit-password', ['user' => $user]);
    }

     // Editar no banco de dados a senha do usuário
    public function updatePassword(Request $request)
    {
        $user = User::where('id', Auth::id())->first();

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
            Log::info('Senha do Perfil Editada', ['user_id' => $user->id, 'action_user_id' => Auth::id() ]);

            // Carregar a View
            return redirect()->route('profile.show', ['user' => $user->id])
            ->with('success', 'Senha do Perfil Editada com sucesso');  
            
        } catch (Exception $e){

            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Senha do Perfil não foi Editada', ['user_id' => $user->id, 'action_user_id' => Auth::id(), 'error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Senha do Perfil não foi Editada');

        }

    }
}

