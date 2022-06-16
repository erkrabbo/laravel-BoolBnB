<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServiceSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(HouseSeeder::class);
        $this->call(SponsorizationSeeder::class);
        $this->call(HouseServicesSeeder::class);
        $this->call(HouseImageSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(ViewSeeder::class);
        $this->call(HouseSponsorizationSeeder::class);
        $this->call(HouseUserSeeder::class);
    }
}
