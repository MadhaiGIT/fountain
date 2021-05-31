<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class HomeController
{
    function index(Request $request)
    {
        return view('index')->with(['data' => $request->session()->get('user')]);
    }

    function query(Request $request)
    {
        return view('query')->with(['data' => $request->session()->get('user')]);
    }

    function credit(Request $request)
    {
//        return json_encode($request->session()->get('user'));
        \Stripe\Stripe::setApiKey(env('STRIPE_TEST_API_KEY'));
        $option = $request->get('option', 1);

        $amount = 1;
        $queryCount = 1;

        if ($option == 2) {
            $amount = 9;
            $queryCount = 10;
        }
        elseif ($option == 3)
        {
            $amount = 40;
            $queryCount = 50;
        }
        elseif ($option == 4)
        {
            $amount = 75;
            $queryCount = 100;
        }

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount * 100, // unit is cent, not dolor
            'currency' => 'usd',
        ]);

        return view('credit')->with([
            'data' => $request->session()->get('user'),
            'intent' => $intent,
            'option' => $option,
            'amount' => $amount,
            'queryCount' => $queryCount,
        ]);
    }
}
