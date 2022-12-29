<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree;

class PayController extends Controller
{
    public function __construct()
    {
        $this->gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => env('BRAINTREE_MERCHANTID'),
            'publicKey' => env('BRAINTREE_PUBLICKEY'),
            'privateKey' => env('BRAINTREE_PRIVATEKEY')
        ]);
    }

    public function index()
    {
        $token = $this->gateway->clientToken()->generate();
        return view('welcome', ['token' => $token]);
    }

    public function pay(Request $request)
    {
        $result = $this->gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->nonce,
            'creditCard' => [
                'cardholderName' => $request->holderName,
            ],
            'customer' => [
                'firstName' => $request->cname
            ],
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
