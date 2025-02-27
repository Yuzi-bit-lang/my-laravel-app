<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Article</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('images/Wo.jpg') }}') center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 600px;
            background: rgba(50, 50, 50, 0.8); /* Gris foncé avec un peu de transparence */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #3498db;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4 text-white">Créer un Article</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="titre" class="form-label text-white">Titre</label>
                <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label text-white">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="context" class="form-label text-white">Contexte</label>
                <textarea name="context" id="context" class="form-control" rows="3">{{ old('context') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="instruction" class="form-label text-white">Instruction</label>
                <textarea name="instruction" id="instruction" class="form-control" rows="3">{{ old('instruction') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label text-white">Image de l'article</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Créer l'article</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
