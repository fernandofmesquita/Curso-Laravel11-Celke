<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showForgotPassword()
    {
        return view('login.forgotpassword');
    }

    public function submitForgotPassword(Request $request)
    {
        $request->validate(
            [ 
                'email' => 'required|email', 
            ],
            [
                'email.required' => 'O campo e-mail é obrigatório',
                'email.email' => 'Necessário informar um e-mail válido',
            ]
        );

        $user = User::where('email', $request->email)->first();

        if(!$user){

            Log::warning('Tentativa recuperar senha com e-mail não cadastrado.', ['email' => $request->email]);

            return back()->withInput()->with('error', 'E-mail não encontrado!');
        }

        try{

            $status = Password::sendResetLink($request->only('email'));

            Log::warning('Recuperar Senha', ['email' => $request->email, 'status' => $status]);

            return redirect()->route('login.index')->with('success', 'Enviado e-mail com instruções para recuperar senha. Acesse a sua caixa de e-mail para recuperar a senha');

        } catch (Exception $e){

            Log::warning('Erro recuperar senha.', ['error' => $e->getMessage(), 'email' => $request->email]);

            return back()->withInput()->with('error', 'Não foi possivel recuperar senha. Tente mais tarde!');
        }
    }

    public function showResetPassword(Request $request)
    {
        dd($request->token);
    }
}
