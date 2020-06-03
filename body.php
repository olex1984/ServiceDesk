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
    <div class="header_text"><h1><?= $header_text ?></h1></div>
    <div class="user_place">
      <?= "<br>Вход выполнен, ".$_SESSION['username'] ."
        <br><br>
        <a href='auth.php?logout'>Выйти</a>"; ?>
    </div>  
  </div>
  <!-- ТOP MENU-->
  <div class="navigation">
	  <a class="nav" href= <?= $_SERVER['PHP_SELF']?> > Главная </a>
    <a class="nav" href= <?= $_SERVER['PHP_SELF']."?action=add_ticket"?>>Создать обращение</a>
    <a class="nav" href= <?= $_SERVER['PHP_SELF']."?action=service_department_manage"?>>,,,,,,,,,,,,,,,,,,</a>
  </div>
  <!-- CONTENT-->
  <div class="parent">
      <h1><?= $form_header ?></h1>
      <?= $content ?>
    </div>
</div>
<!-- FOOTER-->
<div id="footer">
 <p> <a href="mailto:oleg.zitzer@gmail.com">Разработчик: Цитцер Олег<br>oleg.zitzer@gmail.com</a></p>
 <p>Саратов, Россия 2020</p>
</div>
</body>
</html>