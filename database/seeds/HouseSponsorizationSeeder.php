<?php

use App\House;
use Illuminate\Database\Seeder;

class HouseSponsorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $houses = House::inRandomOrder()->limit(20)->get();
        foreach ($houses as $house) {
          $house -> sponsorizations() -> attach(rand(1,3));
        }
    }
}
