<?php


namespace App\Http\Controllers;

use App\Libraries\Fountain\FountainAdviceQuery;
use App\Libraries\Fountain\FountainUsersActivity;
use App\Libraries\Fountain\FountainUsersCreditHistory;
use App\Libraries\Fountain\FountainUsersFinance;
use App\Libraries\Fountain\FountainUsersRating;
use Illuminate\Routing\Controller as BaseController;
use App\Libraries\Fountain\FountainUser;


class TestController extends BaseController
{
    public function ping() {
        return 'pong';
    }

    function users() {
        return FountainUser::__UnitTest();
    }

    function usersAdviceQuery() {
        return FountainAdviceQuery::__UnitTest();
    }

    function usersActivity() {
        return FountainUsersActivity::__UnitTest();
    }

    function usersCreditHistory() {
        return FountainUsersCreditHistory::__UnitTest();
    }

    function usersFinance() {
        return FountainUsersFinance::__UnitTest();
    }

    function usersRating() {
        return FountainUsersRating::__UnitTest();
    }

}
