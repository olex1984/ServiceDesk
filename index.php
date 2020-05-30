<?php
require_once "inc/config.php";
$form_header = "<h1>Service Desk</h1>";
//================================SESSION CHECK =========================================
/* if( (!isset($_SESSION['username'] ) ) or ( !isset($_SESSION['password'] ) ) or ( !isset($_SESSION['authenticated']) ) ) */
if(!isset($_SESSION['authenticated']) or (!$_SESSION['authenticated']) or ($_SESSION['client_ip'] != getClientIp()) )
{
  session_destroy();
  redirectURL("auth.php");
  exit("Вы не авторизованы в системе");
   }else{
  $username = $_SESSION['username'];
}
?>
<!-- =============================== HTML HTML HTML ============================ -->
<!DOCTYPE HTML>
<html lang="ru">
  <head>
  <!-- Подключаемые файлы, метатеги, название страницы -->
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <!-- Кодировка страницы-->
  <meta charset="utf-8"/> 
  <title>Управление пользователями</title>
    <link rel="stylesheet" type="text/css" href="inc/userManagement.css" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css" />
    <link type="text/plain" rel="author" href="http://localhost/servicedesk/humans.txt" />
    <!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
  <!-- Тело сайта, отвечает за вывод на страницу-->
<div id="wrapper">
  <!-- HEADER-->
	<div class="header">
    <div class="logotip">
    </div>
    <div class="header_text"><h1>SERVICE DESK</h1></div>
    <div class="user_place">
      <?= "<br>Вход выполнен, ".$_SESSION['username'] ."
        <br><br>
        <a href='auth.php?logout'>Выйти</a>"; ?>
    </div>  
  </div>
  <!-- ТOP MENU-->
  <div class="navigation">
	  <a class="nav" href= <?= $_SERVER['PHP_SELF']?> > Главная </a>
    <a class="nav" href= <?= $_SERVER['PHP_SELF']."?action=add_user"?>>Создать обращение</a>
    <a class="nav" href= <?= $_SERVER['PHP_SELF']."?action=service_department_manage"?>>,,,,,,,,,,,,,,,,,,</a>
  </div>
  <!-- CONTENT-->
  <div class="parent">
      <h1><?= $form_header ?></h1>
      <?= $outline ?>
    </div>
</div>
<!-- FOOTER-->
<div id="footer">
 <p> <a href="mailto:oleg.zitzer@gmail.com">Разработчик: Цитцер Олег<br>oleg.zitzer@gmail.com</a></p>
 <p>Саратов, Россия 2020</p>
</div>
</body>
</html>

<?php
//print_r($GLOBALS);