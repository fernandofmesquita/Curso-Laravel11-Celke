@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-2">Aula</h2>

        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('courses.index') }}" class="text-decoration-none">Cursos</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('classes.index', ['course' => $course->id]) }}" class="text-decoration-none">Aulas</a>
            </li>
            <li class="breadcrumb-item active">Aula</li>
        </ol>
    </div>
    <div class="card mb-4 border-success shadow">
        <div class="card-header hstack gap-2">
            <span>Cadastrar Aula</span>
            <span class="ms-auto d-sm-flex flex-row">
                <a href="{{ route('classes.index', ['course' => $course->id]) }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Aulas</a>
            </span>
        </div>

        <div class="card-body">

            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            {{-- Formulario de cadastro de curso  --}}
            <form class="row g-3" action="{{ route('classes.store') }}" method="POST" >
                @csrf
                @method('POST')

                <input type="hidden" name="course_id" id="course_id" value="{{($course->id)}}" required> 

                <div class="col-md-12">
                    <label for="name" class="form-label">Curso: </label>
                    <input type="text" class="form-control" name="name_course" id="name_course" value="{{ $course->name }}" disabled> 
                </div>
                
                <div class="col-md-12">
                    <label for="name" class="form-label">Nome: </label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Digite nome da Aula" value="{{ old('name') }}" required> 
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Descrição: </label> 
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10" required>{{ old('description') }}</textarea> 
                </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
        </div>
    
            </form>
    
    </div>
</div>
      
@endsection