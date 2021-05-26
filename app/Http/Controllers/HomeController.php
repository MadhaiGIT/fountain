<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class HomeController
{
    function index(Request $request)
    {
        return view('index')->with(['data' => $request->session()->get('user')]);
    }
}
