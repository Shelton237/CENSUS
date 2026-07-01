<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@census.cm')],
            [
                'name'              => env('ADMIN_NAME', 'Administrateur'),
                'password'          => Hash::make(env('ADMIN_PASSWORD', Str::random(32))),
                'role'              => 'super_admin',
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            PartnerSeeder::class,
            SocialPostSeeder::class,
        ]);
    }
}
