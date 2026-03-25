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
            'content_fr' => 'Le Premier Ministre, Chef du Gouvernement, Joseph Dion Ngute, a signé l\'Arrêté N° 039/CAB/PM fixant officiellement les dates du dénombrement principal du 4ème RGPH et du RGAE du 24 avril au 29 mai 2026. Cette opération d\'envergure, dont le budget est estimé à 13,2 milliards de FCFA, vise à actualiser les données démographiques et agricoles du pays, plus de 20 ans après le dernier recensement de 2005. Pour la première fois, le Cameroun opte pour un recensement mutualisé, intégrant les données humaines et agropastorales.',
            'content_en' => 'The Prime Minister, Head of Government, Joseph Dion Ngute, signed Decree No. 039/CAB/PM officially setting the dates for the 4th GPHC and GALC main enumeration from April 24 to May 29, 2026. This large-scale operation, with a budget estimated at 13.2 billion FCFA, aims to update the country\'s demographic and agricultural data, more than 20 years after the last census in 2005. For the first time, Cameroon is opting for a mutualized census, integrating human and agropastoral data.',
            'category' => 'communique',
            'slug' => 'sopecam-dates-recensement',
            'published_at' => now(),
        ]);

        // 2. BUCREP
        \App\Models\Article::create([
            'title_fr' => 'BUCREP : Publication du rapport de la phase pilote de dénombrement',
            'title_en' => 'BUCREP: Publication of the enumeration pilot phase report',
            'content_fr' => 'Le Bureau Central des Recensements et des Études de Population (BUCREP) a rendu public le rapport de la phase pilote menée en octobre 2025. Les tests conduits dans les zones d\'accès difficile ont validé l\'efficacité des tablettes numériques utilisant la technologie CAPI. Le dispositif technique est désormais prêt pour le déploiement des 30 000 agents recenseurs sur l\'ensemble du territoire national.',
            'content_en' => 'The Central Bureau of Censuses and Population Studies (BUCREP) has released the report on the pilot phase conducted in October 2025. Tests in hard-to-reach areas validated the effectiveness of digital tablets using CAPI technology. The technical system is now ready for the deployment of 30,000 census enumerators across the national territory.',
            'category' => 'publication',
            'slug' => 'bucrep-rapport-pilote',
            'published_at' => now()->subDays(1),
        ]);

        // 3. RGAE
        \App\Models\Article::create([
            'title_fr' => 'RGAE : Déploiement des modules sur l\'élevage et l\'aquaculture',
            'title_en' => 'GALC: Deployment of livestock and aquaculture modules',
            'content_fr' => 'Le Recensement Général de l\'Agriculture et de l\'Élevage (RGAE) franchit une nouvelle étape avec le lancement du module de base. Cette phase permettra de recenser toutes les exploitations agropastorales et aquacoles du pays pour élaborer des politiques de souveraineté alimentaire basées sur des statistiques précises.',
            'content_en' => 'The General Agriculture and Livestock Census (GALC) is reaching a new milestone with the launch of the basic module. This phase will allow for the enumeration of all agropastoral and aquaculture farms in the country to develop food sovereignty policies based on precise statistics.',
            'category' => 'activite',
            'slug' => 'rgae-modules-elevage',
            'published_at' => now()->subDays(2),
        ]);

        // 4. Autre (Existant)
        \App\Models\Article::create([
            'title_fr' => 'Cartographie achevée : 98% des zones délimitées',
            'title_en' => 'Mapping completed: 98% of areas delimited',
            'content_fr' => 'L\'INS annonce l\'achèvement de la phase de cartographie numérique. Plus de 35 000 zones de dénombrement ont été délimitées grâce à des outils de géolocalisation de pointe, garantissant une couverture exhaustive de chaque village et quartier du Cameroun.',
            'content_en' => 'INS announces the completion of the digital mapping phase. More than 35,000 enumeration areas have been delimited using state-of-the-art geolocation tools, guaranteeing exhaustive coverage of every village and neighborhood in Cameroon.',
            'category' => 'activite',
            'slug' => 'cartographie-achevee',
            'published_at' => now()->subDays(5),
        ]);
    }
}
