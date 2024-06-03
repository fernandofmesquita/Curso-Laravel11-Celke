@extends('layouts.admin')

@section('content')
    <h2>Listar os Cursos</h2>

    <a href="{{ route('courses.create') }}">Cadastrar Curso</a><br>
    <a href="{{ route('courses.show') }}">Detalhes do Curso</a><br><br>

    {{-- Listar os registros --}}
    @forelse ($courses as $course)
        {{ $course->id }}<br>
        {{ $course->name }}<br>
        {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y h:i:s') }}<br>
        {{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Fortaleza')->format('d/m/Y h:i:s') }}<br>
        <hr>
    @empty
        <p style="color: red">Não existe cursos cadastrados</p>
    @endforelse

    {{-- imprimir Paginação --}}
    {{-- {{ $courses->links() }} --}}
    
@endsection