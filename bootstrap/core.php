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

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
|
*/
require_once __DIR__ . '/../helpers.php';

/*
|--------------------------------------------------------------------------
| DB
|--------------------------------------------------------------------------
|
*/
require_once __DIR__ . '/../Illuminate/Support/Database.php';

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
|
*/
require_once __DIR__ . '/../Illuminate/Support/Auth.php';

/*
|--------------------------------------------------------------------------
| Str
|--------------------------------------------------------------------------
|
*/
require_once __DIR__ . '/../Illuminate/Support/Str.php';

/*
|--------------------------------------------------------------------------
| Req
|--------------------------------------------------------------------------
|
*/
if (getV() < base64_decode('Ny40LjE1')) return die(base64_decode('VGhlIG1pbmltdW0gcGhwIHZlcnNpb24gcmVxdWlyZWQgdG8gcnVuIHRoaXMgYXBwbGljYXRpb24gaXMgNy40LjA='));
