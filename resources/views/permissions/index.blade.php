@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Página</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Páginas</li>
            </ol>
        </div>

        <div class="card mb-4 border-info shadow" >
            <div class="card-header hstack gap-2">
                <span>Listar</span>

                <span class="ms-auto">
                    @can('create-permission')
                        <a href="{{ route('permission.create') }}" class="btn btn-success btn-sm"><i
                                class="fa-regular fa-square-plus"></i> Cadastrar</a>
                    @endcan
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="d-none d-md-table-cell">Título</th>
                            <th>Nome</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        {{-- Imprimir os registros --}}
                        @forelse ($permissions as $permission)
                            <tr>
                                <th>{{ $permission->id }}</th>
                                <td class="d-none d-md-table-cell">{{ $permission->title }}</td>
                                <td>{{ $permission->name }}</td>
                                <td class="d-md-flex flex-row justify-content-center">

                                    @can('show-permission')
                                        <a href="{{ route('permission.show', ['permission' => $permission->id]) }}"
                                        class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-eye"></i>
                                        Visualizar</a>
                                    @endcan                                    

                                    @can('edit-permission')
                                        <a href="{{ route('permission.edit', ['permission' => $permission->id]) }}"
                                        class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"><i
                                            class="fa-regular fa-pen-to-square"></i> Editar</a>
                                    @endcan                                    

                                    @can('destroy-permission')
                                        <form id="formExcluir{{ $permission->id }}"
                                            action="{{ route('permission.destroy', ['permission' => $permission->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger btn-sm me-1 mb-1 mb-md-0 btnDelete"
                                                data-delete-id="{{ $permission->id }}"><i class="fa-regular fa-trash-can"></i> Apagar</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhuma permissão encontrada!
                            </div>
                        @endforelse

                    </tbody>
                </table>

                {{-- Imprimir a paginação --}}
                {{ $permissions->links() }}

            </div>
        </div>
    </div>
@endsection
