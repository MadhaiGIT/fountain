<?php


namespace App\Http\Controllers\API;

use App\Libraries\Fountain\ACTION_TYPES;
use App\Libraries\Fountain\EVENT_TYPES;
use App\Libraries\Fountain\FountainAdviceQuery;
use App\Libraries\Fountain\FountainUser;
use App\Libraries\Fountain\FountainUsersActivity;
use App\Libraries\Fountain\FountainUsersCreditHistory;
use App\Libraries\Fountain\FountainUsersRating;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use DateTime;
use Illuminate\Support\Facades\DB;


class ApiController extends BaseController
{
    function chargeStatus(Request $request)
    {
//        $json = $request->getContent();
//        FountainUsersRating::create(0, 0, null, 0, $json);
        return 'ok';
    }

    function queryResult(Request $request)
    {
        $query = $request->get('query');
        $userId = $request->get('userId');
        $result = ['query' => $query, 'userId' => $userId];
        $time = new DateTime('now');
        try {
            FountainUsersActivity::create($userId, $time, EVENT_TYPES::ASK_ADVICE);

            $user = new FountainUser($userId);
            $credit = $user->getCredit();

            // check if credit is enough,
            $deductAmount = 1;
            if ($credit >= $deductAmount) {
                // deduct credit
                DB::table('users')->where(['id' => $userId])->update(['credit' => $credit - $deductAmount]);

                // record history
                FountainUsersActivity::create($userId, $time, EVENT_TYPES::CREDIT_SPENT);
                FountainUsersCreditHistory::create($userId, $time, ACTION_TYPES::SPENT, $deductAmount);

                // TODO: get results from Generic API
                $queryRes = [
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id convallis quam. Fusce sem lectus, vulputate id velit id, tincidunt fringilla enim. In sem justo, commodo commodo sollicitudin auctor, gravida vitae nulla. Proin sit amet vulputate dui, vel posuere orci. Pellentesque posuere quis tortor et rhoncus. Donec luctus massa ut eleifend lobortis. Vestibulum blandit lectus sit amet quam ultricies venenatis. Pellentesque mattis mi ut leo blandit hendrerit nec sit amet magna. Pellentesque rutrum lacus vel faucibus tempor. Morbi fringilla, massa eget accumsan facilisis, risus lorem elementum elit, malesuada accumsan elit purus ac est. Fusce feugiat sem sapien, ac dapibus enim iaculis vel. Aenean vitae enim nec ipsum ultrices vulputate vitae a lorem. Curabitur congue quam eget dapibus condimentum. Maecenas ante tellus, efficitur id urna ut, viverra blandit ligula. Vivamus in sem nec erat varius pulvinar.',
                    'Quisque non ultrices nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla purus nibh, vestibulum quis tincidunt nec, posuere id dui. In posuere tortor vitae efficitur aliquam. Mauris vestibulum sollicitudin turpis, sit amet porttitor urna sodales et. Vestibulum vehicula rutrum dictum. Nulla sed rhoncus leo, id venenatis purus. Quisque a odio vel odio rutrum finibus.',
                    'Vestibulum volutpat, est eget ullamcorper vestibulum, ipsum erat tristique enim, a lacinia felis ex sed lacus. Proin interdum sapien a laoreet ornare. Suspendisse id massa cursus, sodales mi malesuada, scelerisque neque. Nulla justo nisl, viverra gravida elit vitae, ultrices rutrum erat. Curabitur bibendum tempor diam, ac posuere neque iaculis non. Sed posuere lectus lectus, sed elementum felis condimentum vitae. Integer nec neque a nulla eleifend mattis.',
                    'Praesent vestibulum, ligula venenatis faucibus faucibus, ligula lacus tempus velit, eu volutpat justo dui sit amet mauris. Etiam posuere magna leo, eget suscipit odio efficitur eu. Mauris quis sagittis erat. Praesent eu ipsum venenatis, convallis enim sed, rhoncus risus. Aenean aliquam lacus ac dolor rutrum mattis. In hac habitasse platea dictumst. Nam aliquam nisi nec gravida cursus. Nam nisl ex, feugiat vitae metus vel, dapibus malesuada lorem. Mauris mattis molestie mi, ac auctor felis imperdiet nec. Donec interdum quam a mauris interdum, vitae imperdiet ante cursus. Donec a justo ac nunc fermentum finibus a nec tellus. Donec et molestie lorem.'
                ];

                $data = [];
                foreach ($queryRes as $qr) {
                    // record results
                    $adviceQuery = FountainAdviceQuery::create($userId, '', $query, $qr);
                    // create ratings for each result
                    $rating = FountainUsersRating::create($userId, $adviceQuery->getId(), $time, 0, '');
                    $data[] = [
                        'adviceQueryId' => $adviceQuery->getId(),
                        'ratingId' => $rating->getId(),
                        'userId' => $userId,
                        'result' => $qr
                    ];
                }
                $result['results'] = $data;
                $result['credit'] = $credit - $deductAmount;
                $result['success'] = true;
            } else {
                $result['type'] = 'credit_insufficient';
                $result['success'] = false;
            }

        } catch (\Exception $e) {
            $result['success'] = false;
            $result['exception'] = $e->getMessage();
            $result['type'] = 'exception';
        }
        return json_encode($result);
    }

    function updateRating(Request $request)
    {
        $ratingId = $request->get('ratingId');
        $userId = $request->get('userId');
        $value = $request->get('value');
        $result = ['ratingId' => $ratingId, 'value' => $value, 'success' => false];
        $time = new DateTime('now');

        try {
//            FountainUsersActivity::create($userId, $time, EVENT_TYPES::ASK_ADVICE)
            DB::table('users_rating')->where('rating_id', $ratingId)->update(['rating_value' => $value, 'rating_datetime' => $time]);
            $result['success'] = true;
        } catch (\Exception $e) {
            $result['exception'] = $e->getMessage();
            $result['type'] = 'exception';
        }
        return json_encode($result);
    }
}
