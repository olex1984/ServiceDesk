<?php
session_start();
require_once "inc/lib.php";
$outline = "";
//=================================================================== SQL 
setlocale(LC_ALL,"russian");
define("SERVER","localhost");
define("DB","servicedesk");
define("DB_USER","sdUser");
define("DB_PASS","\$dU\$er");
define("USERS_ON_PAGE",5);
//================================================================== PHOTO - LOGO 
define("USER_PHOTO_PATH","C:/xampp/htdocs/servicedesk/photo/");
define("PHOTOID","1");
define("FILL_COLOR", "e86d1f");
define("LOGO",USER_PHOTO_PATH."logo_square.jpg");
//=================================================================== SLA
define("TIME_REGISTER",1800);//30 мин на принятие заявки
//define("TIME_")

require_once "config.additional.php";

connectSqlServer(SERVER, DB, DB_USER, DB_PASS);
