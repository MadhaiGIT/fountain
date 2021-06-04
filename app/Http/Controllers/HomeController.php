<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

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
}
