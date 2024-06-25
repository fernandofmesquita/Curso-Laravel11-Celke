{{-- Mensagem de Sucesso ao cadastrar no DB --}}
@if (session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Pronto!', "{{ session('success') }}", 'success');
        })
    </script>
@endif

{{-- Mensagem de Erro ao cadastrar no DB --}}
@if (session()->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Erro!', "{{ session('error') }}", 'error');
        })
    </script>
@endif


{{-- Validação de Campos --}}
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
    </div>
@endif