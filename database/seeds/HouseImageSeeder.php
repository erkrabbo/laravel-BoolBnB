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
            $max = rand(0, 4);
            for ($_i = 1; $_i <= $max; $_i++ ){
                HouseImage::create([
                    'house_id' => $house->id,
                    'path'     => 'https://picsum.photos/200/300?nocache='.microtime()
                ]);
            }
        }


        
    }
}
