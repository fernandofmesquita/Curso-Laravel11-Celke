@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-2">Usuários</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Usuários</li>
        </ol>
    </div>
    <div class="card mb-4 border-info shadow" >
        <div class="card-header hstack gap-2">
            <span>Listar Usuários</span>
            <span class="ms-auto">
                @can('create-user')
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm"><i class="fa-regular fa-square-plus"></i> Cadastrar</a>                    
                @endcan
                
            </span>
        </div>

        <div class="card-body">
            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell text-center">ID</th>
                        <th>Name</th>
                        <th class="d-none d-md-table-cell">E-mail</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Listar os registros --}}
                    @forelse ($users as $user)
                    <tr>
                        <th class="d-none d-sm-table-cell text-center">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td class="d-none d-md-table-cell">{{ $user->email }}</td>
                        <td class="d-md-flex flex-row justify-content-center">
                            
                            @can('show-user')
                                <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-eye"></i> Visualizar</a>
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
                            
                        </td>
                      </tr>

                    @empty
                        <div class="alert alert-danger" role="alert">
                            Não existe Usuários cadastrados
                        </div>
                    @endforelse
                </tbody>

            </table>
           
            {{-- imprimir Paginação
            {{ $users->links() }} --}}
        </div>
    </div>
</div>
      
@endsection