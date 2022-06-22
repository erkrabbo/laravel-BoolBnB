<?php

namespace App\Http\Controllers;

use App\HouseImage;
use Illuminate\Http\Request;

class HouseImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HouseImage  $houseImage
     * @return \Illuminate\Http\Response
     */
    public function show(HouseImage $houseImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HouseImage  $houseImage
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseImage $houseImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HouseImage  $houseImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseImage $houseImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HouseImage  $houseImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($houseImage)
    {
        $image_house = HouseImage::find($houseImage);
    
        $image_house->delete();

        return redirect()->back();
    }
}
