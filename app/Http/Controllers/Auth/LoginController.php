<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Libraries\Fountain\FountainUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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

            $user = DB::table('users')->select(['id', 'nickname', 'email', 'credit', 'account_enabled'])->where(['email' => $request->input('email')])->first();
            $request->session()->put('user', $user);

            if ($redirect != null) {
                return redirect()->intended($redirect);
            }

            return redirect()->intended('query');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    public function facebook(Request $request)
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function google(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginSuccess(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $exception) {
            return redirect('login');
        }

        if (!FountainUser::emailExists($user->getEmail())) {
            // sign up???
            $newUser = FountainUser::create($user->getNickname() != null ? $user->getNickname() : '', $user->getEmail(), $user->getId(), false, '', Hash::make($user->getId()), 0);
            $request->session()->regenerate();
            $request->session()->put(
                'user',
                ['id' => $newUser->getUserId(), 'nickname' => $newUser->getNickName(), 'email' => $newUser->getCredit(), 'credit' => $newUser->getCredit(), 'accountEnabled' => $newUser->getAccountEnabled()]
            );
        } else {
            // login ???
            $oldUser = DB::table('users')->select(['id', 'email', 'nickname', 'credit', 'account_enabled'])->where(['email' => $user->getEmail()])->first();
            $request->session()->regenerate();
            $request->session()->put('user', $oldUser);
        }

        return redirect('query');
    }

    public function loginFBSuccess(Request $request)
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $exception) {
            return redirect('login');
        }

        if (!FountainUser::emailExists($user->getEmail())) {
            // sign up???
            $newUser = FountainUser::create($user->getNickname() != null ? $user->getNickname() : '', $user->getEmail(), $user->getId(), false, Hash::make($user->getId()), '', 0);
            $request->session()->regenerate();
            $request->session()->put(
                'user',
                ['id' => $newUser->getUserId(), 'nickname' => $newUser->getNickName(), 'email' => $newUser->getCredit(), 'credit' => $newUser->getCredit(), 'accountEnabled' => $newUser->getAccountEnabled()]
            );
        } else {
            // login ???
            $oldUser = DB::table('users')->select(['id', 'email', 'nickname', 'credit', 'account_enabled'])->where(['email' => $user->getEmail()])->first();
            $request->session()->regenerate();
            $request->session()->put('user', $oldUser);
        }

        return redirect('query');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function recover()
    {
        return view('recover');
    }

    public function sendResetEmail(Request $request)
    {
        $email = $request->input('email');
        if (FountainUser::emailExists($email)) {
            return 'Reset password email will be sent ....... ';
        }
        return back()->withErrors([
            'email' => 'The provided email address does not exist.'
        ]);
    }
}
