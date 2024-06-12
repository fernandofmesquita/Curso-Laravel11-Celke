@extends('layouts.admin')

@section('content')
    <h2>Editar Aula</h2> 
    <a href="{{ route('classes.index', ['course' => $classe->course_id]) }}"><button type="button">Listar Aulas</button></a> <br> <br>

    <x-alert/> <br>

    <form action="{{ route('classes.update', ['classe' => $classe->id]) }}" method="POST">
        @csrf
        @method('put')
        <input type="hidden" name="course_id" id="course_id" value="{{($classe->course_id)}}" required> 
        <label for="name">Curso: </label>
        <input type="text" name="name_course" id="name_course" value="{{ $classe->course->name }}" disabled> <br><br>

        <label for="name">Nome: </label>
        <input type="text" name="name" id="name" placeholder="Digite nome da Aula" value="{{ old('name', $classe->name) }}" required> <br><br>

        <label for="">Descrição: </label> <br>
        <textarea name="description" id="" cols="30" rows="10" required>{{ old('description', $classe->description) }}</textarea> <br><br>
        
        <button type="submit">Editar</button>

    </form>
@endsection