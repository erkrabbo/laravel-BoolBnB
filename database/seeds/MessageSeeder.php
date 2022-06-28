<?php

use App\House;
use App\Message;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
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
            $max = rand(0, 4);
            for ($_i = 1; $_i <= $max; $_i++ ){
                $doubleface = rand(0,2);
                if ($doubleface){
                    $user = User::inRandomOrder()->first();
                } else{
                    $user = new User();
                    $user->email   = $faker->email();
                    $user->name    = $faker->name();
                    $user->surname = $faker->lastName();
                };
                Message::create([
                    'house_id'     => $house->id,
                    'sender_mail'  => $user->email,
                    'content'      => $faker->realText(300, 2),
                    'name'         => $user->name,
                    'surname'      => $user->surname
                ]);
            }
        }
    }
}
