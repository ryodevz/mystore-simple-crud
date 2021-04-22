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

use Illuminate\Support\Validation;

require_once __DIR__ . '/Illuminate/Support/Validation.php';

function e($text)
{
    return htmlspecialchars($text);
}

function config($fileName)
{
    return require_once "config/{$fileName}.php";
}

function component(string $fileName)
{
    return require_once __DIR__ . "/components/{$fileName}.php";
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

function getV()
{
    return (phpversion() ?? 0);
}

function redirect(string $to)
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

function ____($____)
{
    if ($____ !== 'Ryo ID') return base64_decode('UnlvIElE');

    return $____;
}

function old(string $field, $callback = null)
{
    if (isset($GLOBALS[$field])) return $GLOBALS[$field];

    return $callback;
}

function getMethod($server = false)
{
    return (isset($_POST['_method']) && ($server == false) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD']);
}

function setMethod(string $method)
{
    $method = e(strtoupper($method));

    switch ($method) {
        case 'GET':
            return '<input type="hidden" name="_method" value="' . $method . '" />';
        case 'POST':
            return '<input type="hidden" name="_method" value="' . $method . '" />';
        case 'PUT':
            return '<input type="hidden" name="_method" value="' . $method . '" />';
        case 'DELETE':
            return '<input type="hidden" name="_method" value="' . $method . '" />';
        default:
            return null;
    }
}

function allowedMethods(array $methods, $die = false)
{
    $userMethod = getMethod();

    foreach ($methods as $method) {
        if ($method == $userMethod) {
            return true;
        }
    }

    if ($die == true) return die(component('errors/MethodNotAllowed'));

    return false;
}

function import($path)
{
    return require_once $path;
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

function ___($___)
{
    return htmlspecialchars($___);
}
