<?php


namespace App\Libraries\Fountain;

use Illuminate\Support\Facades\DB;
use DateTime;

class FountainUsersRating extends FountainBase
{
    const ACTION_TYPES = array(
        'DEPOSITED' => 'deposited',
        'SPENT' => 'spent'
    );

    private $ratingId;
    private $userId;
    private $queryId;
    private $ratingDatetime;
    private $ratingComment;
    private $ratingValue;

    const CLASS_NAME = __CLASS__;
    const PARENT_CLASS = NULL;

    public function __construct($id)
    {
        $this->ratingId = $id;
    }

    public static function __UnitTest()
    {
        $userId = 21;
        $queryId = 31;
        $ratingDatetime = new DateTime('now');
        $ratingValue = 5;
        $ratingComment = "Test Comment";

        $object = FountainUsersRating::create($userId, $queryId, $ratingDatetime, $ratingValue, $ratingComment);

        $id = $object->getId();
        $objectFromId = new FountainUsersRating($id);

        FountainBase::UnitTestCompare("Creating", $id, $objectFromId->getId());
        FountainBase::UnitTestCompare("Exists After Create", true, FountainUsersRating::exists($id));
        FountainBase::UnitTestCompare("Finance Datetime", $ratingDatetime->getTimestamp(), $object->getRatingDatetime()->getTimestamp());
        FountainBase::UnitTestCompare("Rating Value", $ratingValue, $object->getRatingValue());
        FountainBase::UnitTestCompare("Rating Comment", $ratingComment, $object->getRatingComment());

        $object->delete();
        FountainBase::UnitTestCompare("Exists After Delete", false, FountainUsersRating::exists($id));

        return true;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return (int)$this->ratingId;
    }

    /**
     * @return string
     */
    public function getRatingComment()
    {
        $result = FountainUsersRating::__DB__select($this->ratingId);
        $result = Utils::StdClassToArray($result);
        return (string)$result['rating_comment'];
    }

    /**
     * @return DateTime
     */
    public function getRatingDatetime()
    {
        try {
            $result = FountainUsersRating::__DB__select($this->ratingId);
            $result = Utils::StdClassToArray($result);
            return new DateTime($result['rating_value']);
        } catch (\Exception $exception) {
            return new DateTime('now');
        }
    }

    /**
     * @return int
     */
    public function getRatingValue()
    {
        $result = FountainUsersRating::__DB__select($this->ratingId);
        $result = Utils::StdClassToArray($result);
        return (int)$result['rating_value'];
    }

    /**
     * @param $userId
     * @param $queryId
     * @param $ratingDatetime
     * @param $ratingValue
     * @param $ratingComment
     * @return FountainUsersRating
     */
    public static function create($userId, $queryId, $ratingDatetime, $ratingValue, $ratingComment)
    {
        $id = FountainUsersRating::__DB__insert($userId, $queryId, $ratingDatetime, $ratingValue, $ratingComment);
        return new FountainUsersRating($id);
    }

    /**
     * @param $userId
     * @param $queryId
     * @param $ratingDatetime
     * @param $ratingValue
     * @param $ratingComment
     * @return int
     */
    private static function __DB__insert($userId, $queryId, $ratingDatetime, $ratingValue, $ratingComment)
    {
        $_id = DB::table('users_rating')->insertGetId(
            array(
                "user_id" => $userId,
                "query_id" => $queryId,
                "rating_datetime" => $ratingDatetime,
                "rating_value" => $ratingValue,
                "rating_comment" => $ratingComment
            )
        );

        return (int)$_id;
    }

    /**
     * @param $id
     * @return mixed
     */
    private static function __DB__select($id)
    {
        $result = DB::selectOne(
            "
            SELECT `rating_id`, `user_id`, `query_id`, `rating_datetime`, `rating_value`, `rating_comment`
            FROM `users_rating`
            WHERE `rating_id` = ?
            ",
            [$id]
        );

        return $result;
    }

    /**
     * @param $ratingId
     * @return bool
     */
    public static function exists($ratingId)
    {
        $result = FountainUsersRating::__DB__select($ratingId);
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
        DB::delete("DELETE FROM users_rating WHERE rating_id = ?", [$this->getId()]);
    }

}
