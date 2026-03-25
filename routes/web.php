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
Route::post('/candidature', [\App\Http\Controllers\CandidatureController::class, 'store'])->name('candidature.store');

Route::get('/recherche', function () {
    return Inertia::render('Recherche');
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
