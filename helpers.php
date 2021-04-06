<?php

use Support\Validation;

require_once 'Support/Validation.php';


function e($text)
{
    return htmlspecialchars($text);
}

function GET(string $name, $callback = null)
{
    return (isset($_GET[$name]) ? $_GET[$name] : ($callback));
}

function POST(string $name, $callback = null)
{
    return (isset($_POST[$name]) ? $_GET[$name] : ($callback));
}

function exist(string $field)
{
    if ($field) return true;

    return false;
}

function redirect($to)
{
    return header('location: ' . $to);
}

function nulls(array $fields)
{
    foreach ($fields as $field) {
        if (!($field['field'])) $errors[$field['label']] = "The {$field['label']} field is requried.";
    }

    return (isset($errors) ? $errors : false);
}

function error(string $field)
{
    if (isset($GLOBALS['status']['error'][$field])) return '<p class="text-red">'  . $GLOBALS['status']['error'][$field] . '</p>';

    return false;
}

function firstError()
{
    return (isset($GLOBALS['_first_error_']) ? $GLOBALS['_first_error_'] : false);
}

function old(string $field, $callback = null)
{
    if (isset($GLOBALS[$field])) return $GLOBALS[$field];

    return $callback;
}

function validate(array $fields)
{
    foreach ($fields as $field) {
        $value = $GLOBALS[$field['name']];
        $rules = explode('|', $field['rules']);

        foreach ($rules as $rule) {

            $parse_rule = explode(':', $rule);

            $rule = $parse_rule[0];

            $response = Validation::$rule($field['name'], $value, $parse_rule);

            if (!($response['status'])) {

                $GLOBALS['_first_error_'] = $response['message'];

                return [
                    'error' => [
                        $field['name'] => $response['message']
                    ]
                ];
            }
        }
    }

    return [
        'status' => true
    ];
}
