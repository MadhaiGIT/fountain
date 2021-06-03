<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Fountain\FountainUser;
use Illuminate\Support\Facades\DB;
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
            $oldUser = DB::table('users')->select(['id', 'email', 'nickname', 'credit', 'account_enabled'])->where(['email' => $email])->first();
            $request->session()->regenerate();
            $request->session()->put('user', $oldUser);

            return redirect('/query');
        } else {
            $oldUser = DB::table('users')->select(['id', 'email', 'nickname', 'credit', 'account_enabled', 'hashed_password'])->where(['email' => $email])->first();
            if (is_null($oldUser->hashed_password) || $oldUser->hashed_password == '') {
                DB::table('user')->update([
                    'hashed_password' => Hash::make($password)
                ]);
                $request->session()->regenerate();
                $request->session()->put('user', $oldUser);
                return redirect('/query');
            }
        }

        return back()->withErrors(['email' => 'The email already exists.']);
    }
}
