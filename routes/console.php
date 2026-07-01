<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create {email} {name?}', function (string $email, string $name = 'Administrateur') {
    $password = \Illuminate\Support\Str::random(16);

    $user = User::updateOrCreate(
        ['email' => $email],
        [
            'name'              => $name,
            'password'          => Hash::make($password),
            'role'              => 'super_admin',
            'email_verified_at' => now(),
        ]
    );

    $this->info("Compte créé : {$email}");
    $this->warn("Mot de passe temporaire : {$password}");
    $this->line("Changez-le à la première connexion.");
})->purpose('Créer ou réinitialiser un compte super_admin');
