<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return Inertia::render('Landing');
});

Route::get('/accueil', \App\Http\Controllers\AccueilController::class)->name('accueil');

Route::get('/apropos', function () { return Inertia::render('Apropos'); });
Route::get('/activites', function () { return Inertia::render('Activites'); });
Route::get('/resultats-donnees', function () { return Inertia::render('ResultatsDonnees'); })->name('resultats-donnees');
Route::get('/phototheque', function () { return Inertia::render('Phototheque'); })->name('phototheque');
Route::get('/identification-agents', function () { return Inertia::render('AgentIdentification'); })->name('identification-agents');
Route::get('/ressources', function () { return Inertia::render('Ressources'); })->name('ressources');
Route::get('/partenaires', function () {
    return Inertia::render('Partenaires', [
        'dbPartners' => \App\Models\Partner::orderBy('order')->get(['name', 'logo', 'website'])->toArray()
    ]);
})->name('partenaires');

use App\Http\Controllers\ArticleController;
Route::get('/actualites', [ArticleController::class, 'index'])->name('actualites.index');
Route::get('/actualites/{article}', [ArticleController::class, 'show'])->name('actualites.show');
Route::get('/article', function () { return redirect()->route('actualites.index'); }); 

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::get('/candidature', function () {
    return Inertia::render('Candidature');
})->name('candidature');

Route::post('/candidature', function (Request $request) {
    $request->validate([
        'first_name'      => 'required|string|max:100',
        'last_name'       => 'required|string|max:100',
        'gender'          => 'required|in:M,F',
        'birth_date'      => 'required|date',
        'id_card_number'  => 'required|string|max:50',
        'phone'           => 'required|string|max:30',
        'email'           => 'required|email|max:150',
        'region'          => 'required|string',
        'city'            => 'required|string|max:100',
        'education_level' => 'required|string',
        'languages'       => 'required|string|max:255',
        'has_smartphone'  => 'required|in:oui,non',
        'fonctionnaire'   => 'required|in:oui,non',
    ]);

    \Illuminate\Support\Facades\Log::info('Nouvelle candidature', $request->only([
        'first_name', 'last_name', 'gender', 'birth_date', 'phone', 'email', 'region', 'city', 'education_level', 'has_smartphone', 'fonctionnaire',
    ]));

    return back();
})->name('candidature.store');

Route::get('/recherche', function (Request $request) {
    $query = $request->query('q');
    
    $results = [];
    if ($query) {
        $results = \App\Models\Article::whereNotNull('published_at')
            ->where(function($q) use ($query) {
                $q->where('title_fr', 'like', "%{$query}%")
                  ->orWhere('title_en', 'like', "%{$query}%")
                  ->orWhere('content_fr', 'like', "%{$query}%")
                  ->orWhere('content_en', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%");
            })
            ->latest('published_at')
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
                    'media_type' => $article->media_type ?: 'image',
                    'image' => $article->image,
                    'video' => $article->video,
                ];
            });
    }

    return Inertia::render('Recherche', [
        'results' => $results,
        'searchQuery' => $query
    ]);
});

use Illuminate\Http\Request;

Route::get('/set-locale/{locale}', function ($locale, Request $request) {
    if (in_array($locale, ['fr', 'en'])) {
        session(['locale' => $locale]);
    }
    
    $referer = $request->headers->get('referer');
    if (!$referer || rtrim($referer, '/') === url('/')) {
        return redirect('/accueil');
    }
    
    return back();
})->name('set-locale');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'articles_count' => \App\Models\Article::count(),
            'partners_count' => \App\Models\Partner::count(),
            'recent_articles' => \App\Models\Article::latest()->take(3)->get()->map(function($a) {
                return [
                    'title' => $a->title_fr,
                    'created_at' => $a->created_at->diffForHumans(),
                ];
            }),
        ]);
    })->name('dashboard');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
        Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
