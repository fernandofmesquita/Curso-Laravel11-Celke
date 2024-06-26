@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-2">Usuário</h2>

        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                @can('index-user')
                    <a href="{{ route('users.index') }}" class="text-decoration-none">Usuários</a>
                @endcan
            </li>
            <li class="breadcrumb-item active">Usuário</li>
        </ol>
    </div>
    <div class="card mb-4 border-warning shadow">
        <div class="card-header hstack gap-2">
            <span>Editar Senha Usuário: <b>{{ $user->name }}</b></span>
            <span class="ms-auto d-sm-flex flex-row">

                @can('index-user')
                    <a href="{{ route('users.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Usuários</a>
                @endcan

                @can('show-user')
                    <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-eye"></i> Visualizar</a>
                @endcan
                
                @can('edit-user')
                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                @endcan
            </span>
        </div>

        <div class="card-body">

            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            
            <form class="row g-3" action="{{ route('users.update-password', ['user' => $user->id])}}" method="POST" >
                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <label for="password" class="form-label">Nova Senha: </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Digite a nova senha do Usuário" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
                <div class="col-md-12">
                    <label for="password_confirmation" class="form-label">Confirmação de password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirme a Senha do Usuário" class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        </div>
        <div class="card-footer">
                    <button type="submit" class="btn btn-warning btn-sm">Editar Senha</button>
        </div>

            </form>

            
        
    </div>
</div>
      
@endsection