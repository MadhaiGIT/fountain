<?php


namespace App\Http\Controllers;


use App\Libraries\Fountain\ACTION_TYPES;
use App\Libraries\Fountain\EVENT_TYPES;
use App\Libraries\Fountain\FountainUsersCreditHistory;
use App\Libraries\Fountain\FountainUsersFinance;
use App\Libraries\Fountain\FountainUsersActivity;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use DateTime;

class HomeController
{
    function index(Request $request)
    {
        return view('index')->with(['data' => $request->session()->get('user')]);
    }

    function query(Request $request)
    {
        $user = $request->session()->get('user');
        if ($user->credit <= 0) {
            return redirect('credit');
        }
        return view('query')->with(['data' => $request->session()->get('user')]);
    }

    function credit(Request $request)
    {
//        return env('STRIPE_TEST_KEY');
        \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET'));

        $option = $request->get('option', 1);

        $amount = 1;
        $queryCount = 1;

        if ($option == 1) {
            $amount = 1;
            $queryCount = 1;
        } elseif ($option == 2) {
            $amount = 9;
            $queryCount = 10;
        } elseif ($option == 3) {
            $amount = 40;
            $queryCount = 50;
        } elseif ($option == 4) {
            $amount = 75;
            $queryCount = 100;
        }

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount * 100, // unit is cent, not dolor
            'currency' => 'usd',
        ]);

        $request->session()->put('payment_intent', $intent);

        return view('credit')->with([
            'data' => $request->session()->get('user'),
            'intent' => $intent,
            'option' => $option,
            'amount' => $amount,
            'queryCount' => $queryCount,
        ]);
    }

    function purchase(Request $request)
    {
        $pId = $request->get('id');
        $pAmount = floatval($request->get('amount'));
        $pCurrency = $request->get('currency');
        $pStatus = $request->get('status');
        $user = $request->session()->get('user');

        if ($pId == $request->session()->get('payment_intent')->id && $pStatus == 'succeeded') {
            $datetime = new DateTime('now');
            FountainUsersActivity::create($user->id, $datetime, EVENT_TYPES::CREDIT_ADDED);
            FountainUsersCreditHistory::create($user->id, $datetime, ACTION_TYPES::DEPOSITED, $pAmount / 100);
            FountainUsersFinance::create($user->id, $datetime, $pAmount / 100, $pCurrency);

            DB::table('users')->where('id', $user->id)->update([
                'credit' => floatval($user->credit) + $pAmount / 100
            ]);
            $user = DB::table('users')->select(['*'])->where('id', $user->id)->first();
            $request->session()->put('user', $user);

            return redirect('credit');
        }

        return redirect('credit')->withErrors(['Card' => 'error']);
    }

    function policy()
    {
        return view('policy');
    }
}
