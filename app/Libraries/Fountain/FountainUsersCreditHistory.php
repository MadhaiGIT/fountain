<?php


namespace App\Libraries\Fountain;

use Illuminate\Support\Facades\DB;

class FountainUsersCreditHistory extends FountainBase
{
    private $creditId;
    private $userId;
    private $actionDatetime;
    private $actionType;
    private $actionValue;

    const CLASS_NAME = __CLASS__;
    const PARENT_CLASS = NULL;

    const ACTION_TYPES = array(
        'DEPOSITED' => 'deposited',
        'SPENT' => 'spent'
    );

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
        return (string)$result['action_type'];
    }

    /**
     * @return int
     */
    public function getActionValue()
    {
        $result = FountainUsersCreditHistory::__DB__select($this->creditId);
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
        DB::delete("DELETE from users_credit_history");
    }

}
