<?php

$app = require_once __DIR__ . '/../config/app.php';

require_once '../bootstrap/core.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $app['name'] ?></title>

    <link rel="stylesheet" href="/assets/css/app.css">

</head>

<body id="app">

    <div class="container">
        <div class="header">
            <h1><?= $app['name'] ?></h1>
            <ul>
                <li><a href="/"><?= ___('Home') ?></a></li>
                <li><a href="/create.php"><?= ___('Tambah') ?></a></li>
                <li><a href="/auth/logout.php"><?= ___('Logout') ?></a></li>
            </ul>
        </div>

        <div class="border"></div>