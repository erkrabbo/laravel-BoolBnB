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
        $services = config('houseServices');

        foreach ($services as $service) {
            Service::create([
                'name' => $service,
            ]);
        }
    }
}
