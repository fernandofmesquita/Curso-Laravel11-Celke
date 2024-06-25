@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-2">Curso</h2>

        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                @can('index-course')
                    <a href="{{ route('courses.index') }}" class="text-decoration-none">Cursos</a>
                @endcan
            </li>
            <li class="breadcrumb-item active">Curso</li>
        </ol>
    </div>
    <div class="card mb-4 border-primary shadow">
        <div class="card-header hstack gap-2">
            <span>Visualizar Curso</span>
            <span class="ms-auto d-sm-flex flex-row">

                @can('index-course')
                    <a href="{{ route('courses.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Cursos</a>
                @endcan

                @can('index-classe')
                <a href="{{ route('classes.index', ['course' => $course->id]) }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Aulas</a>
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

            </span>
        </div>

        <div class="card-body">
            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            <dl class="row">
                <dt class="col-sm-2">ID: </dt>
                <dd class="col-sm-10">{{ $course->id }}</dd>

                <dt class="col-sm-2">Nome: </dt>
                <dd class="col-sm-10">{{ $course->name }}</dd>

                <dt class="col-sm-2">Preço: </dt>
                <dd class="col-sm-10">{{ 'R$ '. number_format($course->price, 2, ',', '.') }}</dd>

                <dt class="col-sm-2">Cadastrado: </dt>
                <dd class="col-sm-10">{{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}</dd>

                <dt class="col-sm-2">Editado: </dt>
                <dd class="col-sm-10">{{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Fortaleza')->format('d/m/Y H:i:s') }}</dd>
            </dl>

            
        </div>
    </div>
</div>
      
@endsection