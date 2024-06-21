@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Página</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('permission.index') }}" class="text-decoration-none">Páginas</a>
                </li>
                <li class="breadcrumb-item active">Página</li>
            </ol>
        </div>

        <div class="card mb-4 border-success shadow">
            <div class="card-header hstack gap-2">
                <span>Cadastrar</span>

                <span class="ms-auto d-sm-flex flex-row">

                    @can('index-permission')
                        <a href="{{ route('permission.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i
                                class="fa-solid fa-list"></i> Listar</a>
                    @endcan
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <form action="{{ route('permission.store') }}" method="POST" class="row g-3">
                    @csrf
                    @method('POST')

                    <div class="col-12">
                        <label for="title" class="form-label">Título: </label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Título da página"
                            value="{{ old('title') }}">
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label">Nome: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome da página"
                            value="{{ old('name') }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success bt-sm">Cadastrar</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
