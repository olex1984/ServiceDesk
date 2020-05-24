<?php
require_once "inc/config.php";
$form_header = "<h1 style='color: #5e9ca0;'>Управление пользователями.</h1>";
//================================SESSION CHECK =========================================
/* if( (!isset($_SESSION['username'] ) ) or ( !isset($_SESSION['password'] ) ) or ( !isset($_SESSION['authenticated']) ) ) */
if(!isset($_SESSION['authenticated']) or (!$_SESSION['authenticated']))
{
  redirectURL("auth.php");
  exit("Вы не авторизованы в системе");
   }else{
  $username = $_SESSION['username'];
}


//================ USERS OPERATIONS ======================
if((!isset($_POST['user_action'])) and (!isset($_GET['action']))){
    $raw_data = getDataFromTable($dbh,"SELECT * FROM users;");
    $outline = " <table style='border:2pt solid black;'><tr>
            <th>ID</th><th>Email</th><th>Password</th><th>ФИО</th><th>Описание</th><th>Разное</th><th>Фото ID</th><th>Актвиный</th>
        </tr>";
    $outline .= drawUsersTable($raw_data);
    $outline .= "</table>";
}

if(isset($_POST['user_action']) and $_POST['user_action'] == "Сохранить") 
{

  $uniqid = uploadUserPhoto();
  if( ($uniqid != "false") and ($uniqid != "") ){
    $data = [htmlspecialchars(trim($_POST['inp_email'])),getHashPassword(htmlspecialchars(trim($_POST['inp_pass']))),htmlspecialchars(trim($_POST['inp_name'])),$_POST['inp_desc'],$_POST['inp_note'],$uniqid,1];
    //unset($_POST)
    $outline = setDataInToTable($dbh, "users", $data);
    redirectURL("user_management.php");
    }else
    {
    $data = [htmlspecialchars(trim($_POST['inp_email'])),getHashPassword(htmlspecialchars(trim($_POST['inp_pass']))),htmlspecialchars(trim($_POST['inp_name'])),$_POST['inp_desc'],$_POST['inp_note'],PHOTOID,1];
    $outline = setDataInToTable($dbh, "users", $data);
    redirectURL("user_management.php");
    $outline .= "<pre>Warning!!! Ваша фотография не была загружена на сервер. Попробуйте загрузить фото через редактирование профиля пользователя.</pre>";
    }
    //print_r($GLOBALS);
    $raw_data = getDataFromTable($dbh,"SELECT * FROM users;");
    $outline .= " <table style='border:2pt solid black;'><tr>
            <th>ID</th><th>Email</th><th>Password</th><th>ФИО</th><th>Описание</th><th>Разное</th><th>Фото ID</th><th>Актвиный</th>
        </tr>";
    $outline .= drawUsersTable($raw_data);
    $outline .= "</table>";
  }
 
if(isset($_POST['user_action']) and $_POST['user_action'] == "Обновить")
{
  if($_FILES['user_photo']['size'] > 0) {
      $uniqid = uploadUserPhoto();
      if($uniqid == "false") 
        $uniqid = $_POST['photoid'];
  }else{
    $uniqid = $_POST['photoid'];
  }
        if(isset($_POST['status'])){
    $status = 1;
  }else{
    $status = 0;
  }
  $data = [$_POST['inp_name'],$_POST['inp_desc'],$_POST['inp_note'],$uniqid,$status];
  if(empty($_POST['inp_new_pass'])){
    $outline = updateDataInTable($dbh, "users", $_POST['id'], $data);
  }else{
    $outline = updateDataInTable($dbh, "users", $_POST['id'], $data, $_POST['inp_new_pass']);
  }
  
    //if(empty($_POST['inp_new_pass'])) $outline .="<p>PASS is EMPTY</p>";
    
    $raw_data = getDataFromTable($dbh,"SELECT * FROM users;");
    $outline .= " <table style='border:2pt solid black;'><tr>
            <th>ID</th><th>Email</th><th>Password</th><th>ФИО</th><th>Описание</th><th>Разное</th><th>Фото ID</th><th>Актвиный</th>
        </tr>";
    $outline .= drawUsersTable($raw_data);
    $outline .= "</table>";
}
if(isset($_POST['delete_user'])){
  if( $_SESSION['randStr'] == $_POST['inp_captcha'] ){
    //$outline = "DELETE user {$_POST['id']}:".$_SESSION['randStr']." = ". $_POST['inp_captcha'];
    $outline = deleteUserFromTable($dbh,"users",$_POST['id'],$_POST['photoid']);
    redirectURL("user_management.php");
  }else{
    $outline = "Вы ввели неправильный код с картинки. <input type='button' value=' Вернуться назад' onClick='window.history.back()'";
  }
}
  //============================ USER FORMS REDIRECT ==============
if(isset($_GET['action'])){
  if($_GET['action'] == "add_user") {
    require_once "add_user.php";
    $form_header = "<h1 style='color: #5e9ca0;'> Добавление нового пользователя:</h1>";
    $outline = $add_user_outline;
  }elseif($_GET['action'] == "changeUser") {
    require_once "add_user.php";
    $form_header = "<h1 style='color: #5e9ca0;'> Изменение учетной записи пользователя:</h1>";
    $outline = $change_user_outline;
  }elseif($_GET['action'] == "service_department_manage") {
    require_once "service_department.php";
    $form_header = "<h1 style='color: #5e9ca0;'> Управление сервисным подразделением</h1>";
    $outline = $out_service_department;
  }
}

?>

<html>
  <head>
    <title>Управление пользователями</title>
    <link rel="stylesheet" type="text/css" href="inc/userManagement.css">
    <!-- <link rel="stylesheet" type="text/css" href="http://www.mysite.ru/main.css"> -->
   </head>
  <body>
  <p>
  <div style="float: left; width: 80%; border:1px black;">
    <a href= <?= $_SERVER['PHP_SELF']?>> ... </a>
    <a href= <?= $_SERVER['PHP_SELF']."?action=add_user"?>>Добавить нового пользователя</a>
    <a href= <?= $_SERVER['PHP_SELF']."?action=service_department_manage"?>>Настроить подразделение исполнителя</a>
  </div>
  <div style="float: left; width: 20%; border:1px red;">
  <?= "<p align='center' style=\"color:green;\">Вход выполнен,".$_SESSION['username'] ."</p>
  <p align='center'><img src=\"../photo/admin.jpg\" width='64' height='64'/></p>
  <p align='center'><a href='auth.php?logout'>Выйти</a></p>"; ?>
  </div>
  </p>

    <h1><?= $form_header ?></h1>
    <?= $outline ?>

    
  </body>
</html>
<?php
//print_r($GLOBALS);
