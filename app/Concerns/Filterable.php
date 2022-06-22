<?php

namespace App\Concerns;

use App\House;

trait Filterable
{
    /**
     * Apply all relevant filters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Http\Filters\Filter  $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function filterHouses($request)
    {
        $filtered = House::whereRaw('1 = 1');

        if ($request->has('max_price')) {
            $filtered->where('Night_price', '<=',  $request->max_price);
        }
        // if ($request->has('mpd')) {
        //     $allHouses = $filtered->get();
        //     $houses = [];
        //     foreach($allHouses as $house) {
        //         if($house->Lng == null || $house->Lat == null) continue;
        //         $d = (($house->Lng - $request->centerLng) ** 2) + (($house->Lat - $request->centerLat) ** 2);
        //         if (sqrt($d) <= $request->mpd) {
        //             $houses[] = $house;
        //         }
        //         // dd($allHouses);
        //     }
        //     $filtered = new House($houses);
        // }

        if ($request->has('services')) {
            $services = $request->services;
            foreach ($services as $service) {
                $filtered->whereHas('services', function($query) use ($service) {
                    $query->where('name', $service);
                });
            }
        }
        return $filtered;
    }
}
