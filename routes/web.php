<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\NewsletterController;

Route::get('/', function () {
    return Inertia::render('Landing');
});

Route::get('/accueil', function () {
    return Inertia::render('Accueil');
});

Route::get('/actualites', function () {
    return Inertia::render('Actualites');
});

Route::get('/apropos', function () {
    return Inertia::render('Apropos');
});

Route::get('/activites', function () {
    return Inertia::render('Activites');
});

Route::get('/article', function () {
    return Inertia::render('Article');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

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

require __DIR__.'/auth.php';
