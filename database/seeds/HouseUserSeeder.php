<?php

use App\User;
use App\House;
use Illuminate\Database\Seeder;

class HouseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
           $max = rand(0,6);
           $houses = House::inRandomOrder()->limit($max)->pluck('id');
           for ($_i=1; $_i <= $max; $_i++) {
             $user -> houses() -> attach($houses[$_i - 1]);
           }
        }
    }
}
