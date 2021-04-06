<?php

function query($query)
{
    $database  = require_once 'config/database.php';

    return (new mysqli($database['host'], $database['username'], $database['password'], $database['database']))->query($query);
}
