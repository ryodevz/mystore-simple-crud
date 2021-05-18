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

use Illuminate\Support\Auth;
use Illuminate\Support\Database;

require_once '../bootstrap/core.php';
allowedMethods(['DELETE'], true);

Auth::start();

if (!Auth::check()) {
    return redirect('/auth/login.php');
}

$item_id = e((int)$_GET['id'] ?? null);

if (!$item_id) return redirect('/');

Database::query("DELETE FROM `barang` WHERE `barang`.`id` = $item_id");

return redirect("/?action=delete&status=success&item_id={$item_id}");
