<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Partner;
use App\Models\Article;
use Inertia\Inertia;

class AccueilController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Accueil', [
            'partners' => Partner::orderBy('order')->get(),
            'latestArticles' => Article::whereNotNull('published_at')
                ->latest()
                ->take(4)
                ->get()
                ->map(function ($article) {
                    return [
                        'title' => $article->title,
                        'excerpt' => mb_substr(strip_tags($article->content), 0, 80) . '...',
                        'category' => $article->category,
                        'tag' => $article->category === 'communique' ? 'Communiqué' : ($article->category === 'activite' ? 'Activité' : 'Publication'),
                        'date' => $article->published_at->format('d M. Y'),
                        'slug' => $article->slug,
                        'image' => $article->image,
                    ];
                }),
            'stats' => [
                'total_candidatures' => \App\Models\Candidature::count(),
                'today_candidatures' => \App\Models\Candidature::whereDate('created_at', now()->toDateString())->count(),
                'total_partners' => \App\Models\Partner::count(),
                'total_articles' => \App\Models\Article::count(),
                'total_subscribers' => \App\Models\Subscriber::count(),
                'online_users' => \Illuminate\Support\Facades\DB::table('sessions')->count(),
            ]
        ]);
    }
}
