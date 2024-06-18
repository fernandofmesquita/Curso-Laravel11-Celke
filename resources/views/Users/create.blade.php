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
                <a href="{{ route('users.index') }}" class="text-decoration-none">Usuários</a>
            </li>
            <li class="breadcrumb-item active">Usuário</li>
        </ol>
    </div>
    <div class="card mb-4 border-success shadow">
        <div class="card-header hstack gap-2">
            <span>Cadastrar Usuário</span>
            <span class="ms-auto d-sm-flex flex-row">
                <a href="{{ route('users.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Usuários</a>
            </span>
        </div>

        <div class="card-body">

            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            {{-- Formulario de cadastro de Usuário  --}}
            <form class="row g-3" action="{{ route('users.store') }}" method="POST" >
                @csrf
                @method('POST')

                <div class="col-md-12">
                    <label for="name" class="form-label">Nome: </label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Digite o nome do Usuário" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">E-mail: </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Digite o E-mail do Usuário" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-12">
                    <label for="password" class="form-label">Senha: </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Digite o Senha do Usuário" value="{{ old('password') }}" required>
                </div>
        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
        </div>
    
            </form>
    
    </div>
</div>
      
@endsection