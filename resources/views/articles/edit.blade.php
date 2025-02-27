<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        /* ============================= */
        /*       STYLE GLOBAL            */
        /* ============================= */

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('{{ asset('images/Wo.jpg') }}') center/cover no-repeat;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: rgba(50, 50, 50, 0.8); /* Gris foncé avec un peu de transparence */
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #3498db;
        }

        /* ============================= */
        /* FORMULAIRE ET ERREURS */
        /* ============================= */

        /* Affichage des erreurs */
        .alert {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        /* ============================= */
        /* STYLE DES CHAMPS DU FORMULAIRE */
        /* ============================= */

        label {
            font-size: 14px;
            color: #fff;
            font-weight: 600;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #3498db;
            background-color: #eef6fc;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* ============================= */
        /* BOUTON */
        /* ============================= */

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* ============================= */
        /* LIEN RETOUR */
        /* ============================= */

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #3498db;
            font-weight: bold;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Modifier l'article</h1>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.update', $article->id) }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" value="{{ old('titre', $article->titre) }}" required class="@error('titre') border-red-500 @enderror">
                @error('titre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" required class="@error('description') border-red-500 @enderror">{{ old('description', $article->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="context">Contexte</label>
                <textarea name="context" class="@error('context') border-red-500 @enderror">{{ old('context', $article->context) }}</textarea>
                @error('context')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="instruction">Instructions</label>
                <textarea name="instruction" class="@error('instruction') border-red-500 @enderror">{{ old('instruction', $article->instruction) }}</textarea>
                @error('instruction')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Modifier l'image de l'article</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Mettre à jour</button>
        </form>

        <a href="{{ route('articles.index') }}" class="back-link">Retour</a>
    </div>

</body>
</html>
