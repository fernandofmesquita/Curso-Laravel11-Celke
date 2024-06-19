<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return view('login.resetPassword', ['token' => $request->token]);
    }

    public function submitResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|confirmed'
        ]);

        try {

            $status = Password::reset( $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password){
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ]);

                    $user->save();

                }
        
             );
            
            Log::info('Senha atualizada', ['resposta' => $status, 'email' => $request->email]);

            return $status === Password::PASSWORD_RESET ? redirect()->route('login.index')
                ->with('success', 'Senha atualizada com sucesso!') : redirect()->route('login.index')->with('error', __($status));

        } catch (Exception $e) {

            Log::warning('Erro atualizar senha.', ['error' => $e->getMessage(), 'email' => $request->email]);

            return back()->withInput()->with('error', 'Ocorreu um erro. Tente mais tarde!');
        }
    }
}
