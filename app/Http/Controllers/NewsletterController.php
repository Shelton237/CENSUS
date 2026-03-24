<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'email.required' => __('Veuillez entrer une adresse email.'),
            'email.email' => __('L\'adresse email n\'est pas valide.'),
            'email.unique' => __('Cette adresse email est déjà inscrite à notre newsletter.')
        ]);

        Subscriber::create([
            'email' => $request->email
        ]);

        return back()->with('success', __('Merci pour votre inscription à notre Newsletter !'));
    }
}
