<?php
$lugar = 1;
if ($lugar == 1)
    $base_url = 'http://192.168.1.10/claudio/';
elseif ($lugar == 2)
    $base_url = 'http://192.168.1.11/claudio/';
elseif ($lugar == 3)
    $base_url = 'http://localhost/claudio/';

$modulos_url = $base_url . 'appmodules/';