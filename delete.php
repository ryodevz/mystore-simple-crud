<?php

require_once 'helpers.php';
require_once 'connection.php';

$item_id = e((int)$_GET['id'] ?? null);

if (!$item_id) return redirect('/');

query("DELETE FROM `barang` WHERE `barang`.`id` = $item_id");

return redirect("/?action=delete&status=success&item_id={$item_id}");
