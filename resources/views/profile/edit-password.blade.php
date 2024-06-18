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
    <div class="card mb-4 border-warning shadow">
        <div class="card-header hstack gap-2">
            <span>Editar Senha Perfil</b></span>
            <span class="ms-auto d-sm-flex flex-row">
                <a href="{{ route('profile.show') }}" class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-eye"></i> Visualizar</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
            </span>
        </div>

        <div class="card-body">

            {{-- Componente de mensagens de alerta --}}
            <x-alert />

           
            <form class="row g-3" action="{{ route('profile.update-password')}}" method="POST" >
                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <label for="password" class="form-label">Nova Senha: </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Digite a nova senha do Perfil" required>
                </div>
        </div>
        <div class="card-footer">
                    <button type="submit" class="btn btn-warning btn-sm">Editar Senha</button>
        </div>

            </form>

            
        
    </div>
</div>
      
@endsection