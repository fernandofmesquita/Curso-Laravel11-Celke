<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Curso de Laravel</title>
</head>
<body>

    @yield('content')

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>