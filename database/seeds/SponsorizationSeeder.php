<?php

use App\Sponsorization;
use Illuminate\Database\Seeder;

class SponsorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sponsorization::create([
            'name' => 'Basic',
            'price' => 299,
            'duration' => 24,
        ]);
        
        Sponsorization::create([
            'name' => 'Premium',
            'price' => 599,
            'duration' => 72,
        ]);
        Sponsorization::create([
            'name' => 'Deluxe',
            'price' => 999,
            'duration' => 144,
        ]);
    }
}
