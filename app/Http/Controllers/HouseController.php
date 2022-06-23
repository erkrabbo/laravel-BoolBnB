<?php

namespace App\Http\Controllers;

use App\User;
use App\House;
use App\Service;
use App\HouseImage;
use App\Sponsorization;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    use \App\Concerns\Filterable;
    private function getValidators($id = null) {
        $validation = [
            'Title'          => 'required|max:100',
            'Poster'         => 'required|image',
            'Content'        => 'required',
            'Night_price'    => 'required',
            'N_of_rooms'     => 'required',
            'N_of_beds'      => 'required',
            'N_of_baths'     => 'required',
            'Mq'             => 'required',
            'Available_from' => 'required',
            'Available_to'   => 'required',
            'Address'        => 'required',
            'Visible'        => 'accepted',
            'Lat'            => 'required',
            'Lng'            => 'required',
            // 'service_id'   => 'required|exists:App\Service,id',
        ];

        if($id) {
            $house = House::find($id);
            if (!$house->notHavingImageInDb()) {
                if(array_key_exists('Poster', $validation)) {
                    unset($validation['Poster']);
                }
            }
        }

        return $validation;
        // if ($house->notHavingImageInDb()){
        //     $rules['Poster'] = 'required|image';
        // }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        // $sponsoredHouses = House::all();
        // $sponsoredHouses = DB::table('house_sponsorization')
        //     ->join('houses', 'houses.id', '=', 'house_sponsorization.house_id')
        //     ->select('house_sponsorization.*', 'houses.*')
        //     ->get();

        // $houses = DB::table('houses')
        //     ->orderBy('created_at')
        //     ->get();

        // return view('home', compact('sponsoredHouses', 'houses'));
        // Auth::user() ? $user = Auth::user() : $user = null;
        return view('home');
    }

    public function index(Request $request)
    {
        $houses = $this->filterHouses($request);
        return view('houses.index', compact('houses'));
    }

    public function indexUser(Request $request)
    {
        $houses = House::where('user_id', Auth::user()->id)->get();

        return view('dashboard.myHouses', compact('houses'));
    }

    public function sponsorized() {
        $sponsorizations = Sponsorization::all();

        return view ('houses.sponsorization', compact('sponsorizations'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(House $house)
    {

        $services = Service::all();

        // $house_images = HouseImage::where('house_id', "$house->id")->get();

        return view('houses.create', compact('services'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidators());

        $data = $request->all();

        $img_path = Storage::put('uploads', $data['Poster']);

        $formData = [
            'user_id'   => Auth::user()->id,
            'Poster'    => $img_path,
            'Content'    => $request->Content,
            'Title' => $request->Title,
            'Night_price' => $request->Night_price,
            'N_of_rooms' => $request->N_of_rooms,
            'N_of_beds' => $request->N_of_beds,
            'N_of_baths' => $request->N_of_baths,
            'Mq' => $request->Mq,
            'services' =>$request->services,
            'house_images' =>$request->house_images,
            'Available_from' => $request->Available_from,
            'Available_to' => $request->Available_to,
            'Address' => $request->Address,
            'Visible' => $request->Visible,
            'Lat' => $request->Lat,
            'Lng' => $request->Lng,
        ];

        $house = House::create($formData);

        $house->services()->attach($formData['services']);

        if($request->hasFile('house_images')) {
            foreach($request->file('house_images') as $image)
            {
                $imgs_path = Storage::put('uploads', $image);

                HouseImage::create([
                    'house_id' => $house->id,
                    'path'     => $imgs_path,
                ]);
            }
       }

        return redirect()->route('houses.show', $house->id);
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
            'services'     => $services,
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
        
        $house_images = HouseImage::where('house_id', "$house->id")->get();

        return view('houses.edit', [
            'house'         => $house,
            'services'      => $services,
            'house_images' => $house_images,
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
        // dd ($request);
        $request->validate($this->getValidators($house->id));

        if (Auth::user()->id !== $house->user_id) abort(403);

        $houseData = $request->all();

        if (array_key_exists('Poster', $houseData)) {
            Storage::delete($house->Poster);
            $img_path = Storage::put('uploads', $houseData['Poster']);
            $houseData = [
                'Poster'    => $img_path
            ] + $houseData;
        }

        $house->update($houseData);

        $house->services()->sync($houseData['services']);

        if($request->hasFile('house_images')) {
            foreach($request->file('house_images') as $image)
            {
                $imgs_path = Storage::put('uploads', $image);

                HouseImage::create([
                    'house_id' => $house->id,
                    'path'     => $imgs_path,
                ]);
            }
       }

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

        return redirect()->route('houses.indexUser');
    }
}
