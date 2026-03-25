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
        // 1. SOPECAM - Pinned/Main News
        \App\Models\Article::create([
            'title_fr' => 'SOPECAM : Le Premier Ministre fixe les dates du 4ème RGPH et du RGAE',
            'title_en' => 'SOPECAM: Prime Minister sets 4th GPHC and GALC dates',
            'content_fr' => 'Un décret du Premier Ministre, Chef du Gouvernement, fixe officiellement les dates du dénombrement principal du 24 avril au 29 mai. Cette opération marquera une étape décisive pour la planification nationale.',
            'content_en' => 'A decree from the Prime Minister, Head of Government, officially sets the main enumeration dates from April 24 to May 29. This operation will mark a decisive step for national planning.',
            'category' => 'communique',
            'slug' => 'sopecam-dates-recensement',
            'published_at' => now(),
        ]);

        // 2. BUCREP
        \App\Models\Article::create([
            'title_fr' => 'BUCREP : Publication du rapport de la phase pilote de dénombrement',
            'title_en' => 'BUCREP: Publication of the enumeration pilot phase report',
            'content_fr' => 'Le Bureau Central des Recensements et des Études de Population (BUCREP) a publié ce jour les résultats de la phase pilote. Les outils numériques CAPI ont prouvé leur fiabilité sur le terrain.',
            'content_en' => 'The Central Bureau of Censuses and Population Studies (BUCREP) has today published the results of the pilot phase. CAPI digital tools have proven their reliability in the field.',
            'category' => 'publication',
            'slug' => 'bucrep-rapport-pilote',
            'published_at' => now()->subDays(1),
        ]);

        // 3. RGAE
        \App\Models\Article::create([
            'title_fr' => 'RGAE : Déploiement des modules sur l\'élevage et l\'aquaculture',
            'title_en' => 'GALC: Deployment of livestock and aquaculture modules',
            'content_fr' => 'Dans le cadre de la mutualisation, le RGAE lance ses modules spécifiques pour cartographier les exploitations agropastorales à travers le territoire national.',
            'content_en' => 'As part of the mutualization, the GALC is launching its specific modules to map agropastoral holdings across the national territory.',
            'category' => 'activite',
            'slug' => 'rgae-modules-elevage',
            'published_at' => now()->subDays(2),
        ]);

        // 4. Autre (Existant)
        \App\Models\Article::create([
            'title_fr' => 'Cartographie achevée : 98% des zones délimitées',
            'title_en' => 'Mapping completed: 98% of areas delimited',
            'content_fr' => 'L\'INS annonce l\'achèvement de la phase de cartographie, avec 98% des zones de dénombrement délimitées.',
            'content_en' => 'INS announces the completion of the mapping phase, with 98% of enumeration areas delimited.',
            'category' => 'activite',
            'slug' => 'cartographie-achevee',
            'published_at' => now()->subDays(5),
        ]);
    }
}
