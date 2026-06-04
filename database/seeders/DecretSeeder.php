<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class DecretSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title_fr' => 'Arrêté N°039/CAB/PM fixant la période de dénombrement RGPH/RGAE 2026',
                'title_en' => 'Order N°039/CAB/PM setting the RGPH/RGAE 2026 enumeration period',
                'content_fr' => '<p>Le Premier Ministre, Chef du Gouvernement, a signé l\'<strong>Arrêté N°039/CAB/PM du 06 mars 2026</strong> fixant la période de dénombrement principal mutualisé RGPH/RGAE.</p>'
                    . '<p>La période de dénombrement est fixée du <strong>24 avril au 29 mai 2026</strong> sur l\'ensemble du territoire national.</p>'
                    . '<p>Pendant cette période, les agents recenseurs munis de leurs tablettes officielles et de leurs cartes de mission se déploieront dans tous les ménages et exploitations agricoles du Cameroun.</p>'
                    . '<p><a href="/assets/documents/decrets/Arr%C3%AAt%C3%A9%20fixant%20date%20de%20d%C3%A9but%20et%20fin%20des%20op%C3%A9rations%20de%20recensement.pdf" target="_blank" rel="noopener" style="color:#204138;font-weight:bold;">📄 Télécharger l\'arrêté complet (PDF)</a></p>',
                'content_en' => '<p>The Prime Minister signed <strong>Order N°039/CAB/PM of 06 March 2026</strong> setting the joint RGPH/RGAE enumeration period.</p>'
                    . '<p>The enumeration period is set from <strong>24 April to 29 May 2026</strong> across the national territory.</p>'
                    . '<p>During this period, census agents equipped with official tablets and mission cards will be deployed in all households and agricultural holdings in Cameroon.</p>'
                    . '<p><a href="/assets/documents/decrets/Arr%C3%AAt%C3%A9%20fixant%20date%20de%20d%C3%A9but%20et%20fin%20des%20op%C3%A9rations%20de%20recensement.pdf" target="_blank" rel="noopener" style="color:#204138;font-weight:bold;">📄 Download the full order (PDF)</a></p>',
                'category' => 'communique',
                'media_type' => 'image',
                'image' => null,
                'published_at' => '2026-03-06 09:00:00',
                'slug' => 'arrete-039-cab-pm-periode-denombrement-rgph-rgae-2026',
            ],
            [
                'title_fr' => 'Décret Présidentiel N°2015/397 instituant le 4ème RGPH du Cameroun',
                'title_en' => 'Presidential Decree N°2015/397 establishing the 4th RGPH of Cameroon',
                'content_fr' => '<p>Le <strong>Décret Présidentiel N°2015/397 du 15 septembre 2015</strong> institue le 4ème Recensement Général de la Population et de l\'Habitat (RGPH) du Cameroun.</p>'
                    . '<p>Ce décret désigne le Bureau Central des Recensements et des Études de Population (<strong>BUCREP</strong>) comme maître d\'œuvre de l\'opération, sous tutelle du Ministère de l\'Économie, de la Planification et de l\'Aménagement du Territoire (MINEPAT).</p>'
                    . '<p>Le RGPH est une opération statistique décennale qui vise à dénombrer l\'ensemble de la population résidant sur le territoire national et à collecter des données sur leurs caractéristiques démographiques, sociales et économiques.</p>'
                    . '<p><a href="/assets/documents/decrets/D%C3%A9cret%20N%C2%B02015-397%20du%2015-09-2015%20instituant%20le%204e%20RGPH.pdf" target="_blank" rel="noopener" style="color:#204138;font-weight:bold;">📄 Télécharger le décret complet (PDF)</a></p>',
                'content_en' => '<p><strong>Presidential Decree N°2015/397 of 15 September 2015</strong> establishes the 4th General Population and Housing Census (RGPH) of Cameroon.</p>'
                    . '<p>This decree designates the Bureau Central des Recensements et des Études de Population (<strong>BUCREP</strong>) as project manager, under the supervision of the Ministry of Economy, Planning and Regional Development (MINEPAT).</p>'
                    . '<p>The RGPH is a decennial statistical operation aimed at counting the entire population residing on national territory and collecting data on their demographic, social and economic characteristics.</p>'
                    . '<p><a href="/assets/documents/decrets/D%C3%A9cret%20N%C2%B02015-397%20du%2015-09-2015%20instituant%20le%204e%20RGPH.pdf" target="_blank" rel="noopener" style="color:#204138;font-weight:bold;">📄 Download the full decree (PDF)</a></p>',
                'category' => 'communique',
                'media_type' => 'image',
                'image' => null,
                'published_at' => '2015-09-15 09:00:00',
                'slug' => 'decret-2015-397-instituant-4eme-rgph-cameroun',
            ],
            [
                'title_fr' => 'Décret Présidentiel N°2015/292 instituant le RGAE du Cameroun',
                'title_en' => 'Presidential Decree N°2015/292 establishing the RGAE of Cameroon',
                'content_fr' => '<p>Le <strong>Décret Présidentiel N°2015/292 du 29 juin 2015</strong> institue le Recensement Général de l\'Agriculture et de l\'Élevage (RGAE) du Cameroun.</p>'
                    . '<p>Le RGAE est une opération statistique visant à collecter des données structurelles sur les exploitations agropastorales camerounaises — superficies cultivées, cheptels, pratiques agricoles, accès aux intrants — afin de planifier le développement du secteur agricole national.</p>'
                    . '<p>Le BUCREP, en collaboration avec la FAO, assure la maîtrise d\'œuvre technique de cette opération mutualisée avec le RGPH.</p>'
                    . '<p><a href="/assets/documents/decrets/DECRET%20INSTITUANT%20LE%20RGAE_CMR.pdf" target="_blank" rel="noopener" style="color:#204138;font-weight:bold;">📄 Télécharger le décret complet (PDF)</a></p>',
                'content_en' => '<p><strong>Presidential Decree N°2015/292 of 29 June 2015</strong> establishes the General Agricultural and Livestock Census (RGAE) of Cameroon.</p>'
                    . '<p>The RGAE is a statistical operation aimed at collecting structural data on Cameroonian agropastoral holdings — cultivated areas, livestock, farming practices, access to inputs — in order to plan the development of the national agricultural sector.</p>'
                    . '<p>BUCREP, in collaboration with FAO, is the technical project manager for this operation, jointly conducted with the RGPH.</p>'
                    . '<p><a href="/assets/documents/decrets/DECRET%20INSTITUANT%20LE%20RGAE_CMR.pdf" target="_blank" rel="noopener" style="color:#204138;font-weight:bold;">📄 Download the full decree (PDF)</a></p>',
                'category' => 'communique',
                'media_type' => 'image',
                'image' => null,
                'published_at' => '2015-06-29 09:00:00',
                'slug' => 'decret-2015-292-instituant-rgae-cameroun',
            ],
        ];

        foreach ($articles as $data) {
            Article::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        $this->command->info('3 communiqués (décrets/arrêtés) publiés avec succès.');
    }
}
