@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-3">
        <h2 class="mt-2">Aula</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('courses.index') }}" class="text-decoration-none">Cursos</a>
            </li>
            <li class="breadcrumb-item active">Aula</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header hstack gap-2">
            <span>Visualizar Aula</span>
            <span class="ms-auto d-sm-flex flex-row">
                <a href="{{ route('courses.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0">Cursos</a>
                <a href="{{ route('classes.index', ['course' => $classe->course_id]) }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0">Aulas</a>
                <a href="{{ route('classes.edit', ['classe' => $classe->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-sm-0">Editar</a>
                <form action="{{ route('classes.destroy', ['classe' => $classe->id]) }}" method="POST" onclick="return confirm('Tem certeza que deseja EXCLUIR esse registro?')">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 mb-sm-0">Excluir</button>
                </form>
            </span>
        </div>

        <div class="card-body">
            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            <dl class="row">
                <dt class="col-sm-2">ID: </dt>
                <dd class="col-sm-10">{{ $classe->id }}</dd>

                <dt class="col-sm-2">Nome: </dt>
                <dd class="col-sm-10">{{ $classe->name }}</dd>

                <dt class="col-sm-2">Ordem: </dt>
                <dd class="col-sm-10">{{ $classe->order_classe }}</dd>

                <dt class="col-sm-2">Descrição: </dt>
                <dd class="col-sm-10">{{ $classe->description }}</dd>

                <dt class="col-sm-2">Curso: </dt>
                <dd class="col-sm-10">{{ $classe->course->name }}</dd>

                <dt class="col-sm-2">Cadastrado: </dt>
                <dd class="col-sm-10">{{ \Carbon\Carbon::parse($classe->created_at)->format('d/m/Y H:i:s') }}</dd>

                <dt class="col-sm-2">Editado: </dt>
                <dd class="col-sm-10">{{ \Carbon\Carbon::parse($classe->updated_at)->tz('America/Fortaleza')->format('d/m/Y H:i:s') }}</dd>
            </dl>

            
        </div>
    </div>
</div>
      
@endsection