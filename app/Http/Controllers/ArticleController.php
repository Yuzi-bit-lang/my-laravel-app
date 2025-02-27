<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;  // Utilisation de SnappyPdf

class ArticleController extends Controller
{
    // Afficher la liste des articles
    public function index()
    {
        $articles = Article::latest()->take(6)->get();
        return view('articles.index', compact('articles'));
    }

    // Afficher le formulaire de création d'un article
    public function create()
    {
        return view('articles.create');
    }

    // Enregistrer un nouvel article
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'context' => 'nullable|string',
            'instruction' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Sauvegarde de l'image si elle est présente
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Création de l'article
        $article = new Article([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'context' => $request->input('context'),
            'instruction' => $request->input('instruction'),
            'image' => $imagePath,
        ]);

        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article créé avec succès!');
    }

    // Afficher un article spécifique
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    // Afficher le formulaire d'édition d'un article
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    // Mettre à jour un article existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'context' => 'nullable|string',
            'instruction' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $article = Article::findOrFail($id);

        // Sauvegarde de l'image si elle est présente
        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                \Storage::delete('public/' . $imagePath);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $article->update([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'context' => $request->input('context'),
            'instruction' => $request->input('instruction'),
            'image' => $imagePath,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès!');
    }

    // Supprimer un article
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image) {
            \Storage::delete('public/' . $article->image);
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès!');
    }

    // Afficher tous les articles
    public function liste()
    {
        $articles = Article::all();
        return view('articles.liste', compact('articles'));
    }

    // Générer un PDF pour un article spécifique en utilisant wkhtmltopdf
    public function generatePDF($id)
{
    $article = Article::findOrFail($id);

    // Convertir l'image en une URL publique si elle existe
    if ($article->image) {
        $article->image = asset('storage/' . $article->image);  // Utiliser 'asset' pour générer l'URL
    }

    $pdf = PDF::loadView('articles.pdf', compact('article'))
              ->setOption('enable-local-file-access', true)  // Assurez-vous que l'accès local est activé
              ->setOption('javascript-delay', 1000)
              ->setOption('no-stop-slow-scripts', true);

    return $pdf->download('article-' . $article->id . '.pdf');
}

}
