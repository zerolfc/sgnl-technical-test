<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../vendor/autoload.php';

use Inc\EntryPoint;
use Inc\Helper;

$cn = trim($_GET['cn']) ?? '';

$entryPoint = new EntryPoint($cn);

echo Helper::jsonOutput($entryPoint->result());
