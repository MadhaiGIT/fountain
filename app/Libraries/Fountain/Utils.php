<?php


namespace App\Libraries\Fountain;


class Utils
{
    public static function Debug($msg) {
        echo $msg;
    }

    public static function StdClassToArray($stdClass): array
    {
        return (array)json_decode(json_encode($stdClass));
    }
}
