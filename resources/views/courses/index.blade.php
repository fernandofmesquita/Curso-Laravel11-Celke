@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Cursos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listar os Cursos</li>
    </ol>
    <div class="row">
        <a href="{{ route('courses.create') }}"><button class="btn btn-primary" type="button">Cadastrar</button></a><br><br><hr><br>
        

        {{-- Componente de mensagens de alerta --}}
        <x-alert />

        
        {{-- Listar os registros --}}
        @forelse ($courses as $course)
            <b>ID:</b> {{ $course->id }}
            <b>Name:</b> {{ $course->name }}
            <b>Preço:</b> {{ 'R$ '. number_format($course->price, 2, ',', '.') }}<br>
            <b>Data de Cadastro:</b> {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}<br>
            <b>Data de Edição:</b> {{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Fortaleza')->format('d/m/Y H:i:s') }}<br><br>
            <a href="{{ route('classes.index', ['course' => $course->id]) }}"><button type="button">Aulas</button></a><br>
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
    </div>
</div>
      
@endsection