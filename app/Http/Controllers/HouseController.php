<?php

namespace App\Http\Controllers;

use App\User;
use App\House;
use App\Service;
use App\HouseImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        // $sponsoredHouses = House::all();
        $sponsoredHouses = DB::table('house_sponsorization')
            ->join('houses', 'houses.id', '=', 'house_sponsorization.house_id')
            ->select('house_sponsorization.*', 'houses.*')
            ->get();

        $houses = DB::table('houses')
            ->orderBy('created_at')
            ->get();

        return view('home', compact('sponsoredHouses', 'houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('houses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'Poster' => 'required',
            'Title' => 'required',
            'Night_price' => 'required',
            'N_of_rooms' => 'required',
        ]);

        House::create($request->all());
        return redirect()->route('houses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house) 
    {
        $services = DB::table('house_service')
            ->join('services','services.id', '=', 'service_id')
            ->where('house_id', $house->id)
            ->get();
        // dd($services);

        $user = User::where('id', "$house->user_id")->first();
        $house_images = HouseImage::where('house_id', "$house->id")->get();
                        
        return view('houses.show', [
            'pageTitle' => $house->Title,
            'house' => $house,
            'user' => $user,
            'house_images' => $house_images,
            'services' => $services,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        if (Auth::user()->id !== $house->user_id) abort(403);
        $services = Service::all();
        //$images = HouseImage::all();

        return view('houses.edit', [
            'house'     => $house,
            'services'  => $services,
            //'images'    => $images
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        if (Auth::user()->id !== $house->user_id) abort(403);
        $houseData = $request->all();
        $house->update($houseData);

        return redirect()->route('houses.show', $house->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        if (Auth::user()->id !== $house->user_id) abort(403);

        $house->delete();

        return redirect()->route('houses.index');
    }
}
