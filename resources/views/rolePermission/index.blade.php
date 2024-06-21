@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-2">Permissões</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('roles.index') }}" class="text-decoration-none">Papeis</a>
            </li>
            <li class="breadcrumb-item active">Permissões</li>
        </ol>
    </div>
    <div class="card mb-4 border-info shadow" >
        <div class="card-header hstack gap-2">
            <span>Listar Permissões do Papel - <b>{{ $role->name }}</b></span>
            <span class="ms-auto">
                @can('index-role')
                    <a href="{{ route('roles.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-md-0">Papeis</a>
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
                        <th class="d-none d-sm-table-cell text-center">Permissão</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Listar os registros --}}
                   @forelse ($permissions as $permission)
                    <tr>
                        <th class="d-none d-sm-table-cell text-center">{{ $permission->id }}</th>
                        <td>{{ $permission->title }}</td>
                        <td class="d-none d-sm-table-cell text-center">{{ $permission->name }}</td>
                        <td class="text-center">
                            @if (in_array($permission->id, $rolePermissions ?? []))
                                <span class="badge text-bg-success">Liberado</span>
                            @else
                                <span class="badge text-bg-danger">Bloqueado</span>
                            @endif
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
            {{ $roles->links() }} --}}
        </div>
    </div>
</div>

@endsection