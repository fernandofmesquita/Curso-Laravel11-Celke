@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Bem-vindo ao Laravel 11</li>
    </ol>
    <div class="row">
        <a href="{{ route('courses.index') }}"><button class="btn btn-primary" type="button">Visualizar os Cursos</button></a>
                

        {{-- Componente de mensagens de alerta --}}
        <x-alert />

        {{-- <p> Data atual: {{ \Carbon\Carbon::now()->format('d/m/Y h:i:s') }}</p> --}}
    </div>
</div>
      
@endsection
