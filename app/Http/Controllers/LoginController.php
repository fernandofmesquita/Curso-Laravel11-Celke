<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function loginProcess(LoginRequest $request)
    {
        // dd($request);
        $request->validated();
        
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if(!$authenticated){
            return back()->withInput()->with('error', 'Usuário e Senha incorretos');
        }

        return redirect()->route('dashboard.index');
    }

    public function create()
    {
        // Carregar a View
        return view('login.create');
    }

    public function store(UserRequest $request)
    {
        // Verificação de Convite
        $invite = $request->invite;

        if($invite == 'Foca99')
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

                return redirect()->route('login.index')
                ->with('success', 'Usuário cadastrado com sucesso');

            } catch (Exception $e){

                // Desfaz a transação
                DB::rollBack();

                // Registrar no Log
                Log::notice('Usuário não Cadastrado', ['error' => $e->getMessage()]);

                return back()->withInput()->with('error', 'Usuário não foi cadastrado');

            }     
            
        }else
        {
            return back()->withInput()->with('error', 'Código de Convite Inválido');
        }
    }

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login.index')->with('success', 'Deslogado com sucesso.');
    }
}
