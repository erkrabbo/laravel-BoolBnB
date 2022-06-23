<?php

namespace App\Http\Controllers;

// use Braintree\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function make(Request $request) {
        
        $service = \Braintree\Transaction::sale([
            'amount' => '50.00',
            'paymentMethodNonce' => $request['nonce'],
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if ($service->success) {
            // dd($diocane);
            return response()->json('ciao');
            
            } else {
            return response()->json('ciaociao');
        }
    }

    public function payform(Request $request) {
        $id = $request->id;
        // dd($request);
        return view ('houses.braintree', compact('id'));
    }
}
