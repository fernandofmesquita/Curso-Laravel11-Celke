@extends('layouts.admin')

@section('content')
    <h2>Cadastrar Aula</h2> 
    <a href="{{ route('classes.index', ['course' => $course->id]) }}"><button type="button">Listar Aulas</button></a> <br> <br>

    <x-alert/> <br>

    <form action="{{ route('classes.store') }}" method="POST">
        @csrf
        @method('post')
        <input type="hidden" name="course_id" id="course_id" value="{{($course->id)}}" required> 
        <label for="name">Curso: </label>
        <input type="text" name="name_course" id="name_course" value="{{ $course->name }}" disabled> <br><br>

        <label for="name">Nome: </label>
        <input type="text" name="name" id="name" placeholder="Digite nome da Aula" value="{{ old('name') }}" required> <br><br>

        <label for="">Descrição: </label> <br>
        <textarea name="description" id="" cols="30" rows="10" required>{{ old('description') }}</textarea> <br><br>
        
        <button type="submit">Cadastrar</button>

    </form>
@endsection