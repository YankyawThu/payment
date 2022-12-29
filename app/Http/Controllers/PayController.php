<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree;

class PayController extends Controller
{
    public function index(Request $request)
    {
        $gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'w9r3mrqrktwqpfjc',
            'publicKey' => 'nvqpwry7r47d9d2v',
            'privateKey' => '6a9a0a8659f18ba347df8723f46dc1c5'
        ]);
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->nonce,
            'options' => [
              'submitForSettlement' => True
            ]
        ]);
        if($result->success) {
            return back()->with('success', 'Pay Success!');
        }
        else return back()->with('fail', $result->message);
    }
}
