@extends('layouts.admin')

@section('content')
    <h2>Detalhes do Curso</h2>

    <a href="{{ route('courses.index') }}"><button>Listar Cursos</button></a>
    <br><br>
    

    <b>ID: </b> {{ $course->id }} <br>
    <b>Nome: </b> {{ $course->name }} <br>
    <b>Preço: </b> {{ 'R$ '. number_format($course->price, 2, ',', '.') }}<br>
    <b>Data de Cadastro: </b> {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y h:i:s') }} <br>
    <b>Data de Edição: </b> {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y h:i:s') }} <br><br>
    
    <a href="{{ route('courses.edit', ['course' => $course->id]) }}"><button type="button">Editar</button></a> 
    <a href="{{ route('classes.index', ['course' => $course->id]) }}"><button type="button">Aulas</button></a><br><br>

@endsection