<?php

use App\User;
use App\House;
use GuzzleHttp\Client;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;


class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(faker $faker)
    {
        $client = new Client();

        $addresses = config('addresses');
        foreach ($addresses as $address){
            $client = new Client();
            $res = $client->get("https://api.tomtom.com/search/2/search/{$address}.json?limit=1&typeahead=true&countrySet=IT&key=Oy5FeMobhbOv0274dEpqyZNDta4FXJyA");
            $response = json_decode($res->getBody());
            $lat = count($response -> results) ? $response -> results[0] -> position -> lat : 0 ;
            $lon = count($response -> results) ? $response -> results[0] -> position -> lon : 0 ;
            $availability_start = $faker->dateTimeInInterval('-30 year', '+30 year');
            $n_months = rand(1,11);
            $n_of_rooms = $faker->numberBetween(1, 9);
            $imageid = rand(1, 3000);
            House::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'Poster' => "https://loremflickr.com/320/240/houses?lock=$imageid",
                'Title' => $faker->city(),
                'Night_price' => $faker->numberBetween(20, 300),
                'Content' => $faker->realText(300, 2),
                'N_of_rooms' => $n_of_rooms,
                'N_of_beds' => $faker->numberBetween(1, $n_of_rooms),
                'N_of_baths' => $faker->numberBetween(1, 9),
                'Mq' => $faker->numberBetween(10, 300),
                'Available_from' => $availability_start,
                'Available_to'   => date('Y-m-d', strtotime($availability_start->format('Y-m-d') . "+ $n_months month")),
                'Address'        => $address,
                'Lat'            => $lat?$lat:null,
                'Lng'            => $lon?$lon:null,
            ]);
        }
    }
}

