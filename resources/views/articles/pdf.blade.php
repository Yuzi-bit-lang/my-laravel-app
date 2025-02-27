<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->titre }}</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h1 { color: #3498db; text-align: center; }
        .content { margin-top: 20px; }
        .image { text-align: center; margin-bottom: 20px; }
        img { max-width: 100%; height: auto; border-radius: 8px; }
    </style>
</head>
<body>

    <h1>{{ $article->titre }}</h1>

    @if ($article->image)
    <div class="image">
        <img src="{{ public_path('storage/' . $article->image) }}" alt="Image de l'article">
    </div>
    @endif

    <div class="content">
        <p><strong>Description:</strong> {{ $article->description }}</p>
        <p><strong>Contexte:</strong> {{ $article->context }}</p>
        <p><strong>Instructions:</strong> {{ $article->instruction }}</p>
    </div>

</body>
</html>
