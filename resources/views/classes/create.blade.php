@extends('layouts.admin')

@section('content')
    <h2>Cadastrar Aula</h2>

    <form action="{{ route('classes.store') }}" method="POST">
        @csrf
        @method('post')
        <input type="hidden" name="course_id" id="course_id" value="{{($course->id)}}"> 

        <label for="name">Nome: </label>
        <input type="text" name="name" id="name" placeholder="Digite nome da Aula" value="{{ old('name') }}"> <br><br>

        <label for="">Descrição: </label> <br>
        <textarea name="description" id="" cols="30" rows="10">{{ old('description') }}</textarea> <br><br>
        
        <button type="submit">Cadastrar</button>

    </form>
@endsection