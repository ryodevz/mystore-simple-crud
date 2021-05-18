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
| Supports
|--------------------------------------------------------------------------
|
*/
foreach (glob(__DIR__ . '/../Illuminate/Support/*.php') as $support) {
    require_once $support;
}

if (getV() < base64_decode('Ny40LjE1')) return die(base64_decode('VGhlIG1pbmltdW0gcGhwIHZlcnNpb24gcmVxdWlyZWQgdG8gcnVuIHRoaXMgYXBwbGljYXRpb24gaXMgNy40LjA='));
