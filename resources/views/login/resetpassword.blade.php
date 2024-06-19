@extends('layouts.login')

@section('content')
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Nova Senha</h3>
            </div>
            <div class="card-body">

                <x-alert />

                <form action="{{ route('reset-password.submit') }}" method="POST">
                    @csrf
                    @method('POST')

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Seu email Cadastrado" value="{{ old('email') }}">
                        <label for="email">E-mail</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Nova Senha">
                        <label for="password">Nova Senha</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                            placeholder="Confirmar Nova Senha">
                        <label for="password_confirmation">Confirmar Nova Senha</label>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a href="{{ route('forgot-password.show') }}" class="small text-decoration-none">Esqueceu a senha?</a>
                        <button type="submit" class="btn btn-sm btn-primary" onclick="this.innerText = 'Atualizando...'">Atualizar</button>
                    </div>

                </form>
            </div>

            <div class="card-footer text-center py-3">
                <div class="small">
                    <a href="{{ route('login.index') }}" class="text-decoration-none">Clique aqui</a> para acessar.
                </div>
            </div>

        </div>
    </div>
@endsection
