<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'excerpt' => mb_substr(strip_tags($article->content), 0, 100) . '...',
                    'category' => $article->category,
                    'tag' => $article->category === 'communique' ? 'Communiqué' : ($article->category === 'activite' ? 'Activité' : 'Publication'),
                    'date' => $article->published_at->format('d M. Y'),
                    'slug' => $article->slug,
                    'image' => $article->image,
                ];
            });

        return Inertia::render('Actualites', [
            'articles' => $articles
        ]);
    }

    public function show(Article $article)
    {
        return Inertia::render('Article', [
            'article' => [
                'id' => $article->id,
                'title' => $article->title,
                'content' => $article->content,
                'category' => $article->category,
                'tag' => $article->category === 'communique' ? 'Communiqué' : ($article->category === 'activite' ? 'Activité' : 'Publication'),
                'date' => $article->published_at->format('d M. Y'),
                'image' => $article->image,
            ],
            'recentArticles' => Article::where('id', '!=', $article->id)
                ->whereNotNull('published_at')
                ->latest()
                ->take(3)
                ->get()
                ->map(function ($art) {
                    return [
                        'title' => $art->title,
                        'category' => $art->category,
                        'tag' => $art->category === 'communique' ? 'Communiqué' : ($art->category === 'activite' ? 'Activité' : 'Publication'),
                        'date' => $art->published_at->format('d M. Y'),
                        'slug' => $art->slug,
                    ];
                })
        ]);
    }
}
