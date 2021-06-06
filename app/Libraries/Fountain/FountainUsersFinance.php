<?php


namespace App\Libraries\Fountain;

use Illuminate\Support\Facades\DB;
use DateTime;

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

    public static function __UnitTest(): bool
    {
        $userId = 21;
        $financeDatetime = new DateTime('now');
        $financeAmount = 100.0;
        $currency = "USD";

        $object = FountainUsersFinance::create($userId, $financeDatetime, $financeAmount, $currency);

        $id = $object->getId();
        $objectFromId = new FountainUsersFinance($id);

        FountainBase::UnitTestCompare("Creating", $id, $objectFromId->getId());
        FountainBase::UnitTestCompare("Exists After Create", true, FountainUsersFinance::exists($id));
        FountainBase::UnitTestCompare("Finance Datetime", $financeDatetime->getTimestamp(), $object->getFinanceDatetime()->getTimestamp());
        FountainBase::UnitTestCompare("Finance Amount", $financeAmount, $object->getFinanceAmount());

        $object->delete();
        FountainBase::UnitTestCompare("Exists After Delete", false, FountainUsersFinance::exists($id));

        return true;
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
    public function getFinanceAmount(): float
    {
        $result = FountainUsersFinance::__DB__select($this->financeId);
        $result = Utils::StdClassToArray($result);
        return (double)$result['finance_amount'];
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        $result = FountainUsersFinance::__DB__select($this->financeId);
        $result = Utils::StdClassToArray($result);
        return (string)$result['currency'];
    }

    /**
     * @return DateTime
     */
    public function getFinanceDatetime(): DateTime
    {
        try {
            $result = FountainUsersFinance::__DB__select($this->financeId);
            $result = Utils::StdClassToArray($result);
            return new DateTime($result['finance_amount']);
        } catch (\Exception $exception) {
            return new DateTime('now');
        }
    }

    /**
     * @param $userId
     * @param $financeDatetime
     * @param $financeAmount
     * @param $currency
     * @return FountainUsersFinance
     */
    public static function create($userId, $financeDatetime, $financeAmount, $currency): FountainUsersFinance
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
    private static function __DB__insert($userId, $financeDatetime, $financeAmount, $currency): int
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
    public static function exists($financeId): bool
    {
        $result = FountainUsersFinance::__DB__select($financeId);
        if (($result === false) || (!is_object($result))) {
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
        DB::delete("DELETE FROM users_finance WHERE finance_id = ?", [$this->financeId]);
    }

}
