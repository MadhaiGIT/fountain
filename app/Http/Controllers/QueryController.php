<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueryController
{
    function query(Request $request)
    {
        $user = $request->session()->get('user');
        if ($user->credit <= 0) {
            return redirect('credit');
        }
        return view('query')->with(['data' => $request->session()->get('user')]);
    }

    function getResult(Request $request)
    {
        return json_encode($request->get('query'));
    }
}
