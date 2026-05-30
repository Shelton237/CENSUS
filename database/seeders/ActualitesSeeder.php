<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ActualitesSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            // ────────────────────────────────────────────────────────────────
            // RUBRIQUE ACTUALITÉS — Article 1 : Démarrage effectif de la collecte
            // ────────────────────────────────────────────────────────────────
            [
                'title_fr'     => 'Démarrage effectif des activités de collecte des données sur le terrain',
                'title_en'     => 'Effective start of field data collection activities',
                'slug'         => 'demarrage-effectif-collecte-donnees-terrain',
                'content_fr'   => <<<HTML
<p>Conformément à l'arrêté N°039/CAB/PM du 06 mars 2026 du Premier Ministre, Chef du Gouvernement, la période de dénombrement a été fixée du <strong>24 avril au 29 mai 2026</strong>.</p>

<p>Les opérations de dénombrement principal du quatrième recensement général de la population et de collecte des données du module de base du recensement général de l'agriculture et de l'élevage sont séquencées en trois phases :</p>

<h3>Phase 1 : Mise à jour de la zone de dénombrement et numérotation (14 jours)</h3>
<p>La première phase, d'une durée de 14 jours, est celle de la mise à jour de la zone de dénombrement et de la numérotation des structures et des ménages. Il est question au cours de cette phase de se rassurer que les agents recenseurs ont bien délimité leur zone de travail, bien estimé leur charge de travail et bien marqué les domiciles par le sigle de l'opération <strong>« GC »</strong> (General Census) suivi du numéro de la zone de dénombrement et des numéros d'identifiants uniques de structure et de ménage, afin que personne ne soit oublié lors du comptage.</p>

<h3>Phase 2 : Collecte proprement dite (30 jours, dès le 8 mai 2026)</h3>
<p>Durant cette phase, environ <strong>30 000 Agents Recenseurs et Chefs d'équipes</strong> vont sillonner les quartiers et villages, sur toute l'étendue du territoire national, et frapper à nos portes pour des interviews auprès des ménages. À cette occasion, ils poseront aux Chefs de ménage ou à leurs représentants, des questions sur :</p>
<ul>
  <li>Les caractéristiques individuelles des membres du ménage</li>
  <li>Le niveau d'éducation</li>
  <li>La situation d'emploi et l'activité économique</li>
  <li>La fécondité des femmes</li>
  <li>Les décès du ménage au cours des 12 derniers mois</li>
  <li>Les départs du Cameroun pour l'étranger au cours des 5 dernières années</li>
  <li>Les caractéristiques de l'habitat</li>
  <li>Les transferts de la diaspora</li>
  <li>Les activités agropastorales, aquacoles et de pêche au sein du ménage</li>
</ul>

<h3>Phase 3 : Ratissage (5 jours)</h3>
<p>La dernière phase de ratissage, étalée sur cinq jours, permet de dénombrer toutes les personnes qui n'auront pas été comptées au terme des 30 jours de collecte proprement dite. Un <strong>numéro vert d'appel du Call Center au « 8585 »</strong> existe pour les ménages qui auraient été omis.</p>

<p>La première étape de numérotation des structures et des ménages a débuté le 24 avril 2026 dans plusieurs zones de travail. Dans d'autres, elle a connu des retards de démarrage en raison de la démotivation du personnel de terrain, du fait des retards de paiement de leurs frais de subsistance par le projet HISWACA. Cette situation est progressivement en train d'être résorbée et le paiement de 10 jours de frais de subsistance par le Gouvernement est en cours.</p>

<blockquote><em>Le recensement est une affaire de tous, contribuons à sa réussite.</em></blockquote>
HTML,
                'content_en'   => <<<HTML
<p>In accordance with Decree N°039/CAB/PM of March 6, 2026 by the Prime Minister, Head of Government, the enumeration period has been set from <strong>April 24 to May 29, 2026</strong>.</p>

<p>The main enumeration operations of the fourth general population census coupled with the collection of baseline data for the general census of agriculture and livestock are sequenced into three phases:</p>

<h3>Phase 1: Update of the enumeration area and numbering (14 days)</h3>
<p>The first phase, lasting 14 days, involves updating the enumeration area and numbering structures and households. The goal during this phase is to ensure that enumerators have properly demarcated their work area, estimated their workload, and marked homes with the acronym <strong>"GC"</strong> (General Census) followed by the enumeration area number and the unique structure and household IDs, ensuring that no one is left out during the count.</p>

<h3>Phase 2: Main Collection (30 days, starting May 8, 2026)</h3>
<p>During this phase, approximately <strong>30,000 Enumerators and Team Leaders</strong> will travel across neighborhoods and villages throughout the national territory, knocking on doors to conduct interviews with households. They will ask heads of households or their representatives questions about:</p>
<ul>
  <li>Individual characteristics of household members</li>
  <li>Level of education</li>
  <li>Employment status and economic activity</li>
  <li>Fertility of women</li>
  <li>Deaths in the household in the last 12 months</li>
  <li>Departures from Cameroon for foreign countries in the last 5 years</li>
  <li>Housing characteristics</li>
  <li>Remittances from the diaspora</li>
  <li>Agropastoral, aquaculture, and fishing activities within the household</li>
</ul>

<h3>Phase 3: Clean-up / Sweeping (5 days)</h3>
<p>The final sweeping phase, spanning five days, allows for the enumeration of all persons who may not have been counted during the 30 days of actual collection. A <strong>toll-free number at "8585"</strong> is available for households that may have been missed.</p>

<p>The first step of numbering structures and households started on April 24, 2026 in several work areas. In others, it experienced start-up delays due to field staff demotivation caused by delays in the payment of their subsistence allowances by the HISWACA project. This situation is progressively being resolved, and the payment of 10 days of subsistence allowances by the Government is underway.</p>

<blockquote><em>The census is everyone's business, let's contribute to its success.</em></blockquote>
HTML,
                'category'     => 'activite',
                'published_at' => '2026-04-24 08:00:00',
                'media_type'   => 'image',
                'image'        => null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],

            // ────────────────────────────────────────────────────────────────
            // RUBRIQUE ACTIVITÉS — Article 2 : Bilan des activités préparatoires
            // ────────────────────────────────────────────────────────────────
            [
                'title_fr'     => 'Bilan des activités préparatoires au 4ème RGPH-RGAE (2019–2026)',
                'title_en'     => 'Review of preparatory activities for the 4th GPHC-GALC (2019–2026)',
                'slug'         => 'bilan-activites-preparatoires-rgph-rgae',
                'content_fr'   => <<<HTML
<p>Depuis l'annonce en 2019 par le Premier Ministre, Chef du Gouvernement, Joseph Dion Nguté, de la mutualisation des opérations du 4ème Recensement Général de la Population et de l'Habitat (RGPH) couplé au Recensement Général de l'Agriculture et de l'Élevage (RGAE), plusieurs activités préparatoires à la collecte ont été réalisées.</p>

<p>La <strong>réunion interministérielle du 12 août 2025</strong>, présidée par le Premier Ministre, a permis la validation du bouclage financier de l'opération : <strong>7 milliards FCFA par la Banque Mondiale</strong> et <strong>6,2 milliards de FCFA par le Gouvernement</strong>. Le chronogramme des activités restantes, prévoyant la collecte des données en décembre 2025 – janvier 2026, a également été validé.</p>

<p>Les travaux préparatoires (cartographie censitaire actualisée, recensement pilote mutualisé, outils numériques de collecte et de suivi, documents stratégiques et guides méthodologiques) sont entièrement achevés.</p>

<h3>Principales activités réalisées</h3>

<h4>Recyclage des superviseurs (18-30 septembre 2025, Ebolowa)</h4>
<p>170 responsables venant des 10 régions du Cameroun, issus des Coordinations Nationales RGPH-RGAE et des Ministères de tutelle et sectoriels, ont été formés sur les procédures techniques, administratives, financières et logistiques.</p>

<h4>Test du recensement en zones de crises (18 octobre – 5 novembre 2025)</h4>
<p>Avec l'appui de l'<strong>UNFPA</strong> et de la <strong>FAO</strong>, un test du recensement hybride a été réalisé dans les arrondissements de Bamenda 1er, Buea, Fongo-Tongo et Mora.</p>

<h4>Reparamétrage des smartphones (novembre-décembre 2025)</h4>
<p>Vérification et remise en état de la flotte de smartphones, remplacement des batteries défectueuses et constitution d'une réserve suffisante avec l'appui de l'OMS via l'UNFPA.</p>

<h4>Atelier de modélisation spatiale (décembre 2025)</h4>
<p>Test de la méthodologie d'estimation démographique et agricole pour les zones inaccessibles. Les résultats des estimations ont été jugés satisfaisants, proches de ceux du dénombrement classique.</p>

<h4>Finalisation de la stratégie de communication (février 2026)</h4>
<p>La stratégie porte sur : mobilisation sociale, campagne médiatique (radio, TV, digital, SMS), sensibilisation de proximité, déploiement de caravanes motorisées et affichage de banderoles.</p>

<h4>Recyclage des contrôleurs (16 février – 06 mars 2026)</h4>
<p><strong>686 candidats contrôleurs</strong> formés par 54 formateurs nationaux dans les 10 régions.</p>

<h4>Recyclage des CAFL (23 février – 04 mars 2026)</h4>
<p><strong>110 Cadres Administratifs, Financiers et Logistiques</strong> recyclés. Les Délégués Départementaux du MINEPAT ont également été imprégnés sur leur rôle d'Ordonnateurs Délégués.</p>

<h4>Présélection des agents recenseurs (06-29 mars 2026)</h4>
<p>Commissions de présélection tenues dans les <strong>58 départements</strong> du pays. Les listes des candidats présélectionnés par arrondissement ont été signées par les Préfets.</p>

<h4>Formation des agents recenseurs (30 mars – 22 avril 2026)</h4>
<p><strong>35 355 candidats</strong> formés dans les <strong>360 arrondissements</strong> du pays.</p>

<h4>Acheminement du matériel (décembre 2025 – avril 2026)</h4>
<p>Livraison du matériel dans les sous-préfectures, avec gestion des contraintes sécuritaires au Nord-Ouest et au Sud-Ouest.</p>

<h4>Plan de sécurité du personnel de terrain (novembre 2025 – mai 2026)</h4>
<p>Zonage sécuritaire tricolore (Rouge / Orange / Vert) coordonné avec le MINDEF, la Police, la Gendarmerie et l'Armée. Mécanismes d'alertes d'incidents mis en place.</p>

<h4>Conventions avec les opérateurs de téléphonie mobile (mars-mai 2026)</h4>
<p>Signature des conventions avec <strong>MTN Mobile Money</strong> et <strong>Orange Money</strong> pour le paiement électronique des salaires et frais de subsistance des agents recenseurs.</p>

<h4>Installation des Comités Départementaux et d'arrondissements (avril-mai 2026)</h4>
<p>Installation des comités dans les 58 départements pour appuyer la mobilisation sociale, la sécurité et la logistique de la collecte mutualisée.</p>
HTML,
                'content_en'   => <<<HTML
<p>Since the announcement in 2019 by the Prime Minister, Head of Government, Joseph Dion Ngute, of the mutualization of the operations of the 4th General Population and Housing Census (GPHC) coupled with the General Agriculture and Livestock Census (GALC), several activities preparatory to the collection have been carried out.</p>

<p>The <strong>interministerial meeting on August 12, 2025</strong>, chaired by the Prime Minister, led to the validation of the financial package for the operation: <strong>7 billion FCFA by the World Bank</strong> and <strong>6.2 billion FCFA by the Government</strong>. The schedule of remaining activities, planning data collection in December 2025 – January 2026, was also validated.</p>

<p>Preparatory works (updated census mapping, mutualized pilot census, digital tools for collection and monitoring, strategic documents and methodological guides) are completely finalized.</p>

<h3>Main activities completed</h3>

<h4>Retraining of supervisors (September 18-30, 2025, Ebolowa)</h4>
<p>170 managers from the 10 regions of Cameroon, from the GPHC-GALC National Coordinations and sector ministries, were trained on technical, administrative, financial, and logistical procedures.</p>

<h4>Census testing in crisis areas (October 18 – November 5, 2025)</h4>
<p>With support from <strong>UNFPA</strong> and <strong>FAO</strong>, a hybrid census test was carried out in the sub-districts of Bamenda 1st, Buea, Fongo-Tongo, and Mora.</p>

<h4>Reconfiguration of smartphones (November-December 2025)</h4>
<p>Verification and restoration of the smartphone fleet, replacement of defective batteries, and creation of a sufficient reserve with the support of WHO via UNFPA.</p>

<h4>Spatial modeling workshop (December 2025)</h4>
<p>Testing of the demographic and agricultural estimation methodology for inaccessible areas. Estimation results were deemed satisfactory, close to those of the classical enumeration.</p>

<h4>Finalization of the communication strategy (February 2026)</h4>
<p>The strategy covers: social mobilization, media campaign (radio, TV, digital, SMS), proximity awareness, deployment of motorized caravans, and banner displays.</p>

<h4>Retraining of controllers (February 16 – March 06, 2026)</h4>
<p><strong>686 candidate controllers</strong> trained by 54 national trainers in the 10 regions.</p>

<h4>Retraining of CAFLs (February 23 – March 04, 2026)</h4>
<p><strong>110 Administrative, Financial, and Logistical Officers</strong> retrained. MINEPAT Regional Delegates were also briefed on their role as Delegated Authorizing Officers.</p>

<h4>Pre-selection of enumerators (March 06-29, 2026)</h4>
<p>Pre-selection committees held in the <strong>58 divisions</strong> of the country. Pre-selected candidate lists by sub-division were signed by the Senior Divisional Officers (Prefects).</p>

<h4>Training of enumerators (March 30 – April 22, 2026)</h4>
<p><strong>35,355 candidates</strong> trained in the <strong>360 sub-divisions</strong> of the country.</p>

<h4>Equipment distribution (December 2025 – April 2026)</h4>
<p>Delivery of equipment to sub-divisional offices, managing security constraints in the North-West and South-West regions.</p>

<h4>Security plan for field staff (November 2025 – May 2026)</h4>
<p>Three-color security zoning (Red / Orange / Green) coordinated with MINDEF, Police, Gendarmerie, and Army. Incident reporting mechanisms implemented.</p>

<h4>Agreements with mobile network operators (March-May 2026)</h4>
<p>Signing of agreements with <strong>MTN Mobile Money</strong> and <strong>Orange Money</strong> for electronic payment of salaries and subsistence allowances of enumerators.</p>

<h4>Installation of Divisional and Sub-Divisional Committees (April-May 2026)</h4>
<p>Installation of committees in the 58 divisions to support social mobilization, security, and logistics of the mutualized collection.</p>
HTML,
                'category'     => 'activite',
                'published_at' => '2026-05-01 08:00:00',
                'media_type'   => 'image',
                'image'        => null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ];

        foreach ($articles as $article) {
            // Éviter les doublons sur le slug
            if (!DB::table('articles')->where('slug', $article['slug'])->exists()) {
                DB::table('articles')->insert($article);
                $this->command->info("  [OK] Article insere : " . $article['title_fr']);
            } else {
                $this->command->warn("  [SKIP] Article deja present : " . $article['slug']);
            }
        }
    }
}
