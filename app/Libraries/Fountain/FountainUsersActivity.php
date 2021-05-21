<?php


namespace App\Libraries\Fountain;

use Illuminate\Support\Facades\DB;

class FountainUsersActivity extends FountainBase
{
    private $activityId;
    private $userId;
    private $eventDatetime;
    private $eventType;

    const CLASS_NAME = __CLASS__;
    const PARENT_CLASS = NULL;

    const EVENT_TYPES = array(
        'LOGIN' => 'login',
        'LOGOFF' => 'logoff',
        'ASK_ADVICE' => 'ask_advice',
        'CREDIT_ADDED' => 'credit_added',
        'CREDIT_SPENT' => 'credit_spent',
        'EMAIL_OPEN' => 'email_open',
        'EMAIL_CLICK' => 'email_click',
        'EMAIL_UNSUBSCRIBE' => 'email_unsubscribe',
        'EMAIL_COMPLAIN' => 'email_complain',
        'EMAIL_BOUNCE_HARD' => 'email_bounce_hard',
        'EMAIL_BOUNCE_SOFT' => 'email_bounce_soft',
        'RESET_PASSWORD' => 'reset_password'
    );

    public function __construct($id)
    {
        $this->activityId = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int)$this->activityId;
    }

    /**
     * @return string
     */
    public function getEventType()
    {
        $result = FountainUsersActivity::__DB__select($this->activityId);
        return (string)$result['event_type'];
    }

    /**
     * @param $userId
     * @param $eventDatetime
     * @param $eventType
     * @return FountainUsersActivity
     */
    public static function create($userId, $eventDatetime, $eventType)
    {
        $_id = FountainUsersActivity::__DB__insert(
            $userId,
            $eventDatetime,
            $eventType
        );

        return new FountainUsersActivity($_id);
    }

    /**
     * @param $userId
     * @param $eventDatetime
     * @param $eventType
     * @return int
     */
    private static function __DB__insert($userId, $eventDatetime, $eventType)
    {
        $id = DB::table('users_activity')->insertGetId(
            array(
                'user_id' => $userId,
                'event_datetime' => $eventDatetime,
                'event_type' => $eventType
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
            SELECT `activity_id`, `user_id`, `event_datetime`, `event_type`
            FROM `users_activity`
            WHERE `activity_id` = ?
            ",
            [$id]
        );

        return $result;
    }

    /**
     * @param $activityId
     * @return bool
     */
    public static function exists($activityId)
    {
        $result = FountainUsersActivity::__DB__select($activityId);
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
        DB::delete("DELETE FROM users_activity");
    }


}
