@extends('layouts.admin')

@section('content')
    <h2>Detalhes do Curso</h2>

    <a href="{{ route('courses.index') }}">Listar Curso</a>
    <a href="{{ route('courses.edit') }}">Editar Curso</a>
    
@endsection