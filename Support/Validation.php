<?php

namespace Support;

class Validation
{
    public static function required($field, $value)
    {
        if ($value) return ['status' => true];

        return ['status' => false, 'message' => "The {$field} field is required."];
    }

    public function array($field, $value)
    {
        if (is_array($value)) return ['status' => true];

        return ['status' => false, 'message' => "The {$field} must be an array."];
    }

    public function integer($field, $value)
    {
        if (is_integer($value)) return ['status' => true];

        return ['status' => false, 'message' => "The {$field} must be an integer."];
    }

    public function string($field, $value)
    {
        if (is_string($value)) return ['status' => true];

        return ['status' => false, 'message' => "The {$field} must be a string."];
    }

    public function min($field, $value, $params)
    {
        if (strlen($value) >= $params[1]) return ['status' => true];

        return ['status' => false, 'message' => "The {$field} must be at least {$params[1]}."];
    }

    public function max($field, $value, $params)
    {
        if (strlen($value) <= $params[1]) return ['status' => true];

        return ['status' => false, 'message' => "The {$field} may not be greater than {$params[1]}."];
    }
}
