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
    <div class="card mb-4 border-primary shadow">
        <div class="card-header hstack gap-2">
            <span>Visualizar Usuário</span>
            <span class="ms-auto d-sm-flex flex-row">
            
                @can('index-user')
                    <a href="{{ route('users.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Usuários</a>
                @endcan

                @can('edit-user')
                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                @endcan
                
                @can('editPassword-user')
                    <a href="{{ route('users.edit-password', ['user' => $user->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-pen-to-square"></i> Alterar Senha</a>
                @endcan
                
                @can('destroy-user')
                    <form id="formExcluir{{ $user->id }}"
                        action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-danger btn-sm me-1 mb-1 mb-md-0 btnDelete"
                            data-delete-id="{{ $user->id }}"><i class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>
                @endcan
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

                <dt class="col-sm-2">Papel: </dt>
                <dd class="col-sm-10">
                    @forelse ($user->getRoleNames() as $role)
                        {{ $role }}
                    @empty
                        {{ "-" }}
                    @endforelse
                </dd>

                <dt class="col-sm-2">Cadastrado: </dt>
                <dd class="col-sm-10">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</dd>

                <dt class="col-sm-2">Editado: </dt>
                <dd class="col-sm-10">{{ \Carbon\Carbon::parse($user->updated_at)->tz('America/Fortaleza')->format('d/m/Y H:i:s') }}</dd>
            </dl>

            
        </div>
    </div>
</div>
      
@endsection