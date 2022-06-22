<?php

namespace App\Concerns;

use App\House;
use Illuminate\Support\Facades\DB;

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
        // $filtered = DB::table('house_service')->join('houses', 'house_service.house_id', 'houses.id')->join('services', 'house_service.service_id', 'services.id');
        // dd($filtered);
        $filtered = House::whereRaw('1 = 1');
        // $filtered['services'] = [];


        if ($request->has('max_price')) {
            $filtered->where('Night_price', '<=',  $request->max_price);
        }

        if ($request->has('beds')) {
            $filtered->where('N_of_beds', '>=',  $request->beds);
        }

        if ($request->has('mq')) {
            $filtered->where('Mq', '>=', $request->mq);
        }
        if ($request->has('check_in')) {
            $filtered->where('Available_from', '<=', $request->check_in)->where('Available_to', '>=', $request->check_in);
        }

        if ($request->services) {
            $services = $request->services;
            // dd($services);
            foreach ($services as $service) {
                $filtered->whereHas('services', function ($query) use ($service){
                    $query->where('id', $service);
                });
            }
        }

        return $filtered;
    }
}
