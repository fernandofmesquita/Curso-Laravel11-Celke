@extends('layouts.admin')

@section('content')
    <h2>Detalhes do Curso</h2>

    <a href="{{ route('courses.index') }}"><button>Listar</button></a> <br>
    <a href="{{ route('courses.edit', ['course' => $course->id]) }}"><button type="button">Editar</button></a> <br><br>

    <label>ID: </label> {{ $course->id }} <br>
    <label>NOME: </label> {{ $course->name }} <br>
    <label>CRIAÇÃO: </label> {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y h:i:s') }} <br>
    <label>EDIÇÃO: </label> {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y h:i:s') }} <br>
    
@endsection