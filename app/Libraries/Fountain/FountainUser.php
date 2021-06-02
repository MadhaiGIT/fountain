<?php

namespace App\Libraries\Fountain;

use Illuminate\Support\Facades\DB;

class FountainUser extends FountainBase
{
    private $userId;
    private $accountCreation;
    private $nickname;
    private $email;
    private $facebookToken;
    private $googleToken;
    private $hashedPassword;
    private $accountEnabled;
    private $credit;
    private $signupUrl;
    private $signupRefererUrl;
    private $signupDevice;
    private $signupIp;

    const PARENT_CLASS = NULL;
    const CLASS_NAME = __CLASS__;

    /**
     * Unit Test for this class
     * @unit-test: unnecessary
     * @return: bool
     */
    public static function __UnitTest()
    {
        $nickname1 = "Johe Doe";
        $nickname2 = "Jane Doe";

        $email1 = "email1@gmail.com";
        $email2 = "email2@gmail.com";

        $facebookToken1 = "fb-token-1";
        $facebookToken2 = "fb-token-2";

        $googleToken1 = "gg-token-1";
        $googleToken2 = "gg-token-2";

        $user1 = FountainUser::create($nickname1, $email1, '', false, $facebookToken1, $googleToken1);
        $user2 = FountainUser::create($nickname2, $email2, '', false, $facebookToken2, $googleToken2);

        $id1 = $user1->getUserId();
        $objectFromId1 = new FountainUser($id1);
        if (!FountainBase::UnitTestCompare("create user id 1", $id1, $objectFromId1->getUserId())) {
            return false;
        }

        // check exists after create
        if (!FountainBase::UnitTestCompare("exist after create", FountainUser::exists($id1), true)) {
            return false;
        }

        if (!FountainBase::UnitTestCompare("compare nick name", $nickname1, $user1->getNickName())) {
            return false;
        }
        if (!FountainBase::UnitTestCompare("compare email", $email1, $user1->getEmail())) {
            return false;
        }
        if (!FountainBase::UnitTestCompare("compare facebook token 1", $facebookToken1, $user1->getFacebookToken())) {
            return false;
        }
        if (!FountainBase::UnitTestCompare("compare google token 1", $googleToken1, $user1->getGoogleToken())) {
            return false;
        }

        $user1->delete();
        if (!FountainBase::UnitTestCompare("exists after delete", false, FountainUser::exists($user1->getUserId()))) {
            return false;
        }
        $user2->delete();
        if (!FountainBase::UnitTestCompare("exists after delete", false, FountainUser::exists($user2->getUserId()))) {
            return false;
        }


        return true;
    }


    /**
     * FountainUser constructor
     * @param
     */
    public function __construct($_id)
    {
        $this->userId = $_id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get Nick Name
     * @return string
     */
    public function getNickName()
    {
        $result = FountainUser::__DB__select__user($this->userId);
        $result = Utils::StdClassToArray($result);
        return (string)$result["nickname"];
    }

    /**
     * Get Facebook Token
     * @return string
     */
    public function getFacebookToken()
    {
        $result = FountainUser::__DB__select__user($this->userId);
        $result = Utils::StdClassToArray($result);
        return (string)$result["facebook_token"];
    }

    /**
     * Get Google Token
     * @return string
     */
    public function getGoogleToken()
    {
        $result = FountainUser::__DB__select__user($this->userId);
        $result = Utils::StdClassToArray($result);
        return (string)$result["google_token"];
    }

    /**
     * Get Email
     * @return string
     */
    public function getEmail()
    {
        $result = FountainUser::__DB__select__user($this->userId);
        $result = Utils::StdClassToArray($result);
        return (string)$result["email"];
    }

    /**
     * Get Credit
     * @return int
     */
    public function getCredit()
    {
        $result = FountainUser::__DB__select__user($this->userId);
        $result = Utils::StdClassToArray($result);
        return (int)$result["credit"];
    }

    /**
     * @return bool
     */
    public function getAccountEnabled()
    {
        $result = FountainUser::__DB__select__user($this->userId);
        $result = Utils::StdClassToArray($result);
        return (boolean)$result['account_enabled'];
    }

    /**
     * Create new FountainUser
     * @param $nickname
     * @param $email
     * @param $facebookToken
     * @param $googleToken
     * @param $accountEnabled
     * @param $credit
     * @param $hashedPassword
     * @return FountainUser
     */
    public static function create(
        $nickname,
        $email,
        $hashedPassword = '',
        $accountEnabled = false,
        $facebookToken = '',
        $googleToken = '',
        $credit = 0
    )
    {
        $id = FountainUser::__DB__insert__user(
            $nickname, $email, $facebookToken, $googleToken, $accountEnabled, $credit, $hashedPassword
        );

        return new FountainUser($id);
    }


    /**
     * Insert New FountainUser
     * @param string $nickname
     * @param string $email
     * @param string $facebookToken
     * @param string $googleToken
     * @param bool $accountEnabled
     * @param int $credit
     * @param string $hashedPassword
     * @param string $signUpUrl
     * @param string $signUpRefererUrl
     * @param string $signUpDevice
     * @param string $signUpIp
     * @return int
     */
    private static function __DB__insert__user(
        $nickname, $email, $facebookToken, $googleToken, $accountEnabled, $credit, $hashedPassword,
        $signUpUrl = '', $signUpRefererUrl = '', $signUpDevice = '', $signUpIp = '')
    {
        $id = DB::table('users')->insertGetId(array(
            'nickname' => $nickname,
            'email' => $email,
            'facebook_token' => $facebookToken,
            'google_token' => $googleToken,
            'account_enabled' => $accountEnabled,
            'credit' => $credit,
            'hashed_password' => $hashedPassword,
            'password' => $hashedPassword,
            'signup_url' => $signUpUrl,
            'signup_referer_url' => $signUpRefererUrl,
            'signup_device' => $signUpDevice,
            'signup_ip' => $signUpIp,
        ));
        return (int)$id;
    }

    /**
     * Get all data of record from table user give id
     * @param $value
     * @return FountainUser
     */
    private static function __DB__select__user($value)
    {
        $result = DB::selectOne("
            SELECT `id`, `nickname`, `email`, `facebook_token`, `google_token`, `account_enabled`, `credit`, `hashed_password`
            FROM users
            WHERE id = ?
            ",
            [$value],
            true
        );

        return $result;
    }

    /**
     * Check if object with id exists
     * @param $userId
     * @return bool
     */
    public static function exists($userId)
    {
        $result = FountainUser::__DB__select__user($userId);
        if (!is_object($result)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Check if object with id exists
     * @param $email
     * @return bool
     */
    public static function emailExists($email)
    {
        $result = DB::table('users')->select('*')->where('email', '=', $email)->first();
        if (!is_object($result)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Delete
     */
    public function delete()
    {
        DB::delete("DELETE FROM users WHERE id = ?", [$this->userId]);
    }
}
