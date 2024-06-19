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
            <span>Editar Usuário</span>
            <span class="ms-auto d-sm-flex flex-row">
                @can('index-user')
                    <a href="{{ route('users.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Usuários</a>
                @endcan

                @can('show-user')
                    <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-eye"></i> Visualizar</a>
                @endcan
                
                @can('editPassword-user')
                    <a href="{{ route('users.edit-password', ['user' => $user->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-pen-to-square"></i> Alterar Senha</a>
                @endcan
        
            </span>
        </div>

        <div class="card-body">

            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            
            <form class="row g-3" action="{{ route('users.update', ['user' => $user->id])}}" method="POST" >
                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <label for="name" class="form-label">Nome: </label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Digite o nome do Usuário" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">E-mail: </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Digite o e-mail do Usuário" value="{{ old('email', $user->email) }}" required>
                </div>
        </div>
        <div class="card-footer">
                    <button type="submit" class="btn btn-warning btn-sm">Editar</button>
        </div>

            </form>

            
        
    </div>
</div>
      
@endsection