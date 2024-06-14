@extends('layouts.admin')

@section('content')
    <h2>Visualizar Aula</h2>

    <a href="{{ route('classes.index', ['course' => $classe->course_id]) }}"><button  type="button">Listar Aulas</button></a> 
    <br><br><hr><br>
    

    {{-- Componente de mensagens de alerta --}}
    <x-alert />
    
        <b>ID: </b> {{ $classe->id }} <br>
        <b>Nome: </b> {{ $classe->name }} <br>
        <b>Ordem: </b> {{ $classe->order_classe }} <br>
        <b>Descrição: </b> {{ $classe->description }} <br>
        <b>Curso: </b> {{ $classe->course->name }} <br>
        <b>Data de Cadastro:</b> {{ \Carbon\Carbon::parse($classe->created_at)->format('d/m/Y H:i:s') }}<br>
        <b>Data de Edição:</b> {{ \Carbon\Carbon::parse($classe->updated_at)->tz('America/Fortaleza')->format('d/m/Y H:i:s') }}<br><br>
        <a href="{{ route('classes.edit', ['classe' => $classe->id]) }}"><button type="button">Editar</button></a> 
        <form action="{{ route('classes.destroy', ['classe' => $classe->id]) }}" method="POST" onclick="return confirm('Tem certeza que deseja EXCLUIR esse registro?')">
            @csrf
            @method('delete')
            <button type="submit">Excluir</button>
        </form>
        <br> <br>
        <hr><br>
   

@endsection