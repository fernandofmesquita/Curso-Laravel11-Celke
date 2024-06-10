@extends('layouts.admin')

@section('content')
    <h2>Listar os Cursos</h2>

    <a href="{{ route('courses.create') }}"><button  type="button">Cadastrar</button></a><br><br><hr><br>
    
    {{-- Mensagem de Sucesso ao cadastrar no DB --}}
    @if (session('success'))
        <p style="color: green">
            {{ session('success') }}
        </p>
    @endif


    {{-- Listar os registros --}}
    @forelse ($courses as $course)
        <b>ID:</b> {{ $course->id }}<br>
        <b>Name:</b> {{ $course->name }}<br>
        <b>Preço:</b> {{ 'R$ '. number_format($course->price, 2, ',', '.') }}<br>
        <b>Data de Cadastro:</b> {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}<br>
        <b>Data de Edição:</b> {{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Fortaleza')->format('d/m/Y H:i:s') }}<br><br>
        <a href="{{ route('courses.show', ['course' => $course->id]) }}"><button type="button">Visualizar</button></a><br>
        <a href="{{ route('courses.edit', ['course' => $course->id]) }}"><button type="button">Editar</button></a>

        <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Tem certeza que deseja EXCLUIR esse registro?')">Excluir</button>
        </form>
        <br><hr><br>
    @empty
        <p style="color: red">Não existe cursos cadastrados</p>
    @endforelse

    {{-- imprimir Paginação --}}
    {{-- {{ $courses->links() }} --}}
    
@endsection