<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'wifi',
            'icon' => 'fa-wifi',
        ]);
        Service::create([
            'name' => 'piscina',
            'icon' => 'fa-water-ladder',
        ]);
        Service::create([
            'name' => 'tv',
            'icon' => 'fa-tv',
        ]);
        Service::create([
            'name' => 'vista spiaggia',
            'icon' => 'fa-umbrella-beach',
        ]);
        Service::create([
            'name' => 'aria condizionata',
            'icon' => 'fa-fan',
        ]);
        Service::create([
            'name' => 'netflix',
            'icon' => 'fa-n',
        ]);
        Service::create([
            'name' => 'cucina',
            'icon' => 'fa-kitchen-set',
        ]);
        Service::create([
            'name' => 'frigorifero',
            'icon' => 'fa-wine-bottle',
        ]);
        Service::create([
            'name' => 'fornelli',
            'icon' => 'fa-fire-burner',
        ]);
        Service::create([
            'name' => 'servizio navetta',
            'icon' => 'fa-van-shuttle',
        ]);
        Service::create([
            'name' => 'vasca idromassaggio',
            'icon' => 'fa-hot-tub-person',
        ]);
        Service::create([
            'name' => 'fumatori',
            'icon' => 'fa-smoking',
        ]);
        Service::create([
            'name' => 'parcheggi',
            'icon' => 'fa-square-parking',
        ]);
        Service::create([
            'name' => 'allarme antincendio',
            'icon' => 'fa-fire-flame-curved',
        ]);
        Service::create([
            'name' => 'animali',
            'icon' => 'fa-dog',
        ]);
        Service::create([
            'name' => 'colazione inclusa',
            'icon' => 'fa-bacon',
        ]);
        Service::create([
            'name' => 'estintore',
            'icon' => 'fa-fire-extinguisher',
        ]);
        Service::create([
            'name' => 'area massaggi',
            'icon' => 'fa-spa',
        ]);
        Service::create([
            'name' => 'palestra',
            'icon' => 'fa-dumbbell',
        ]);
    }
}
