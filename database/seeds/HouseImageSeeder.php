<?php

use App\House;
use App\HouseImage;
use Illuminate\Database\Seeder;

class HouseImageSeeder extends Seeder
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
            $imageid = rand(1, 3000);
            $max = rand(0, 4);
            for ($_i = 1; $_i <= $max; $_i++ ){
                HouseImage::create([
                    'house_id' => $house->id,
                    'path'     => "https://loremflickr.com/320/240/houses?lock=$imageid",
                ]);
            }
        }
    }
}
