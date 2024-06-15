@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-3">
        <h2 class="mt-2">Aulas</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('courses.index') }}" class="text-decoration-none">Cursos</a>
            </li>
            <li class="breadcrumb-item active">Aulas</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header hstack gap-3">
            <span>Listar Aulas | {{ $course->name }}</span>
            <span class="ms-auto">
                <a href="{{ route('courses.index') }}" class="btn btn-info btn-sm">Cursos</a>
                <a href="{{ route('classes.create', ['course' => $course->id]) }}" class="btn btn-success btn-sm">Cadastrar</a>
            </span>
        </div>

        <div class="card-body">
            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell text-center">ID</th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell text-center">Ordem</th>
                        <th class="d-none d-xl-table-cell">Descrição</th>
                        <th>Curso</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Listar os registros --}}
                    @forelse ($classes as $classe)
                    <tr>
                        <th class="d-none d-sm-table-cell text-center">{{ $classe->id }}</th>
                        <td>{{ $classe->name }}</td>
                        <td class="d-none d-sm-table-cell text-center">{{ $classe->order_classe }}</td>
                        <td class="d-none d-xl-table-cell">{{ $classe->description }}</td>
                        <td>{{ $classe->course->name }}</td>
                        <td class="d-md-flex flex-row justify-content-center">
                            <a href="{{ route('classes.show', ['classe' => $classe->id]) }}" class="btn btn-primary btn-sm me-1 mb-1 mb-md-0">Visualizar</a>
                            <a href="{{ route('classes.edit', ['classe' => $classe->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-md-0">Editar</a>

                            <form action="{{ route('classes.destroy', ['classe' => $classe->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 mb-md-0" onclick="return confirm('Tem certeza que deseja EXCLUIR esse registro?')">Excluir</button>
                            </form>
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
            {{ $classes->links() }}
        </div>
    </div>
</div>
      
@endsection