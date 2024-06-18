@extends('layouts.login')

@section('content')
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Recuperar Senha</h3>
            </div>
            <div class="card-body">

                <x-alert />

                <form action="{{ route('forgot-password.submint') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Digite o e-mail de usuário" value="{{ old('email') }}">
                        <label for="email">E-mail</label>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        
                        <button type="submit" class="btn btn-sm btn-primary" onclick="this.innerText = 'Recuperando...'">Recuperar</button>
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
