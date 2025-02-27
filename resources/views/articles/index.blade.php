<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <style>
        body {
            background: url('{{ asset('images/Wo.jpg') }}') center/cover no-repeat;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .card img {
            height: 180px;
            object-fit: cover;
        }
        .article-container {
            display: flex;
            flex-wrap: nowrap;
            gap: 30px;
            padding: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }
        .article-container::-webkit-scrollbar {
            display: none;
        }
        .btn-add {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        #qr-reader-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        #qr-reader {
            width: 400px;
            height: 400px;
            border: 3px solid #4CAF50; /* Bordure autour de la zone de scan */
            position: relative;
            overflow: hidden;
        }
        #qr-reader-frame {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 250px;
            height: 250px;
            border: 3px dashed #4CAF50; /* Cadre visible de la zone de scan */
        }
        .scanner-controls {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .scanner-controls button {
            width: 100px;
        }
    </style>
</head>
<body>
    <a href="{{ route('articles.create') }}" class="btn btn-success btn-add">
        ➕ Ajouter un article
    </a>

    <div class="d-flex align-items-center justify-content-between w-100">
        <button class="btn btn-outline-secondary" onclick="scrollCarousel(-1)">❮</button>
        <div class="d-flex article-container p-3 rounded">
            @foreach($articles as $article)
            <div class="card shadow-sm" style="width: 18rem; flex: 0 0 auto;">
                <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/default-placeholder.png') }}" class="card-img-top" alt="Image de l'article">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $article->titre }}</h5>
                    <p class="card-text">{{ $article->description, 100 }}</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">👁️</a>
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">✏️</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">🗑️</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button class="btn btn-outline-secondary" onclick="scrollCarousel(1)">❯</button>
    </div>

    <a href="{{ route('listearticles') }}" class="btn btn-primary mt-3">📜 Voir plus</a>

    <!-- Bouton pour ouvrir le scanner -->
    <button class="btn btn-info mt-3" onclick="startScanner()">🎥 Scanner le QR Code</button>

    <!-- Conteneur pour afficher le scanner à côté du bouton -->
    <div id="qr-reader-container">
        <div id="qr-reader">
            <div id="qr-reader-frame"></div>
        </div>
        <div class="scanner-controls">
            <button class="btn btn-danger" onclick="stopScanner()">❌ Annuler</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js" integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function scrollCarousel(direction) {
            let carousel = document.querySelector('.article-container');
            let scrollAmount = 400;
            carousel.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
        }

        // Fonction pour démarrer le scanner QR
        function startScanner() {
            // Afficher le conteneur du scanner et démarrer la lecture
            document.getElementById('qr-reader-container').style.display = 'flex';
            
            const qrCodeScanner = new Html5Qrcode("qr-reader");

            qrCodeScanner.start(
                { facingMode: "environment" }, 
                {
                    fps: 10,    // Frame par seconde
                    qrbox: 250   // Taille de la zone de scan
                },
                (decodedText, decodedResult) => {
                    // Lorsqu'un QR code est scanné, rediriger vers l'URL du QR
                    window.location.href = decodedText;
                },
                (errorMessage) => {
                    // Gérer l'erreur de scan
                    console.error(errorMessage);
                }
            ).catch(err => {
                console.error("Erreur lors de l'activation de la caméra", err);
                alert("Impossible d'accéder à la caméra. Veuillez vérifier les autorisations.");
            });
        }

        // Fonction pour arrêter le scanner
        function stopScanner() {
            document.getElementById('qr-reader-container').style.display = 'none';
            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    const cameraId = devices[0].id;
                    Html5Qrcode.stop(cameraId).then(() => {
                        console.log("Scanner arrêté.");
                    }).catch(err => {
                        console.error("Erreur lors de l'arrêt du scanner", err);
                    });
                }
            });
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
