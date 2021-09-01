<?php

error_reporting(E_ALL);

$composerAutoload = __DIR__ . '/../vendor/autoload.php';

if (is_file($composerAutoload)) {
    require_once $composerAutoload;
}

DG\BypassFinals::enable();