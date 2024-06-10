@extends('layouts.admin')

@section('content')

    <h2>Editar o Curso</h2>

    <a href="{{ route('courses.index') }}"><button type="button">Listar</button></a><br><br>

    {{-- Mensagem de Sucesso ao cadastrar no DB --}}
    @if (session('success'))
        <p style="color: green">
            {{ session('success') }}
        </p>
    @endif

    {{-- Formulario de cadastro de curso  --}}
    <form action="{{ route('courses.update', ['course' => $course->id])}}" method="POST" >
        @csrf
        @method('PUT')

        <label for="name">Nome: </label>
        <input type="text" name="name" id="name" placeholder="Digite o nome do curso" value="{{ old('name', $course->name) }}" required>
        <br><br>
        <label for="price">Preço: </label>
        <input type="text" name="price" id="price" placeholder="Digite o preço do curso" value="{{ old('price', $course->price) }}" required>
        <br><br>

        <button type="submit">Editar</button>

    </form>
    
    
@endsection