@extends('layouts.admin')

@section('content')
    <h2>Listar os Cursos</h2>

    <a href="{{ route('courses.create') }}">Cadastrar Curso</a>
    <a href="{{ route('courses.show') }}">Detalhes do Curso</a>

    
@endsection