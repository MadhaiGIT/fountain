<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Libraries\Fountain\FountainUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->exists('user')) {
            return redirect('/');
        }
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $redirect = $request->input('redirect');

            $user = DB::table('users')->select(['nickname', 'email', 'credit'])->where(['email' => $request->input('email')])->first();
            $request->session()->put('user', $user);

            if ($redirect != null) {
                return redirect()->intended($redirect);
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }
}
