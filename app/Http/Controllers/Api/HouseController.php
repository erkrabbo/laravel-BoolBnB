<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    public function sponsored()
    {
        // $sponsoredHouses = House::all();
        $sponsoredHouses = DB::table('house_sponsorization')
            ->join('houses', 'houses.id', '=', 'house_sponsorization.house_id')
            ->select('house_sponsorization.*', 'houses.*')
            ->paginate(10);
        foreach ($sponsoredHouses as $house) {
            $gallery = DB::table('house_images')
                ->join('houses', 'houses.id', '=', 'house_images.house_id')
                ->where('house_images.house_id', $house->id)
                ->pluck('path');

            $house->gallery = [$house->Poster, ...$gallery];
        }

        return response()->json([
            'sponsoredHouses' => $sponsoredHouses,
        ]);
    }
    public function last()
    {
        // $sponsoredHouses = House::all();
        $houses = DB::table('houses')
        ->orderBy('created_at')
        ->paginate(10);

        foreach ($houses as $house) {
            $gallery = DB::table('house_images')
                ->join('houses', 'houses.id', '=', 'house_images.house_id')
                ->where('house_images.house_id', $house->id)
                ->pluck('path');
            $house->gallery = [$house->Poster, ...$gallery];
        }

        return response()->json([
            'houses' => $houses,
        ]);
    }
}
