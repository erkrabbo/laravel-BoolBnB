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
    public function search(Request $request) {
        $houses = $this->filterHouses($request)->get();
        $services = Service::all();

        // if ($request->has('services')) {
        //     $services = DB::table('house_services')->join('houses', 'house_id', 'id')->join('services', 'service_id', 'id');
        //     dd($services);
        //     foreach($houses as $house) {
        //         foreach($request->services as $service) {
        //             if($services->where($house->id, 'house_id')->where($service, 'services.name')) {
        //                 $house['services'] += $service->name;
        //             }
        //         }
        //     }
        // }
        // foreach($houses as $house) {
        //     $service = DB::table('house_service')->join('houses', 'house_service.house_id', 'houses.id')->where($house->id, 'house_id')->select('house_service.name', 'house_service.icon')->get();
        //     $house['services'] += $service;
        // }

        return response()->json([
            'houses' => $houses,
            'services' => $services
        ]);

    }
}
