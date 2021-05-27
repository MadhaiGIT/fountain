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
        return view('credit')->with(['data' => $request->session()->get('user')]);
    }
}
