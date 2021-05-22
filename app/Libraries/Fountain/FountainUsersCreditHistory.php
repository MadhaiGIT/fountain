<?php


namespace App\Libraries\Fountain;

use Illuminate\Support\Facades\DB;
use DateTime;

abstract class ACTION_TYPES
{
    const DEPOSITED = 'deposited';
    const SPENT = 'spent';
}

class FountainUsersCreditHistory extends FountainBase
{
    private $creditId;
    private $userId;
    private $actionDatetime;
    private $actionType;
    private $actionValue;

    const CLASS_NAME = __CLASS__;
    const PARENT_CLASS = NULL;

    public static function __UnitTest()
    {
        $userId = 21;
        $actionDateTime = new DateTime('now');
        $actionType = ACTION_TYPES::DEPOSITED;
        $actionValue = 100;

        $usersCreditHistory = FountainUsersCreditHistory::create($userId, $actionDateTime, $actionType, $actionValue);

        $id = $usersCreditHistory->getId();
        $objectFromId = new FountainUsersCreditHistory($id);

        if (!FountainBase::UnitTestCompare("Creating", $id, $objectFromId->getId())) {
            return false;
        }
        if (!FountainBase::UnitTestCompare("Exists After Create", true, FountainUsersCreditHistory::exists($id))) {
            return false;
        }
        if (!FountainBase::UnitTestCompare("Action Datetime", $actionDateTime->getTimestamp(), $usersCreditHistory->getActionDatetime()->getTimestamp())) {
            return false;
        }
        if (!FountainBase::UnitTestCompare("Action Type", $actionType, $usersCreditHistory->getActionType())) {
            return false;
        }

        $usersCreditHistory->delete();
        if (!FountainBase::UnitTestCompare("Exists After Delete", false, FountainUsersCreditHistory::exists($id))) {
            return false;
        }

        return true;
    }

    public function __construct($id)
    {
        $this->creditId = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int)$this->creditId;
    }

    /**
     * @return string
     */
    public function getActionType()
    {
        $result = FountainUsersCreditHistory::__DB__select($this->creditId);
        $result = Utils::StdClassToArray($result);
        return (string)$result['action_type'];
    }

    /**
     * @return DateTime
     * @throws \Exception
     */
    public function getActionDatetime()
    {
        try {
            $result = FountainUsersCreditHistory::__DB__select($this->creditId);
            $result = Utils::StdClassToArray($result);
            return new DateTime($result['action_type']);
        } catch (\Exception $exception) {
            return new DateTime();
        }
    }

    /**
     * @return int
     */
    public function getActionValue()
    {
        $result = FountainUsersCreditHistory::__DB__select($this->creditId);
        $result = Utils::StdClassToArray($result);
        return (int)$result['action_value'];
    }

    /**
     * @param $userId
     * @param $actionDatetime
     * @param $actionType
     * @param $actionValue
     * @return FountainUsersCreditHistory
     */
    public static function create($userId, $actionDatetime, $actionType, $actionValue)
    {
        $id = FountainUsersCreditHistory::__DB__insert($userId, $actionDatetime, $actionType, $actionValue);
        return new FountainUsersCreditHistory($id);
    }

    /**
     * @param $userId
     * @param $actionDatetime
     * @param $actionType
     * @param $actionValue
     * @return int
     */
    private static function __DB__insert($userId, $actionDatetime, $actionType, $actionValue)
    {
        $id = DB::table('users_credit_history')->insertGetId(
            array(
                "user_id" => $userId,
                "action_datetime" => $actionDatetime,
                "action_type" => $actionType,
                "action_value" => $actionValue,
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
            SELECT `credit_id`, `user_id`, `action_datetime`, `action_type`, `action_value`
            FROM `users_credit_history`
            WHERE `credit_id` = ?
            ",
            [$id]
        );

        return $result;
    }

    /**
     * @param $creditId
     * @return bool
     */
    public static function exists($creditId)
    {
        $result = FountainUsersCreditHistory::__DB__select($creditId);
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
        DB::delete("DELETE from users_credit_history WHERE credit_id = ?", [$this->creditId]);
    }

}
