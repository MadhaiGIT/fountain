<?php


namespace App\Libraries\Fountain;

use Illuminate\Support\Facades\DB;
use DateTime;

abstract class EVENT_TYPES
{
    const LOGIN = 'login';
    const LOGOFF = 'logoff';
    const ASK_ADVICE = 'ask_advice';
    const CREDIT_ADDED = 'credit_added';
    const CREDIT_SPENT = 'credit_spent';
    const EMAIL_OPEN = 'email_open';
    const EMAIL_CLICK = 'email_click';
    const EMAIL_UNSUBSCRIBE = 'email_unsubscribe';
    const EMAIL_COMPLAIN = 'email_complain';
    const EMAIL_BOUNCE_HARD = 'email_bounce_hard';
    const EMAIL_BOUNCE_SOFT = 'email_bounce_soft';
    const RESET_PASSWORD = 'reset_password';
}

class FountainUsersActivity extends FountainBase
{
    private $activityId;
    private $userId;
    private $eventDatetime;
    private $eventType;

    const CLASS_NAME = __CLASS__;
    const PARENT_CLASS = NULL;


    public function __construct($id)
    {
        $this->activityId = $id;
    }

    public static function __UnitTest()
    {
        $userId = 21;
        $eventDateTime = new DateTime('now');
        $eventType = EVENT_TYPES::LOGIN;

        $usersActivity = FountainUsersActivity::create($userId, $eventDateTime, $eventType);

        $id = $usersActivity->getId();
        $objectFromId = new FountainUsersActivity($id);

        if (!FountainBase::UnitTestCompare("Creating", $id, $objectFromId->getId())) {
            return false;
        }
        if (!FountainBase::UnitTestCompare("Exists After Create", true, FountainUsersActivity::exists($id))) {
            return false;
        }
        if (!FountainBase::UnitTestCompare("Event Datetime", $eventDateTime->getTimestamp(), $usersActivity->getEventDatetime()->getTimestamp())) {
            return false;
        }
        if (!FountainBase::UnitTestCompare("Event Type", $eventType, $usersActivity->getEventType())) {
            return false;
        }

        $usersActivity->delete();
        if (!FountainBase::UnitTestCompare("Exists After Delete", false, FountainUsersActivity::exists($id))) {
            return false;
        }

        return true;
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
        $result = Utils::StdClassToArray($result);
        return (string)$result['event_type'];
    }

    /**
     * @return DateTime
     */
    public function getEventDatetime()
    {
        try {
            $result = FountainUsersActivity::__DB__select($this->activityId);
            $result = Utils::StdClassToArray($result);
            return new DateTime($result['event_datetime']);
        } catch (\Exception $exception) {
            return new DateTime();
        }
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
    public static function exists($activityId): bool
    {
        $result = FountainUsersActivity::__DB__select($activityId);
        if ($result == null || !is_object($result)) {
            return false;
        }
        return true;
    }

    /**
     * Delete
     */
    public function delete()
    {
        DB::delete("DELETE FROM users_activity WHERE activity_id = ? ", [$this->activityId]);
    }
}
