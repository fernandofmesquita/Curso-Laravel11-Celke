@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-2">Cursos</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Cursos</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header hstack gap-2">
            <span>Listar Cursos</span>
            <span class="ms-auto">
                <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm">Cadastrar</a>
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
                            <a href="{{ route('classes.index', ['course' => $course->id]) }}" class="btn btn-info btn-sm me-1 mb-1 mb-md-0">Aulas</a>
                            <a href="{{ route('courses.show', ['course' => $course->id]) }}" class="btn btn-primary btn-sm me-1 mb-1 mb-md-0">Visualizar</a>
                            <a href="{{ route('courses.edit', ['course' => $course->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-md-0">Editar</a>

                            <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
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
            {{-- {{ $courses->links() }} --}}
        </div>
    </div>
</div>
      
@endsection