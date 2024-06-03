@extends('layouts.admin')

@section('content')
    <h2>Listar os Cursos</h2>

    <a href="{{ route('courses.create') }}">Cadastrar Curso</a><br><br>
    
    {{-- Mensagem de Sucesso ao cadastrar no DB --}}
    @if (session('success'))
        <p style="color: green">
            {{ session('success') }}
        </p>
    @endif


    {{-- Listar os registros --}}
    @forelse ($courses as $course)
        {{ $course->id }}<br>
        {{ $course->name }}<br>
        {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}<br>
        {{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Fortaleza')->format('d/m/Y H:i:s') }}<br>
        <a href="{{ route('courses.show', ['course' => $course->id]) }}">Detalhes do Curso</a><br>
        <a href="{{ route('courses.edit', ['course' => $course->id]) }}">Editar Curso</a> <br><br>
        <hr>
    @empty
        <p style="color: red">Não existe cursos cadastrados</p>
    @endforelse

    {{-- imprimir Paginação --}}
    {{-- {{ $courses->links() }} --}}
    
@endsection