@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-2">Cursos</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Cursos</li>
        </ol>
    </div>
    <div class="card mb-4 border-info shadow" >
        <div class="card-header hstack gap-2">
            <span>Listar Cursos</span>
            <span class="ms-auto">

                @can('create-course')
                    <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm"><i class="fa-regular fa-square-plus"></i> Cadastrar</a>
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
                        <th class="d-none d-md-table-cell text-center">Preço</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Listar os registros --}}
                    @forelse ($courses as $course)
                    <tr>
                        <th class="d-none d-sm-table-cell text-center">{{ $course->id }}</th>
                        <td>{{ $course->name }}</td>
                        <td class="d-none d-md-table-cell text-center">{{ 'R$ '. number_format($course->price, 2, ',', '.') }}</td>
                        <td class="d-md-flex flex-row justify-content-center">
                            
                            @can('index-classe')
                               <a href="{{ route('classes.index', ['course' => $course->id]) }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Aulas</a>
                            @endcan
                            
                            @can('show-course')
                                <a href="{{ route('courses.show', ['course' => $course->id]) }}" class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-eye"></i> Visualizar</a>
                            @endcan

                            @can('edit-course')
                                <a href="{{ route('courses.edit', ['course' => $course->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                            @endcan

                            @can('destroy-course')
                                <form id="formExcluir{{ $course->id }}"
                                    action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger btn-sm me-1 mb-1 mb-md-0 btnDelete"
                                        data-delete-id="{{ $course->id }}"><i class="fa-regular fa-trash-can"></i> Apagar</button>
                                </form>
                            @endcan
                        </td>
                      </tr>

                    @empty
                        <div class="alert alert-danger" role="alert">
                            Não existe cursos cadastrados
                        </div>
                    @endforelse
                </tbody>

            </table>
           
            {{-- imprimir Paginação --}}
            {{ $courses->links() }}
        </div>
    </div>
</div>
      
@endsection