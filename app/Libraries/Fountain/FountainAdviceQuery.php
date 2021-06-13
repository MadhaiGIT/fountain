<?php


namespace App\Libraries\Fountain;

use Illuminate\Support\Facades\DB;

class FountainAdviceQuery extends FountainBase
{
    private $queryId;
    private $userId;
    private $adviceSecret;
    private $adviceUserQuery;
    private $adviceResponse;

    const CLASS_NAME = __CLASS__;
    const PARENT_CLASS = NULL;

    public function __construct($id)
    {
        $this->queryId = $id;
    }

    public static function __UnitTest()
    {

        $user = FountainUser::create('nickName', "tempFAQ@example.com");
        $userId = $user->getUserId();
        $adviceSecret = "Test Secret";
        $adviceUserQuery = "Test Query";
        $adviceResponse = "Test Response";

        $object = FountainAdviceQuery::create($userId, $adviceSecret, $adviceUserQuery, $adviceResponse);

        $id = $object->getId();
        $objectFromId = new FountainAdviceQuery($id);

        FountainBase::UnitTestCompare("Creating", $id, $objectFromId->getId());
        FountainBase::UnitTestCompare("Exists After Create", true, FountainAdviceQuery::exists($id));
        FountainBase::UnitTestCompare("Advice Secret", $adviceSecret, $object->getAdviceSecret());
        FountainBase::UnitTestCompare("Advice UserQuery", $adviceUserQuery, $object->getAdviceUserQuery());
        FountainBase::UnitTestCompare("Advice Response", $adviceResponse, $object->getAdviceResponse());

        $object->delete();
        $user->delete();
        FountainBase::UnitTestCompare("Exists After Delete", false, FountainAdviceQuery::exists($id));

        return true;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int)$this->queryId;
    }

    /**
     * @return string
     */
    public function getAdviceSecret()
    {
        $result = FountainAdviceQuery::__DB__select($this->queryId);
        $result = Utils::StdClassToArray($result);
        return (string)$result['advice_secret'];
    }

    /**
     * @return string
     */
    public function getAdviceUserQuery()
    {
        $result = FountainAdviceQuery::__DB__select($this->queryId);
        $result = Utils::StdClassToArray($result);
        return (string)$result['advice_user_query'];
    }

    /**
     * @return string
     */
    public function getAdviceResponse()
    {
        $result = FountainAdviceQuery::__DB__select($this->queryId);
        $result = Utils::StdClassToArray($result);
        return (string)$result['advice_response'];
    }

    /**
     * @param int $userId
     * @param string $adviceSecret
     * @param string $adviceUserQuery
     * @param string $adviceResponse
     * @return FountainAdviceQuery
     */
    public static function create($userId, $adviceSecret, $adviceUserQuery, $adviceResponse): FountainAdviceQuery
    {
        $id = FountainAdviceQuery::__DB__insert($userId, $adviceSecret, $adviceUserQuery, $adviceResponse);
        return new FountainAdviceQuery($id);
    }

    /**
     * @param int $userId
     * @param string $adviceSecret
     * @param string $adviceUserQuery
     * @param string $adviceResponse
     * @return int
     */
    private static function __DB__insert($userId, $adviceSecret, $adviceUserQuery, $adviceResponse)
    {
        $id = DB::table('advice_queries')->insertGetId(
            array(
                "user_id" => $userId,
                "advice_secret" => $adviceSecret,
                "advice_user_query" => $adviceUserQuery,
                "advice_response" => $adviceResponse
            )
        );

        return (int)$id;
    }

    /**
     * @param int $id
     * @return mixed
     */
    private static function __DB__select($id)
    {
        $result = DB::selectOne(
            "
            SELECT `query_id`, `user_id`, `advice_secret`, `advice_user_query`, `advice_response`
            FROM `advice_queries`
            WHERE `query_id` = ?
            ",
            [$id]
        );

        return $result;
    }

    /**
     * @param int $queryId
     * @return bool
     */
    public static function exists($queryId): bool
    {
        $result = FountainAdviceQuery::__DB__select($queryId, false);
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
        DB::delete("DELETE FROM advice_queries WHERE query_id = ?", [$this->queryId]);
    }

}
