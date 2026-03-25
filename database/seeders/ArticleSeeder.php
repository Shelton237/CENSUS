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
            'content_fr' => 'Le Premier Ministre, Chef du Gouvernement, Joseph Dion Ngute, a officiellement rendu public l\'Arrêté N° 039/CAB/PM daté du 06 mars 2026, fixant le calendrier du dénombrement principal pour le 4ème Recensement Général de la Population et de l\'Habitat (RGPH) et le module de base du Recensement Général de l\'Agriculture et de l\'Élevage (RGAE). Selon ce texte réglementaire, les opérations de collecte terrain se dérouleront sur l\'ensemble du territoire national du 24 avril au 29 mai 2026.\n\nDotée d\'un budget global de 13,2 milliards de FCFA, cette opération de grande envergure bénéficie du soutien de partenaires stratégiques tels que l\'UNFPA et la Banque Mondiale. Pour la première fois de son histoire, le Cameroun opte pour un recensement mutualisé, permettant de recueillir simultanément des données démographiques et agropastorales. L\'objectif est d\'actualiser les bases de données vieillissantes du dernier recensement de 2005 afin d\'orienter plus efficacement les politiques de développement de l\'émergence à l\'horizon 2035.\n\nLe Gouvernement appelle à la mobilisation de tous les citoyens pour réserver un accueil chaleureux aux 30 000 agents recenseurs qui seront déployés.',
            'content_en' => 'The Prime Minister, Head of Government, Joseph Dion Ngute, has officially released Decree No. 039/CAB/PM dated March 06, 2026, setting the schedule for the main enumeration for the 4th General Population and Housing Census (GPHC) and the basic module of the General Agriculture and Livestock Census (GALC). According to this regulatory text, field collection operations will take place across the national territory from April 24 to May 29, 2026.\n\nWith an overall budget of 13.2 billion FCFA, this large-scale operation benefits from the support of strategic partners such as UNFPA and the World Bank. For the first time in its history, Cameroon is choosing a mutualized census, allowing demographic and agropastoral data to be collected simultaneously. The objective is to update the aging databases of the last census in 2005 to more effectively guide development policies for emergence by 2035.\n\nThe Government calls for the mobilization of all citizens to give a warm welcome to the 30,000 census enumerators who will be deployed.',
            'category' => 'communique',
            'slug' => 'sopecam-dates-recensement',
            'published_at' => now(),
        ]);

        // 2. BUCREP
        \App\Models\Article::create([
            'title_fr' => 'BUCREP : Publication du rapport de la phase pilote de dénombrement',
            'title_en' => 'BUCREP: Publication of the enumeration pilot phase report',
            'content_fr' => 'Le Bureau Central des Recensements et des Études de Population (BUCREP) a publié aujourd\'hui son rapport technique suite à la phase pilote menée avec succès en octobre 2025 dans plusieurs zones tests du pays. Ce rapport met en lumière l\'efficacité de la méthodologie CAPI (Computer Assisted Personal Interviewing), qui utilise des tablettes numériques équipées de systèmes de géolocalisation pour garantir une collecte de données en temps réel et sans erreur.\n\nLes tests conduits dans des conditions géographiques et climatiques variées ont permis d\'affiner les outils de collecte et d\'assurer la sécurité des données transmises instantanément vers les serveurs centraux. Ce succès technique pave la voie au recrutement et à la formation intensive de plus de 30 000 agents de terrain, dont les candidatures sont actuellement en cours de traitement sur le portail national de recrutement.',
            'content_en' => 'The Central Bureau of Censuses and Population Studies (BUCREP) today published its technical report following the pilot phase successfully conducted in October 2025 in several test areas of the country. This report highlights the effectiveness of the CAPI (Computer Assisted Personal Interviewing) methodology, which uses digital tablets equipped with geolocation systems to guarantee real-time and error-free data collection.\n\nTests conducted under varied geographical and climatic conditions have refined collection tools and ensured the security of data transmitted instantly to central servers. This technical success paves the way for the intensive recruitment and training of more than 30,000 field agents, whose applications are currently being processed on the national recruitment portal.',
            'category' => 'publication',
            'slug' => 'bucrep-rapport-pilote',
            'published_at' => now()->subDays(1),
        ]);

        // 3. RGAE
        \App\Models\Article::create([
            'title_fr' => 'RGAE : Déploiement des modules sur l\'élevage et l\'aquaculture',
            'title_en' => 'GALC: Deployment of livestock and aquaculture modules',
            'content_fr' => 'Dans le cadre du Recensement Général de l\'Agriculture et de l\'Élevage (RGAE), le module de base concernant l\'élevage et l\'aquaculture entre dans sa phase opérationnelle. Cette composante essentielle de la mutualisation vise à identifier et cartographier exhaustivement toutes les exploitations pastorales, piscicoles et avicoles du Cameroun.\n\nLes données recueillies permettront de mieux structurer les filières de production animale, d\'évaluer le cheptel national et de planifier des investissements ciblés pour atteindre la souveraineté alimentaire. Les agents spécialisés du RGAE travailleront conjointement avec les équipes du RGPH pour optimiser les visites dans les ménages ruraux et urbains, assurant ainsi une couverture complète du potentiel agropastoral camerounais.',
            'content_en' => 'As part of the General Agriculture and Livestock Census (GALC), the basic module concerning livestock and aquaculture is entering its operational phase. This essential component of mutualization aims to exhaustively identify and map all pastoral, fish, and poultry farms in Cameroon.\n\nThe gathered data will allow for better structuring of animal production chains, evaluating the national livestock, and planning targeted investments to achieve food sovereignty. Specialized GALC agents will work jointly with GPHC teams to optimize visits to rural and urban households, thus ensuring complete coverage of Cameroon\'s agropastoral potential.',
            'category' => 'activite',
            'slug' => 'rgae-modules-elevage',
            'published_at' => now()->subDays(2),
        ]);

        // 4. Autre (Existant)
        \App\Models\Article::create([
            'title_fr' => 'Cartographie achevée : 35 000 zones de dénombrement délimitées',
            'title_en' => 'Mapping completed: 35,000 enumeration areas delimited',
            'content_fr' => 'L\'Institut National de la Statistique (INS) a annoncé l\'achèvement officiel de la phase de cartographie numérique sur l\'ensemble des dix régions du Cameroun. Ce travail colossal a permis de découper le pays en plus de 35 000 zones de dénombrement (ZD), chaque zone étant calibrée pour être couverte par un agent recenseur en 15 jours de dénombrement.\n\nGrâce à l\'utilisation d\'images satellites haute définition et de relevés GPS, chaque village, campement et quartier a été répertorié. Cette cartographie de précision constitue la pierre angulaire du succès du dénombrement de 2026, garantissant qu\'aucun ménage ne soit oublié lors de l\'opération nationale.',
            'content_en' => 'The National Institute of Statistics (INS) announced the official completion of the digital mapping phase across all ten regions of Cameroon. This colossal work has allowed the country to be divided into more than 35,000 enumeration areas (EA), each area being calibrated to be covered by a census agent in 15 days of enumeration.\n\nThanks to the use of high-definition satellite images and GPS surveys, every village, camp, and neighborhood has been listed. This precision mapping is the cornerstone of the success of the 2026 enumeration, guaranteeing that no household is forgotten during the national operation.',
            'category' => 'activite',
            'slug' => 'cartographie-achevee',
            'published_at' => now()->subDays(5),
        ]);
    }
}
