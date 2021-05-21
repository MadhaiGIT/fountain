<?php


namespace App\Libraries\Fountain;

use Illuminate\Support\Facades\DB;

class FountainUsersFinance extends FountainBase
{
    private $financeId;
    private $userId;
    private $financeDatetime;
    private $financeAmount;
    private $currency;

    const CLASS_NAME = __CLASS__;
    const PARENT_CLASS = NULL;

    public function __construct($id)
    {
        $this->financeId = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int)$this->financeId;
    }

    /**
     * @return double
     */
    public function getFinanceAmount()
    {
        $result = FountainUsersFinance::__DB__select($this->financeId);
        return (double)$result['finance_amount'];
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        $result = FountainUsersFinance::__DB__select($this->financeId);
        return (string)$result['currency'];
    }

    /**
     * @param $userId
     * @param $financeDatetime
     * @param $financeAmount
     * @param $currency
     * @return FountainUsersFinance
     */
    public static function create($userId, $financeDatetime, $financeAmount, $currency)
    {
        $id = FountainUsersFinance::__DB__insert($userId, $financeDatetime, $financeAmount, $currency);
        return new FountainUsersFinance($id);
    }

    /**
     * @param $userId
     * @param $financeDatetime
     * @param $financeAmount
     * @param $currency
     * @return int
     */
    private static function __DB__insert($userId, $financeDatetime, $financeAmount, $currency)
    {
        $id = DB::table('users_finance')->insertGetId(
            array(
                "user_id" => $userId,
                "finance_datetime" => $financeDatetime,
                "finance_amount" => $financeAmount,
                "currency" => $currency
            )
        );

        return (int)$id;
    }

    /**
     * @param $id
     * @return mixed
     */
    private static function __DB__select($id)
    {
        $result = DB::selectOne(
            "
            SELECT `finance_id`, `user_id`, `finance_datetime`, `finance_amount`, `currency`
            FROM `users_finance`
            WHERE `finance_id` = ?
            ",
            [$id]
        );

        return $result;
    }

    /**
     * @param $financeId
     * @return bool
     */
    public static function exists($financeId)
    {
        $result = FountainUsersFinance::__DB__select($financeId);
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
        DB::delete("DELETE FROM users_finance");
    }

}
