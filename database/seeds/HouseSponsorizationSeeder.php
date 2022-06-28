<?php

use App\House;
use App\Sponsorization;
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
          $now = new DateTime(date('Y-m-d H:i:s'));
          $rand = rand(1, 3);
          $sponsorization = Sponsorization::find($rand);
          $expiration = (clone $now)->add(new DateInterval("PT{$sponsorization->duration}H"));
          $house -> sponsorizations() -> attach([$rand => ['created_at' => $now, 'expiration_date' => $expiration]]);
        }
    }
}
