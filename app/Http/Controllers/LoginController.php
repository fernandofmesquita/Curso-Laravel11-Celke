<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function loginProcess(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ], 
            [
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'Digite um email válido.',
                'password.required' => 'O campo senha é obrigatório.',
            ]);
        
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if(!$authenticated){
            return back()->withInput()->with('error', 'Usuário e Senha incorretos');
        }

        return redirect()->route('dashboard.index');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login.index')->with('success', 'Deslogado com sucesso.');
    }
}
