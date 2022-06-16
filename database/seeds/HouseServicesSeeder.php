<?php

use App\House;
use App\Service;
use Illuminate\Database\Seeder;

class HouseServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $houses = House::all();

        foreach ($houses as $house) {
            $houseServices = Service::inRandomOrder()->limit(rand(0, 15))->get();

            $house->services()->attach($houseServices->pluck('id')->all());
        }
    }
}
