<?php

namespace App\Http\Controllers;

use App\House;
use App\Message;
use App\Mail\SendNewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, House $house)
    {
        $house = $request->house;
    
        $hou = House::find($house);
        if (Auth::user()->id !== $hou->user_id) abort(403);

        $messages = Message::where('house_id', $house)->orderBy('created_at', 'desc')->get();
        
        return view('dashboard.messages', compact('messages'));
    }

    public function send(Request $request)
    {
        $lead = Message::create($request->all());
    
        Mail::to('johnca@outlook.it')->send(new SendNewMessage($lead));

        return redirect()->back()->with('Mail', 'Il messaggio è stato inviato');
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
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Message $message)
    {
        $message->delete();

        return redirect()->back();
    }
}
