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

    {{-- Validação de Campos --}}
    @if ($errors->any())
        <span style="color: red">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </span>
    @endif

    {{-- Formulario de cadastro de curso  --}}
    <form action="{{ route('courses.store') }}" method="POST" >
        @csrf
        @method('POST')

        <label for="name">Nome: </label>
        <input type="text" name="name" id="name" placeholder="Digite o nome do curso" value="{{ old('name') }}">
        <br><br>
        <label for="price">Preço: </label>
        <input type="text" name="price" id="price" placeholder="Digite o preço do curso" value="{{ old('price') }}">
        <br><br>

        <button type="submit">Cadastrar</button>

    </form>
    
@endsection