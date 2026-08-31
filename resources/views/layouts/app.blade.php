<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{!empty($meta_title) ? $meta_title : ''}} @yield('title')</title>

    <!-- Intégration de Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Intégration de styles personnalisés -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>

    @yield('content')



    <!-- Intégration de Bootstrap JS via CDN -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Intégration de scripts personnalisés -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>