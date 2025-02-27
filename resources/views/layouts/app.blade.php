<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Application')</title>
    
    <!-- Ajout de Bootstrap via CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <header>
        <!-- Ton header ici, par exemple un menu de navigation -->
        <nav>
            <ul>
                <li><a href="{{ route('articles.index') }}">Articles</a></li>
                <!-- Ajoute d'autres liens ici -->
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Mon Application</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
