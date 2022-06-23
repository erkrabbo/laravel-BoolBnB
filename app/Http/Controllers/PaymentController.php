<?php

namespace App\Http\Controllers;

// use Braintree\Transaction;

use App\House;
use App\Sponsorization;
use DateTime;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function make(Request $request) {
        $amount =  Sponsorization::where('id', $request->price)->value('price');


        $service = \Braintree\Transaction::sale([

            'amount' => $amount,
            'paymentMethodNonce' => $request['nonce'],
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if ($service->success) {

            // $house = House::where('id', $request->house)->with('sponsorizations')->get();
            // // dd($house);
            // if($house->sponsorizations()) {

            //     foreach($house->sponsorization() as $sponsorization) {

            //     }


                // dd($request->house);
                // $spons = $request->price;
              
                //     $house->has('sponsorizations', function ($query) use ( $spons ) {
                //         $created = new DateTime($query->value('created_at'));
                //         $duration = $query->value('duration');
                //         $expiration = $created->modify("+$duration hour");
                //         $expiration->format('Y-m-d H:i:s');
        
                //         if($expiration > date("Y-m-d H:i:s")) {
                //             $query->get()->sponsorizations()->synch([$spons => [
                //                 'created_at' => $expiration
                //             ]]);
                            
                //         }
                //         else {
                //             $query->get()->sponsorizations()->attach([$spons => [
                //                 'created_at' => date("Y-m-d H:i:s")
                //             ]]);
                //         }
                //     });    

            // }
          
                
            return redirect()->route('houses.show', [
                $request->house
            ])->with('success', 'Il pagamento è andato a buon fine');
            } else {
            return redirect()->back()->withErrors([
                'name' => 'Abbiamo riscontrato un problema durante il tentativo di pagamento'
            ]);
        }
    }

    public function payform(Request $request) {
        $id = $request->id;
        $house = $request->house;
        // dd($request);
        return view ('houses.braintree', compact('id', 'house'));
    }
}
