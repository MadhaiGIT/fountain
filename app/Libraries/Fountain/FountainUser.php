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
        return (string)$result["nick_name"];
    }

    /**
     * Get Email
     * @return string
     */
    public function getEmail()
    {
        $result = FountainUser::__DB__select__user($this->userId);
        return (string)$result["email"];
    }

    /**
     * Get Credit
     * @return int
     */
    public function getCredit()
    {
        $result = FountainUser::__DB__select__user($this->userId);
        return (int)$result["credit"];
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
        $facebookToken = '',
        $googleToken = '',
        $accountEnabled = false,
        $credit = 0,
        $hashedPassword = ''
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
     * @return int
     */
    private static function __DB__insert__user(
        $nickname, $email, $facebookToken, $googleToken, $accountEnabled, $credit, $hashedPassword)
    {
        $id = DB::table('users')->insertGetId(array(
            'nick_name' => $nickname,
            'email' => $email,
            'facebook_token' => $facebookToken,
            'google_token' => $googleToken,
            'account_enabled' => $accountEnabled,
            'credit' => $credit,
            'hashed_password' => $hashedPassword
        ));
        /*DB::insert(
            "INSERT INTO users
            (
            nick_name,
            email,
            facebook_token,
            google_token,
            account_enabled,
            credit,
            hashed_password
            )
            VALUES
            (?, ?, ?, ?, ?, ?, ?)"
            ,
            [
                $nickname,
                $email,
                $facebookToken,
                $googleToken,
                $accountEnabled,
                $credit,
                $hashedPassword,
            ]
        );*/
        return (int)$id;
    }

    /**
     * Get all data of record from table user give id
     * @param $userId
     * @return FountainUser
     */
    private static function __DB__select__user($userId)
    {
        $result = DB::selectOne("
            SELECT `user_id`, `nick_name`, `email`, `facebook_token`, `google_token`, `account_enabled`, `credit`, `hashed_password`
            FROM users
            WHERE user_id = ?
            ",
            [$userId],
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
        if (($result === false) || (!is_array($result))) {
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
        DB::delete("DELETE FROM users");
    }
}
