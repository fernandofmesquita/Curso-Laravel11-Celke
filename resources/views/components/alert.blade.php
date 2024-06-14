{{-- Mensagem de Sucesso ao cadastrar no DB --}}
@if (session('success'))
    <p style="color: green">
        {{ session('success') }}
    </p>
@endif

{{-- Mensagem de Erro ao cadastrar no DB --}}
@if (session('error'))
    <p style="color: red">
        {{ session('error') }}
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