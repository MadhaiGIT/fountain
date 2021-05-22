<?php


namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;


class TestController extends BaseController
{
    public function ping()
    {
        return json_encode(array('success' => true, 'message' => 'pong'));
    }
}
