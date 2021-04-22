<?php

/*
|--------------------------------------------------------------------------
| Author
|--------------------------------------------------------------------------
|
| Name: Ryo ID
| Repo: https://github.com/ryodevz/mystore-simple-crud
|
*/

namespace Illuminate\Support;

class Database
{
    private static $_____ = 'database';

    public static function query($___)
    {
        return self::_()->query($___);
    }

    public static function _()
    {
        $database  = config(self::$_____);

        return new \mysqli($database['host'], $database['username'], $database['password'], $database['database']);
    }
}
