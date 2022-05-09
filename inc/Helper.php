<?php 

namespace Inc;

class Helper {

    public static function jsonOutput(array $data)
    {

        header('Content-Type: application/json; charset=utf-8');

        return json_encode($data);
    }

}


