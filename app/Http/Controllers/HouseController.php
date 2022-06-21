<?php

namespace App\Http\Controllers;

use App\User;
use App\House;
use App\Service;
use App\HouseImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        // dd($request->all());
        // $request->validate([
        //     'user_id'     => 'required',
        //     'Poster'      => 'nullable|image',
        //     'Title'       => 'required',
        //     'Night_price' => 'required',
        //     'Content'     => 'required',
        //     'N_of_rooms'  => 'required',
        //     'N_of_beds'   => 'required',
        //     'N_of_baths'  => 'required',
        //     'Mq'          => 'required',
        //     'Available_from' => 'required',
        //     'Available_to'   => 'required',
        //     'Address'        => 'required',
        // ]);

        $data = $request->all();

        $img_path = Storage::put('uploads', $data['Poster']);

        $formData = [
            // 'user_id'   => Auth::id(),
            // 'Poster'    => $img_path,

            // 'Title' => $Title,
            // 'Night_price' => $Night_price,
            // 'N_of_rooms' => $N_of_rooms,
            // 'N_of_beds' => $N_of_beds,
            // 'N_of_baths' => $N_of_baths,
            // 'Mq' => $Mq,
            // 'Available_from' => $Available_from,
            // 'Available_to' => $Available_to,
            // 'Address' => $Address,
        ];

        $house = House::create($request->all());

        return redirect()->route('houses.show', $house->id);

        // $house = House::create([
        //     'Poster' => $request->Poster,
        //     'Title' => $request->Title,
        //     'Night_price' => $request->Night_price,
        //     'N_of_rooms' => $request->N_of_rooms,
        //     'N_of_beds' => $request->N_of_beds,
        //     'N_of_baths' => $request->N_of_baths,
        //     'Mq' => $request->Mq,
        //     'Available_from' => $request->Available_from,
        //     'Available_to' => $request->Available_to,
        //     'Address' => $request->Address,
        //     'user_id' => Auth::id()]);
        // return redirect()->route('houses.show', $house->id);
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
            'pageTitle'    => $house->Title,
            'house'        => $house,
            'user'         => $user,
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
        $images = HouseImage::where('house_id', "$house->id")->get();

        return view('houses.edit', [
            'house'     => $house,
            'services'  => $services,
            'images'    => $images
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

        //$request->validate($this->getValidators());

        $houseData = $request->all();


        if (array_key_exists('Poster', $houseData)) {
            Storage::delete($house->Poster);
            $img_path = Storage::put('uploads', $houseData['Poster']);
            $houseData = [
                'Poster'    => $img_path
            ] + $houseData;
        }

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
