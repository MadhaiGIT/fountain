<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Fountain\FountainUser;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    function index() {
        return view('signup');
    }

    function register(Request $request)
    {
        $nickname = $request->input('nickname');
        $email = $request->input('email');
        $password = $request->input('password');

        // validates here
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'nickname' => 'required'
        ]);

        if (!FountainUser::emailExists($email)) {
            FountainUser::create($nickname, $email, Hash::make($password));

            return redirect()->intended('login');
        }

        return back()->withErrors(['email' => 'The email already exists.']);
    }
}
