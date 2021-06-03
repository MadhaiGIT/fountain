<?php


namespace App\Http\Controllers\API;

use App\Libraries\Fountain\FountainUsersRating;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use DateTime;


class ApiController extends BaseController
{
    function chargeStatus(Request $request) {
//        $json = $request->getContent();
//        FountainUsersRating::create(0, 0, null, 0, $json);
        return 'ok';
    }
}
