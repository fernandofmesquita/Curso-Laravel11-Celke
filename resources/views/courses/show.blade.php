@extends('layouts.admin')

@section('content')
    <h2>Detalhes do Curso</h2>

    <a href="{{ route('courses.index') }}">Listar Curso</a> <br>
    <a href="{{ route('courses.edit', ['course' => $course->id]) }}">Editar Curso</a> <br><br>

    <label>ID: </label> {{ $course->id }} <br>
    <label>NOME: </label> {{ $course->name }} <br>
    <label>CRIAÇÃO: </label> {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y h:i:s') }} <br>
    <label>EDIÇÃO: </label> {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y h:i:s') }} <br>
    
@endsection