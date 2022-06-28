<?php

namespace App\Http\Controllers;

// use Braintree\Transaction;

use DateTime;
use App\House;
use DateInterval;
use App\Sponsorization;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function make(Request $request) {
        $amount =  Sponsorization::where('id', $request->price)->first();

        $service = \Braintree\Transaction::sale([

            'amount' => $amount->price / 100,
            'paymentMethodNonce' => $request['nonce'],
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if ($service->success) {
            $house = House::where('id', $request->house)->with('sponsorizations')->first();
            if(count($house->sponsorizations) != 0) {
                $trueExpiration = null;
                
                foreach($house->sponsorizations as $sponsorization) {
                    $created = new DateTime($sponsorization->pivot->created_at);
                    $duration = $sponsorization->duration;
                    $interval = new DateInterval("PT{$duration}H");
                    $expiration = (clone $created)->add($interval);
                    if($trueExpiration == null || $expiration > $trueExpiration) {
                        $trueExpiration = $expiration;  
                        $expirationDate = (clone $trueExpiration)->add(new DateInterval("PT{$amount->duration}H"));                       
                    }                    
                }
                $house->sponsorizations()->attach([
                    $request->price => ['created_at' => $trueExpiration, 'expiration_date' => $expirationDate ]
                ]);
            }  else {
                    $trueExpiration = new DateTime(date('Y-m-d H:i:s'));  
                    $expirationDate = (clone $trueExpiration)->add(new DateInterval("PT{$amount->duration}H"));  
                    $house->sponsorizations()->attach([
                    $request->price => ['created_at' => $trueExpiration, 'expiration_date' => $expirationDate]
                ]);
            }
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
        return view ('houses.braintree', compact('id', 'house'));
    }
}


