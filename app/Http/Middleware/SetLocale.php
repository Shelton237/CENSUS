<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // Get browser preferred language
            $languages = $request->getLanguages();
            $preferred = !empty($languages) ? substr($languages[0], 0, 2) : 'fr';

            // Switch to English if it's explicitly preferred, otherwise default to French
            if ($preferred === 'en') {
                App::setLocale('en');
            } else {
                App::setLocale('fr');
            }
        }

        return $next($request);
    }
}
