@extends('layouts.app')

@section('content')
    <style>
        body {
            background-image: url('{{ asset('images/Wo.jpg') }}'); /* Image de fond */
            background-size: cover; /* S'assure que l'image couvre toute la page */
            background-position: center; /* Centre l'image */
            background-repeat: no-repeat; /* Evite que l'image se répète */
        }
    .card-img-top {
        width: 100%;
        height: 200px; /* Taille uniforme pour toutes les images */
        object-fit: cover; /* Recadre l'image pour remplir l'espace sans distorsion */
    }
   </style>

    

    <div class="container" style="background: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px;">
        <h1 class="mb-4 text-center">Liste complète des articles</h1>

        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="Image de {{ $article->titre }}">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $article->titre }}</h5>
                            <p class="card-text">{{ $article->description, 100 }}</p>
                            
                         

            {{-- QR Code qui redirige vers la page de l'article --}}
                            <div class="my-3">
                            {!! QrCode::size(100)->generate('http://192.168.1.10:8000/articles/' . $article->id) !!}



                            </div>

                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($articles->isEmpty())
            <p class="text-center">Aucun article trouvé.</p>
        @endif
    </div>
@endsection
