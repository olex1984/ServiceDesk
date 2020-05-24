<?php
session_start();
require_once "inc/lib.php";
$outline = "";

setlocale(LC_ALL,"russian");
define("SERVER","localhost");
define("DB","servicedesk");
define("DB_USER","sdUser");
define("DB_PASS","\$dU\$er");

define("USER_PHOTO_PATH","C:/xampp/htdocs/servicedesk/photo/");
define("PHOTOID","1");

require_once "config.additional.php";


connectSqlServer(SERVER, DB, DB_USER, DB_PASS);
