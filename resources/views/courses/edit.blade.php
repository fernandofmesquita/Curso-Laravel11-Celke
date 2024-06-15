@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-2">Curso</h2>

        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('courses.index') }}" class="text-decoration-none">Cursos</a>
            </li>
            <li class="breadcrumb-item active">Curso</li>
        </ol>
    </div>
    <div class="card mb-4 border-warning shadow">
        <div class="card-header hstack gap-2">
            <span>Editar Curso</span>
            <span class="ms-auto d-sm-flex flex-row">
                <a href="{{ route('courses.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Cursos</a>
                <a href="{{ route('courses.show', ['course' => $course->id]) }}" class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-eye"></i> Visualizar</a>
            </span>
        </div>

        <div class="card-body">

            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            {{-- Formulario de cadastro de curso  --}}
            <form class="row g-3" action="{{ route('courses.update', ['course' => $course->id])}}" method="POST" >
                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <label for="name" class="form-label">Nome: </label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Digite o nome do curso" value="{{ old('name', $course->name) }}" required>
                </div>
                <div class="col-md-12">
                    <label for="price" class="form-label">Preço: </label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Digite o preço do curso" value="{{ old('price', $course->price) }}" required>
                </div>
        </div>
        <div class="card-footer">
                    <button type="submit" class="btn btn-warning btn-sm">Editar</button>
        </div>

            </form>

            
        
    </div>
</div>
      
@endsection