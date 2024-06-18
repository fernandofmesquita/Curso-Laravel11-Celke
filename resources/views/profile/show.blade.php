@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-2">Perfil</h2>

        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            
            <li class="breadcrumb-item active">Perfil</li>
        </ol>
    </div>
    <div class="card mb-4 border-primary shadow">
        <div class="card-header hstack gap-2">
            <span>Visualizar Perfil</span>
            <span class="ms-auto d-sm-flex flex-row">
                
                <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                <a href="{{ route('profile.edit-password') }}" class="btn btn-warning btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-pen-to-square"></i> Alterar Senha</a>
                
            </span>
        </div>

        <div class="card-body">
            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            <dl class="row">
                <dt class="col-sm-2">ID: </dt>
                <dd class="col-sm-10">{{ $user->id }}</dd>

                <dt class="col-sm-2">Nome: </dt>
                <dd class="col-sm-10">{{ $user->name }}</dd>

                <dt class="col-sm-2">E-mail: </dt>
                <dd class="col-sm-10">{{ $user->email }}</dd>
            </dl>

            
        </div>
    </div>
</div>
      
@endsection