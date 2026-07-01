<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;

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
Route::get('/communication', function () { return Inertia::render('Communication', ['videos' => []]); })->name('communication');
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
    $validated = $request->validate([
        'first_name'          => 'required|string|max:100',
        'last_name'           => 'required|string|max:100',
        'gender'              => 'required|in:M,F',
        'birth_date'          => 'required|date',
        'id_card_number'      => 'required|string|max:50',
        'phone'               => 'required|string|max:30',
        'email'               => 'required|email|max:150',
        'region'              => 'required|string',
        'city'                => 'required|string|max:100',
        'education_level'     => 'required|string',
        'languages'           => 'required|string|max:255',
        'has_smartphone'      => 'required|in:oui,non',
        'fonctionnaire'       => 'required|in:oui,non',
        'previous_experience' => 'nullable|string|max:50',
        'experience_details'  => 'nullable|string|max:1000',
    ]);

    \App\Models\Candidature::create($validated);

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

Route::post('/chat', [ChatController::class, 'chat'])->name('chat');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        $c = \App\Models\Candidature::class;
        $byRegion = \App\Models\Candidature::selectRaw('region, count(*) as total')
            ->groupBy('region')->orderByDesc('total')->get()->toArray();
        $byStatus = \App\Models\Candidature::selectRaw('status, count(*) as total')
            ->groupBy('status')->pluck('total', 'status')->toArray();
        $byEducation = \App\Models\Candidature::selectRaw('education_level, count(*) as total')
            ->groupBy('education_level')->orderByDesc('total')->get()->toArray();

        return Inertia::render('Dashboard', [
            'articles_count'     => \App\Models\Article::count(),
            'partners_count'     => \App\Models\Partner::count(),
            'candidatures_count' => \App\Models\Candidature::count(),
            'pending_count'      => \App\Models\Candidature::where('status', 'pending')->count(),
            'accepted_count'     => \App\Models\Candidature::where('status', 'accepted')->count(),
            'rejected_count'     => \App\Models\Candidature::where('status', 'rejected')->count(),
            'by_region'          => $byRegion,
            'by_status'          => $byStatus,
            'by_education'       => $byEducation,
            'recent_articles'    => \App\Models\Article::latest()->take(3)->get()->map(fn($a) => [
                'title'      => $a->title_fr,
                'created_at' => $a->created_at->diffForHumans(),
            ]),
            'recent_candidatures' => \App\Models\Candidature::latest()->take(5)->get()->map(fn($c) => [
                'id'         => $c->id,
                'name'       => $c->first_name . ' ' . $c->last_name,
                'region'     => $c->region,
                'status'     => $c->status,
                'created_at' => $c->created_at->diffForHumans(),
            ]),
        ]);
    })->name('dashboard');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
        Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);

        Route::get('chatbot', [\App\Http\Controllers\Admin\ChatbotController::class, 'index'])->name('chatbot.index');
        Route::get('chatbot/create', [\App\Http\Controllers\Admin\ChatbotController::class, 'create'])->name('chatbot.create');
        Route::post('chatbot', [\App\Http\Controllers\Admin\ChatbotController::class, 'store'])->name('chatbot.store');
        Route::get('chatbot/{chatbot}/edit', [\App\Http\Controllers\Admin\ChatbotController::class, 'edit'])->name('chatbot.edit');
        Route::patch('chatbot/{chatbot}', [\App\Http\Controllers\Admin\ChatbotController::class, 'update'])->name('chatbot.update');
        Route::delete('chatbot/{chatbot}', [\App\Http\Controllers\Admin\ChatbotController::class, 'destroy'])->name('chatbot.destroy');
        Route::patch('chatbot/{chatbot}/toggle', [\App\Http\Controllers\Admin\ChatbotController::class, 'toggle'])->name('chatbot.toggle');
        Route::get('chatbot-settings', [\App\Http\Controllers\Admin\ChatbotController::class, 'settings'])->name('chatbot.settings');
        Route::patch('chatbot-settings', [\App\Http\Controllers\Admin\ChatbotController::class, 'updateSettings'])->name('chatbot.settings.update');

        Route::get('candidatures', function (Request $request) {
            $query = \App\Models\Candidature::latest();
            if ($request->filled('search')) {
                $s = $request->search;
                $query->where(fn($q) => $q->where('first_name', 'like', "%$s%")
                    ->orWhere('last_name', 'like', "%$s%")
                    ->orWhere('email', 'like', "%$s%")
                    ->orWhere('id_card_number', 'like', "%$s%"));
            }
            if ($request->filled('region'))  $query->where('region', $request->region);
            if ($request->filled('status'))  $query->where('status', $request->status);

            return Inertia::render('Admin/Candidatures', [
                'candidatures' => $query->paginate(25)->withQueryString(),
                'filters'      => $request->only(['search', 'region', 'status']),
                'stats'        => [
                    'total'    => \App\Models\Candidature::count(),
                    'pending'  => \App\Models\Candidature::where('status', 'pending')->count(),
                    'accepted' => \App\Models\Candidature::where('status', 'accepted')->count(),
                    'rejected' => \App\Models\Candidature::where('status', 'rejected')->count(),
                ],
            ]);
        })->name('candidatures.index');

        Route::get('candidatures/export', function (Request $request) {
            $query = \App\Models\Candidature::latest();
            if ($request->filled('region')) $query->where('region', $request->region);
            if ($request->filled('status')) $query->where('status', $request->status);

            $rows = $query->get();
            $filename = 'candidatures_' . date('Ymd_His') . '.csv';

            $headers = [
                'Content-Type'        => 'text/csv; charset=UTF-8',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ];

            $callback = function () use ($rows) {
                $handle = fopen('php://output', 'w');
                fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM UTF-8 pour Excel
                fputcsv($handle, ['ID','Prénom','Nom','Genre','Naissance','CNI','Téléphone','Email','Région','Ville','Niveau études','Langues','Smartphone','Fonctionnaire','Expérience','Statut','Date dépôt'], ';');
                foreach ($rows as $c) {
                    fputcsv($handle, [
                        $c->id, $c->first_name, $c->last_name, $c->gender,
                        $c->birth_date?->format('d/m/Y'), $c->id_card_number,
                        $c->phone, $c->email, $c->region, $c->city,
                        $c->education_level, $c->languages,
                        $c->has_smartphone, $c->fonctionnaire,
                        $c->previous_experience, $c->status,
                        $c->created_at->format('d/m/Y H:i'),
                    ], ';');
                }
                fclose($handle);
            };

            return response()->stream($callback, 200, $headers);
        })->name('candidatures.export');

        Route::patch('candidatures/{candidature}/status', function (Request $request, \App\Models\Candidature $candidature) {
            $request->validate(['status' => 'required|in:pending,reviewed,accepted,rejected']);
            $candidature->update(['status' => $request->status]);
            return back();
        })->name('candidatures.status');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
