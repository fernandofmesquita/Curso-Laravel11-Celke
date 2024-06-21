@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-2">Papéis</h2>
        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Papéis</li>
        </ol>
    </div>
    <div class="card mb-4 border-info shadow" >
        <div class="card-header hstack gap-2">
            <span>Listar Papéis</span>
            <span class="ms-auto">
                @can('store-role')
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                        Cadastrar
                    </button>
                @endcan
                
            </span>
        </div>

        <div class="card-body">
            {{-- Componente de mensagens de alerta --}}
            <x-alert />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell text-center">ID</th>
                        <th>Name</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Listar os registros --}}
                    @forelse ($roles as $role)
                    <tr>
                        <th class="d-none d-sm-table-cell text-center">{{ $role->id }}</th>
                        <td>{{ $role->name }}</td>
                        
                        <td class="d-md-flex flex-row justify-content-center">
                            @can('index-classe')
                               <a href="#" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list-ol"></i> Permissões</a>
                            @endcan
                                                        
                            @can('update-role')
                                <button type="button" class="btn btn-warning btn-sm me-1 mb-1 mb-md-0" data-bs-toggle="modal" data-bs-target="#editRoleModal-{{ $role->id }}">
                                    <i class="fa-regular fa-pen-to-square"></i> Editar
                                </button>
                            @endcan
                                                        

                            @can('destroy-role')
                                <form action="{{ route('roles.destroy', ['role' => $role->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm me-1 mb-1 mb-md-0" onclick="return confirm('Tem certeza que deseja EXCLUIR esse registro?')"><i class="fa-regular fa-trash-can"></i> Excluir</button>
                                </form>
                            @endcan
                            
                        </td>
                      </tr>

                    @empty
                        <div class="alert alert-danger" role="alert">
                            Não existe Usuários cadastrados
                        </div>
                    @endforelse
                </tbody>

            </table>
           
            {{-- imprimir Paginação
            {{ $roles->links() }} --}}
        </div>
    </div>
</div>

@can('store-role')
<!-- Modal de Cadastro -->
<div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('roles.store') }}" method="POST">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="createRoleModalLabel">Criar Novo Papel</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    @csrf
                
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" placeholder="Digite o nome do Papel" class="form-control" required>
                    </div>
  
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-sm btn-primary">Cadastrar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  @endcan

  @can('update-role')
  @foreach ($roles as $role)
  <!-- Modal de Edição -->
  <div class="modal fade" id="editRoleModal-{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <form action="{{ route('roles.update', $role->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="modal-header">
                      <h5 class="modal-title" id="editRoleModalLabel">Editar Papel</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" placeholder="Digite o nome do Papel" class="form-control" required>
                    </div>
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-sm btn-primary">Editar</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

@endforeach
@endcan


@endsection