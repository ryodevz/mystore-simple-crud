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

class Str
{
    public static function random($length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }

    public static function upper($value)
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    public static function lower($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }
}
