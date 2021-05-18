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

require_once '../../bootstrap/core.php';
allowedMethods(['GET'], true);

Auth::start();
Auth::logout();

return redirect('/auth/login.php');
