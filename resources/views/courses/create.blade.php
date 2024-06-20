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
    <div class="card mb-4 border-success shadow">
        <div class="card-header hstack gap-2">
            <span>Cadastrar Curso</span>
            <span class="ms-auto d-sm-flex flex-row">
                @can('index-course')
                    <a href="{{ route('courses.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Cursos</a>
                @endcan
            </span>
        </div>

        <div class="card-body">

            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            {{-- Formulario de cadastro de curso  --}}
            <form class="row g-3" action="{{ route('courses.store') }}" method="POST" >
                @csrf
                @method('POST')

                <div class="col-md-12">
                    <label for="name" class="form-label">Nome:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="price" class="form-label">Preço: </label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Digite o preço do curso" value="{{ old('price') }}">
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                
        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
        </div>
    
            </form>
    
    </div>
</div>
      
@endsection