@extends('layouts.admin')

@section('content')
    <h2>Listar as Aulas</h2>

    <a href="{{ route('courses.index') }}"><button  type="button">Listar Cursos</button></a> 
    <a href="{{ route('classes.create', ['course' => $course->id]) }}"><button  type="button">Cadastrar Aula</button></a><br><br><hr><br>
    

    {{-- Componente de mensagens de alerta --}}
    <x-alert />

    @forelse ($classes as $classe)

        <b>ID: </b> {{ $classe->id }} <br>
        <b>Nome: </b> {{ $classe->name }} <br>
        <b>Ordem: </b> {{ $classe->order_classe }} <br>
        <b>Descrição: </b> {{ $classe->description }} <br>
        <b>Curso: </b> {{ $classe->course->name }} <br>
        <b>Data de Cadastro:</b> {{ \Carbon\Carbon::parse($classe->created_at)->format('d/m/Y H:i:s') }}<br>
        <b>Data de Edição:</b> {{ \Carbon\Carbon::parse($classe->updated_at)->tz('America/Fortaleza')->format('d/m/Y H:i:s') }}<br><br>
        <a href="{{ route('classes.edit', ['classe' => $classe->id]) }}"><button type="button">Editar</button></a> <br> <br>
        <hr><br>
    @empty
    <p style="color: red">Não existe Aulas cadastradas</p>
    @endforelse

@endsection