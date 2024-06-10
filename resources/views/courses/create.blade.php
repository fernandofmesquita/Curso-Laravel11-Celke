@extends('layouts.admin')

@section('content')

    <h2>Cadastrar o Curso</h2>

    <a href="{{ route('courses.index') }}"><button type="button">Listar</button></a><br><br>

    {{-- Mensagem de Sucesso ao cadastrar no DB --}}
    @if (session('success'))
        <p style="color: green">
            {{ session('success') }}
        </p>
    @endif

    {{-- Formulario de cadastro de curso  --}}
    <form action="{{ route('courses.store') }}" method="POST" >
        @csrf
        @method('POST')

        <label for="">Nome: </label>
        <input type="text" name="name" id="name" placeholder="Digite o nome do curso" value="{{ old('name') }}" required>
        <br><br>

        <button type="submit">Cadastrar</button>

    </form>
    
@endsection