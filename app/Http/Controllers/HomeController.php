<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController
{
    function index(Request $request)
    {
        $user = $request->session()->get('user');
        if ($user != null) {
            return redirect('/query');
        }
        return view('index');
    }

    function policy()
    {
        return view('policy');
    }

    function disclaimer(Request $request)
    {
        $redirectTo = $request->get('redirect');
        return view('disclaimer')->with(['data' => $request->session()->get('user'), 'redirect' => $redirectTo]);
    }

    function acceptDisclaimer(Request $request)
    {
        $user = $request->session()->get('user');
        DB::table('users')->where('id', $user->id)->update(['disclaimer_accepted' => 1]);
        $redirectTo = $request->get('redirect');
//        return $redirectTo;
        if ($redirectTo) {
            return redirect($redirectTo);
        } else {
            return redirect('query');
        }
    }
}
