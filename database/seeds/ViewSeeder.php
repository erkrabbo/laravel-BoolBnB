<?php

use App\View;
use App\House;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $houses = House::all();


        foreach ($houses as $house) {
            $randomView = rand(0, 100);

            for ($_i = 1; $_i <= $randomView; $_i++){
                View::create([
                    'IP_address' => strval(mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255)),
                    'house_id'   => $house->id,
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now')
                ]);
            }

        }
    }
}
