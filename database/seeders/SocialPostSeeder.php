<?php

namespace Database\Seeders;

use App\Models\SocialPost;
use Illuminate\Database\Seeder;

class SocialPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialPost::updateOrCreate(
            ['platform' => 'fb', 'order' => 1],
            [
                'platform_name' => 'Facebook',
                'user' => 'BUCREP Officiel',
                'handle' => '@bucrep.cameroun',
                'date' => '18 Mai',
                'content' => "Démarrage des opérations de cartographie numérique dans la région du Centre. Nos équipes sont sur le terrain pour bâtir le Cameroun de demain ! #Census2026 #BUCREP",
                'image' => '/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg',
                'likes' => '1.2k',
                'comments' => '85',
                'shares' => '120',
                'link' => 'https://www.facebook.com/profile.php?id=61562950229317'
            ]
        );

        SocialPost::updateOrCreate(
            ['platform' => 'x', 'order' => 2],
            [
                'platform_name' => 'X',
                'user' => 'Recensement Cameroun',
                'handle' => '@recensement90',
                'date' => '17 Mai',
                'content' => "Le numéro vert officiel 8585 est désormais actif pour répondre à toutes vos interrogations sur la collecte des données. Appelez-nous gratuitement ! 📞 #Cameroun #Statistiques",
                'image' => null,
                'likes' => '450',
                'comments' => '12',
                'shares' => '56',
                'link' => 'https://x.com/recensement90'
            ]
        );

        SocialPost::updateOrCreate(
            ['platform' => 'ig', 'order' => 3],
            [
                'platform_name' => 'Instagram',
                'user' => 'BUCREP Official',
                'handle' => '@bucrep_cm',
                'date' => '16 Mai',
                'content' => "Formation intensive de nos superviseurs régionaux. La technologie CAPI sur tablettes numériques garantit la sécurité et la confidentialité absolue de vos données. 💻🛡️ #BUCREP",
                'image' => '/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg',
                'likes' => '2.8k',
                'comments' => '42',
                'shares' => null,
                'link' => 'https://www.facebook.com/profile.php?id=61562950229317'
            ]
        );

        SocialPost::updateOrCreate(
            ['platform' => 'fb', 'order' => 4],
            [
                'platform_name' => 'Facebook',
                'user' => 'INS Cameroun',
                'handle' => '@ins_cameroun',
                'date' => '15 Mai',
                'content' => "Le recensement général est un acte civique d'utilité publique. Ensemble pour une planification fiable et efficace du Cameroun émergent ! 🇨🇲 #SecretStatistique #INS",
                'image' => null,
                'likes' => '890',
                'comments' => '34',
                'shares' => '45',
                'link' => 'https://www.facebook.com/profile.php?id=61562950229317'
            ]
        );
    }
}
