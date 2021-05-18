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

class Auth
{
    private static $session_name = 'user';

    public static function check()
    {
        return self::user() ? true : false;
    }

    public static function user()
    {
        $user = $_SESSION[self::$session_name] ?? false;

        return ($user ? (object) $user : false);
    }

    public static function start()
    {
        return session_start();
    }

    public static function logout()
    {
        unset($_SESSION[self::$session_name]);

        return true;
    }
}
