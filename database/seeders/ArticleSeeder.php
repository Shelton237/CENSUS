<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Article::create([
            'title_fr' => 'Démarrage officiel du dénombrement : ce qu\'il faut savoir',
            'title_en' => 'Official start of enumeration: what you need to know',
            'content_fr' => 'Le Gouverneur de la région du Centre informe les populations que les équipes de recensement sont désormais actives...',
            'content_en' => 'The Governor of the Center region informs the populations that the census teams are now active...',
            'category' => 'communique',
            'slug' => 'demarrage-officiel-denombrement',
            'published_at' => now(),
        ]);

        \App\Models\Article::create([
            'title_fr' => 'Cartographie achevée : 98% des zones délimitées',
            'title_en' => 'Mapping completed: 98% of areas delimited',
            'content_fr' => 'L\'INS annonce l\'achèvement de la phase de cartographie, avec 98% des zones de dénombrement délimitées.',
            'content_en' => 'INS announces the completion of the mapping phase, with 98% of enumeration areas delimited.',
            'category' => 'activite',
            'slug' => 'cartographie-achevee',
            'published_at' => now()->subDays(2),
        ]);
    }
}
