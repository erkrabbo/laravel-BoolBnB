<?php

namespace App\Http\Controllers;

// use Braintree\Transaction;

use App\Sponsorization;
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
            return redirect()->back()->with('success', 'Il pagamento è andato a buon fine');
            } else {
            return redirect()->back()->withErrors([
                'name' => 'Abbiamo riscontrato un problema durante il tentativo di pagamento'
            ]);
        }
    }

    public function payform(Request $request) {
        $id = $request->id;
        // dd($request);
        return view ('houses.braintree', compact('id'));
    }
}
