<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:M,F',
            'birth_date' => 'required|date',
            'id_card_number' => 'required|string|max:100|unique:candidatures,id_card_number',
            
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'region' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            
            'education_level' => 'required|string|max:100',
            'languages' => 'nullable|array',
            'previous_experience' => 'required|boolean',
            'experience_details' => 'nullable|string'
        ]);

        // Optionnel : On peut envoyer un email ici.

        \App\Models\Candidature::create($validated);

        return redirect()->back()->with('success', 'Votre candidature a été soumise avec succès ! Vous serez contacté par SMS ou E-mail très prochainement.');
    }
}
