<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function payment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $paypalToken = $provider->getAccessToken();

        $data = [
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal_success'),
                "cancel_url" => route('paypal_cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $request->price
                    ]
                ]
            ]
        ];
        
        $order = $provider->createOrder($data);
        if (isset($order['id']) && $order['id'] != null) {
            
            foreach($order['links'] as $link){
                if ($link['rel'] === "approve") {
                    return redirect()->away($link['href']);
                }
            }
        }else{
            return redirect()->route('paypal_cancel');
        }
    }
    public function success(Request $request)
    {
       
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $paypalToken = $provider->getAccessToken();
        $order = $provider->capturePaymentOrder($request->token);

        if (isset($order['status']) && $order['status']=== 'COMPLETED') {
            return redirect()->route('transaccion_succes');
        }else{
            return redirect()->route('paypal_cancel');
        }

    }


    public function cancel()
    {
        return redirect()->route('cart')->with('error', 'Error al procesar la transacción.');
    }
}


