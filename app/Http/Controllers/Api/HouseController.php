<?php

namespace App\Http\Controllers\Api;

use App\Service;
use App\Concerns\Filterable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    use Filterable;
    public function sponsored()
    {
        $sponsoredHouses = DB::table('house_sponsorization')
            ->join('houses', 'houses.id', '=', 'house_sponsorization.house_id')
            ->where('house_sponsorization.created_at' , '<=', date('Y-m-d H:i:s'))
            ->where('house_sponsorization.expiration_date' , '>', date('Y-m-d H:i:s'))
            ->orderBy('house_sponsorization.created_at', 'desc')
            ->select('house_sponsorization.*', 'houses.*')
            ->paginate(10);

        foreach ($sponsoredHouses as $house) {
            $gallery = DB::table('house_images')
                ->join('houses', 'houses.id', '=', 'house_images.house_id')
                ->where('house_images.house_id', $house->id)
                ->pluck('path');

            $house->gallery = [$house->Poster, ...$gallery];
            $house->sponsored = true;
        }

        return response()->json([
            'sponsoredHouses' => $sponsoredHouses,
        ]);
    }
    public function last()
    {
        $houses = DB::table('houses')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        foreach ($houses as $house) {
            $gallery = DB::table('house_images')
                ->join('houses', 'houses.id', '=', 'house_images.house_id')
                ->where('house_images.house_id', $house->id)
                ->pluck('path');
            $house->gallery = [$house->Poster, ...$gallery];
            $house->sponsored = false;
        }

        return response()->json([
            'houses' => $houses,
        ]);
    }
    public function search(Request $request) {
        $houses = $this->filterHouses($request)->orderBy('created_at', 'desc')->get();
        $services = Service::all();

        return response()->json([
            'houses' => $houses,
            'services' => $services
        ]);

    }
}
