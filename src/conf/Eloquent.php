<?php

/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 06/12/2016
 * Time: 11:23
 */

namespace conf;

use Illuminate\Database\Capsule\Manager as DB;

class Eloquent
{
    public static function init ($filename){
        $db = new DB();
        $db -> addConnection(parse_ini_file($filename));
        $db -> setAsGlobal();
        $db ->bootEloquent();
    }
}