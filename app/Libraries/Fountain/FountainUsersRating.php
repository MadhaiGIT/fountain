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
        $user = FountainUser::create('nickNameUR', 'testUR@example.com');
        $userId = $user->getUserId();
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
        $user->delete();
        FountainBase::UnitTestCompare("Exists After Delete", false, FountainUsersRating::exists($id));

        return true;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->ratingId;
    }

    /**
     * @return string
     */
    public function getRatingComment(): string
    {
        $result = FountainUsersRating::__DB__select($this->ratingId);
        $result = Utils::StdClassToArray($result);
        return (string)$result['rating_comment'];
    }

    /**
     * @return DateTime
     */
    public function getRatingDatetime(): DateTime
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
    public function getRatingValue(): int
    {
        $result = FountainUsersRating::__DB__select($this->ratingId);
        $result = Utils::StdClassToArray($result);
        return (int)$result['rating_value'];
    }

    /**
     * @param int $userId
     * @param int $queryId
     * @param DateTime $ratingDatetime
     * @param int $ratingValue
     * @param string $ratingComment
     * @return FountainUsersRating
     */
    public static function create($userId, $queryId, $ratingDatetime, $ratingValue, $ratingComment): FountainUsersRating
    {
        $id = FountainUsersRating::__DB__insert($userId, $queryId, $ratingDatetime, $ratingValue, $ratingComment);
        return new FountainUsersRating($id);
    }

    /**
     * @param int $userId
     * @param int $queryId
     * @param DateTime $ratingDatetime
     * @param int $ratingValue
     * @param string $ratingComment
     * @return int
     */
    private static function __DB__insert($userId, $queryId, $ratingDatetime, $ratingValue, $ratingComment): int
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
     * @param int $id
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
     * @param int $ratingId
     * @return bool
     */
    public static function exists($ratingId): bool
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
