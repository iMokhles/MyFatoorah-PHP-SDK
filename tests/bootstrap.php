<?php
/**
 * Created by PhpStorm
 * FileName: bootstrap.php
 * User: imokhles
 * Date: 17/11/2020
 * Time: 00:48
 * Copyright 2020 imokhles, All rights reserved
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');
// To suppress the warning during the date() invocation in logs, we would default the timezone to GMT.
if (!ini_get('date.timezone')) {
    date_default_timezone_set('GMT');
}
// Include the composer autoloader
$loader = require dirname(__DIR__) . '/vendor/autoload.php';
$loader->add('iMokhles\\MyFatoorahAPI\\Test', __DIR__);