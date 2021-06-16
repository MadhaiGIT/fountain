<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Libraries\Fountain\EVENT_TYPES;
use App\Libraries\Fountain\FountainUsersActivity;
use DateTime;
use Illuminate\Http\Request;
use App\Libraries\Fountain\FountainUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    function index()
    {
        return view('signup');
    }

    function register(Request $request)
    {
        $nickname = '';// $request->input('nickname');
        $email = $request->input('email');
        $password = $request->input('password');
        $time = new DateTime('now');

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
            FountainUsersActivity::create($oldUser->id, $time, EVENT_TYPES::LOGIN);

            if (is_null($oldUser->hashed_password) || $oldUser->hashed_password == '') {
                DB::table('users')->where('id', $oldUser->id)->update([
                    'hashed_password' => Hash::make($password),
                    'password'=> Hash::make($password)
                ]);
                $request->session()->regenerate();
                $request->session()->put('user', $oldUser);
                return redirect('/query');
            }
        }

        return back()->withErrors(['email' => 'The email already exists.']);
    }

    function verifyEmail(Request $request)
    {
        $time = new DateTime('now');
        $email = $request->get('email');
        // $email = mysql_escape_string($email);
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        if (empty($email)) {
            return 'The provided email address is not valid.';
        } else {
            // Valid Email
            $oldUser = DB::table('users')->select(['id', 'email', 'nickname', 'credit', 'account_enabled'])->where(['email' => $email])->first();

            // FountainUsersActivity::create($oldUser->id, $time, EVENT_TYPES::EMAIL_OPEN);

            if ($oldUser != null && $oldUser->email) {
                $code = md5(rand(1000, 9999));
                $hash = md5($code);

                DB::table('users')->where('id', $oldUser->id)->update(['hashed_code' => $hash]);

                $link = env('APP_URL') . '/email/confirm?email=' . $oldUser->email . '&hash=' . $hash;

                return "<h1>Verification email was sent, please check your inbox. <a href='$link' target='_blank'>Click Here</a></h1>";
            } else {
                return "Provided email does not exist.";
            }
        }
    }

    function confirmEmail(Request $request)
    {
        $time = new DateTime('now');
        $email = $request->get('email');
        $hash = $request->get('hash');
        if (!empty($email) && !empty($hash)) {
            $oldUser = DB::table('users')->select(['id', 'email', 'nickname', 'credit', 'account_enabled'])->where(['email' => $email, 'hashed_code' => $hash])->first();

            if ($oldUser != null && $oldUser->id) {
                DB::table('users')->where('id', $oldUser->id)->update(['account_enabled' => true]);
                FountainUsersActivity::create($oldUser->id, $time, EVENT_TYPES::EMAIL_CLICK);

                return "Email verified successfully.";
            } else {
                return "Invalid email or hash";
            }

        } else {
            return 'Empty email or hash';
        }
    }
}
