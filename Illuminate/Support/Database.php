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
    private static $filename = 'database';

    public static function query($query)
    {
        return self::connection()->query($query);
    }

    public static function connection()
    {
        $database  = config(self::$filename);

        return new \mysqli($database['host'], $database['username'], $database['password'], $database['database']);
    }
}
