<?php
require_once "inc/config.php";
$outline = "";

if(isset($_GET['logout'])){
    $_SESSION['authenticated'] == false;
    session_destroy();
}

if( (isset($_SESSION['authenticated'])) and ($_SESSION['authenticated']) ){
    redirectURL("index.php");
}

if( isset($_POST['sub_enter'])  ){
    if( (!empty($_POST['login'])) and (!empty($_POST['password'])) ) {
        $sql = "SELECT login,password FROM admins WHERE login='" . $_POST['login'] ."'";
        $raw_data = getDataFromTable($dbh,$sql);
        $count = $raw_data->rowCount();
        if( $count == 1 ){
            $arr = $raw_data->fetch(PDO::FETCH_ASSOC);
            $hash = getHashPassword($_POST['password']);
            if( $hash == $arr['password']){
                $outline .= "<p style=\"color:green;\">Добро пожаловать снова, ".$_POST['login'] ."</p>";
                $_SESSION['username'] = $_POST['login'];
                $_SESSION['password'] = $arr['password'];
                $_SESSION['authenticated'] = "true";
                redirectURL("index.php");
                //header("Location: user_management.php");
                //header( "Refresh:1; url=user_management.php", true, 303);
            }
        }elseif( $count > 1){
            $outline .= "<p style=\"color:red;\">Учетные данные ЗАДУБЛИРОВАНЫ.<br>Свяжитесь с системным администратором.</p>";
        }else{
            $outline .= "<p style=\"color:red;\">Учетные данные не найдены</p>";
        }
        //$outline .= print_r($GLOBALS);

    }else{
        $outline .= "<p style=\"color:red;\">Вы ввели пустые поля...</p>";
    }
}

?>

<html>
  <head>
    <title>Authentication</title>
    <link rel="stylesheet" type="text/css" href="inc/userManagement.css">
    <!-- <link rel="stylesheet" type="text/css" href="http://www.mysite.ru/main.css"> -->
   </head>
    <body>
    <div style="max-width: 1000px; margin: auto; border:1px solid black;">
    	<div style="margin:auto;">
            <div style="display:table-cell; width:210px; background: url(pictures/logo-tritec-.png) no-repeat; height: 100px; text-align:center;"> 
            </div>
            <div  style="display:table-cell; width:210px; background: url(pictures/logo-service-desk1.png) no-repeat; height: 100px; text-align:center;"> 
            </div>
            <div  style="display:table-cell; width:210px; background: url(pictures/logo-tritec-.png) no-repeat;"> 
            </div>
        </div>
        <div align="center" style = "border:2px gray solid; width:300px; margin:0 auto;">
            <?= $outline ?>
            <form method="POST" action=<?= $_SERVER['PHP_SELF'] ?> >
                Вход:<br>
                <p><input type="text" name="login" placeholder = "Логин(email)"/></p>
                <p><input type="password" name="password" placeholder = "Пароль"/></p>
                <input type="submit" name="sub_enter" value = "Войти" />
            </form>
        </div>
</div>
      
<div id="footer">
 <p> <a href="mailto:oleg.zitzer@gmail.com">Author: Oleg Citcer<br>oleg.zitzer@gmail.com</a></p>
 <p>Saratov, Russia 2020</p>
</div>
</body>
</html>
<?php //print_r($GLOBALS); ?>

