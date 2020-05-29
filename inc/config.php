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
define("USERS_ON_PAGE",25);
//================================================================== SERVICE
define("DIGITS",[0,1,2,3,4,5,6,7,8,9]);
define("ALPHABET",['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z']);
//================================================================== PHOTO - LOGO 
if(isWindows())
define("FONT_PATH","C:/xampp/htdocs/servicedesk/bellb.ttf");
if(!isWindows())
define("FONT_PATH","/var/www/html/servicedesk/bellb.ttf");

define("USER_PHOTO_PATH_ADMIN","../photo/");
define("USER_PHOTO_PATH","photo/");
define("PHOTOID","1");
define("FILL_COLOR", "e86d1f");
define("LOGO",USER_PHOTO_PATH."logo_square.jpg");
//=================================================================== SLA
define("TIME_REGISTER",1800);//30 мин на принятие заявки
//define("TIME_")

require_once "config.additional.php";

connectSqlServer(SERVER, DB, DB_USER, DB_PASS);
