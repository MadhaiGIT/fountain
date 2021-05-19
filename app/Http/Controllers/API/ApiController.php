<?php


namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;


class ApiController extends BaseController
{
    public function ping() {
        return 'pong';
    }
}
