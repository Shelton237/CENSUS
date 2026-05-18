<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'UNFPA',
                'logo' => '/assets/images/partenaire/unfpa.png',
                'website' => 'https://cameroon.unfpa.org/',
                'order' => 1,
            ],
            [
                'name' => 'Banque Mondiale',
                'logo' => '/assets/images/partenaire/worldbank.svg',
                'website' => 'https://www.banquemondiale.org/fr/country/cameroon',
                'order' => 2,
            ],
            [
                'name' => 'FAO',
                'logo' => '/assets/images/partenaire/fao.png',
                'website' => 'https://www.fao.org/cameroon/fr/',
                'order' => 3,
            ],
            [
                'name' => 'HISWACA',
                'logo' => '/assets/images/partenaire/hiswaca-e1770819554832.jpg',
                'website' => '#',
                'order' => 4,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name']],
                $partner
            );
        }
    }
}
