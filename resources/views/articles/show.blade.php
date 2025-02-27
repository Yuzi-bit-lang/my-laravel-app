<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->titre }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <style>
        /* ============================= */
        /* STYLE GLOBAL */
        /* ============================= */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('{{ asset('images/Wo.jpg') }}') center/cover no-repeat;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 28px;
            color: #3498db;
            margin-bottom: 20px;
        }

        .article-content {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .article-content strong {
            color: #333;
        }

        /* ============================= */
        /* IMAGE */
        /* ============================= */
        .article-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            display: block;
            max-height: 400px;
            object-fit: contain;
            border-radius: 8px;
        }

        .article-image img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* ============================= */
        /* LIEN RETOUR */
        /* ============================= */
        .back-link {
            display: inline-block;
            margin-top: 30px;
            text-align: center;
            color: #3498db;
            font-weight: bold;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* ============================= */
        /* BOUTONS */
        /* ============================= */
        .article-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .article-buttons a,
        .article-buttons button {
            padding: 10px 15px;
            margin: 5px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .blue { background-color: #3498db; color: white; }
        .blue:hover { background-color: #2980b9; }

        .yellow { background-color: #f1c40f; color: white; }
        .yellow:hover { background-color: #f39c12; }

        .red { background-color: #e74c3c; color: white; }
        .red:hover { background-color: #c0392b; }

    </style>
</head>
<body>

<div class="container" id="article-content">
    <h1>{{ $article->titre }}</h1>

    <!-- Affichage de l'image de l'article -->
    @if ($article->image)
        <div class="article-image">
            <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article">
        </div>
    @endif

    <div class="article-content">
        <p><strong>Description:</strong> {{ $article->description }}</p>
        <p><strong>Contexte:</strong> {{ $article->context }}</p>
        <p><strong>Instructions:</strong> {{ $article->instruction }}</p>
    </div>

    <div class="article-buttons">
        <a href="{{ route('articles.edit', $article->id) }}" class="yellow">Éditer</a>
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onclick="return confirm('Voulez-vous vraiment supprimer cet article ?');" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="red">Supprimer</button>
        </form>
        
        <!-- Bouton Télécharger PDF (Client) -->
        <a href="#" onclick="generatePDF()" class="blue">📄 Télécharger PDF (Client)</a>
    </div>

    <!-- Lien pour revenir à la liste des articles -->
    <a href="{{ route('articles.index') }}" class="back-link">Retour à la liste</a>
</div>

<script>
    function generatePDF() {
        const element = document.getElementById('article-content'); // Sélection de l'élément à convertir
        html2pdf()
            .set({
                margin: 10,
                filename: '{{ $article->titre }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            })
            .from(element)
            .save();
    }
</script>

</body>
</html>
