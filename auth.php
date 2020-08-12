<?php 
session_start();
$_SESSION['pageFrom'] = "auth.php";
require_once "inc/config.php";
$outline = "";
$secret_input = "";
$id= 0;

if(isset($_GET['logout'])){
    $_SESSION['authenticated'] == false;
    session_destroy();
}

if( (isset($_SESSION['authenticated'])) and ($_SESSION['authenticated']) ){
    redirectURL("index.php");
}

if( isset($_POST['sub_enter'])  ){
    if((isset($_POST['secret_input'])) and ($_POST['secret_input'] == SECRET_PASSWORD) and (!empty($_POST['id'])) and (!empty($_POST['password'])) ){
        //======= Устанавливается ПАРОЛЬ
        //$result = "start update";
        //echo $result;
        $pwd = getHashPassword(trim($_POST['password']));
        $data = [$pwd, $_POST['id']];
        $sql = "UPDATE users SET password=? WHERE id=?";
        try{
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        /* $stmt->commit(); */
        }catch (Exception $e) {
            echo $e->getMessage();
            /* $stmt->rollBack(); */
            exit("Ошибка обновления пароля в БД.");
        }
        echo "UPDATED";
        //updateDataInTable($dbh, "users", $_POST['id'], $data, $_POST['password'])
    }
    
    if( (!empty($_POST['login'])) and (empty($_POST['password'])) ) { //============= ENTERED BLANK PASSWORD for ASSIGN PASSWORD
        
        $sql = "SELECT id,email,password,status FROM users WHERE email='" . $_POST['login'] ."'";
        $raw_data = getDataFromTable($dbh,$sql);
        $count = $raw_data->rowCount();
        if( $count == 1 ){
            $arr = $raw_data->fetch(PDO::FETCH_ASSOC);
            $id = (integer)$arr['id'];
            if(empty($arr['password']))
                $secret_input = "<input type='password' name='secret_input' placeholder='Введите секретное слово' />";
        }
    }

    if( (!empty($_POST['login'])) and (!empty($_POST['password'])) ) { //========= ENTERED LOGIN and PASSWORD
        
        $sql = "SELECT email,password,status FROM users WHERE email='" . $_POST['login'] ."'";
        $raw_data = getDataFromTable($dbh,$sql);
        $count = $raw_data->rowCount();
        
        if( $count == 1 ){
            
            $arr = $raw_data->fetch(PDO::FETCH_ASSOC);
            $hash = getHashPassword($_POST['password']);
            /* print_r($arr); */

            if( ($hash == $arr['password']) and ($arr['status']) ){ // All GOOD and Account is ENABLED
                $outline .= "<p style=\"color:green;\">Добро пожаловать снова, ".$_POST['login'] ."</p>";
                $_SESSION['username'] = $_POST['login'];
                $_SESSION['password'] = $arr['password'];
                $_SESSION['authenticated'] = "true";
                $_SESSION['client_ip'] = getClientIp();
                redirectURL("index.php");
                //header("Location: user_management.php");
                //header( "Refresh:1; url=user_management.php", true, 303);
            }elseif( ($hash != $arr['password']) and ($arr['status']) ){ // WRONG PASSWORD , status ENABLED
                if(empty($arr['password'])){
                    $outline .= "<p style=\"color:red;\">Данной учетной записи необходимо сменить пароль.</p>";
                    
                }else{
                    $outline .= "<p style=\"color:red;\">Вы ввели неправельный пароль.</p>";
                }
            }        
            elseif( ($hash == $arr['password']) and (!$arr['status']) ){ //====================== ACCOUNT is DISABLED
                $outline .= "<p style=\"color:red;\">Учетная запись заблокирована.</p>";
            }
        }elseif( $count > 1){
            $outline .= "<p style=\"color:red;\">Учетные данные ЗАДУБЛИРОВАНЫ.<br>Свяжитесь с системным администратором.</p>";
        }else{
            $outline .= "<p style=\"color:red;\">Учетные данные не найдены</p>";
        }
        //$outline .= print_r($GLOBALS);

    }
    if( (empty($_POST['login'])) and (empty($_POST['password'])) ) { //================= ENTERED ALL BLANK FIELDS
        $outline .= "<p style=\"color:red;\">Вы ввели пустые поля...</p>";
    }
}

?>

<html>
  <head>
    <title>Authentication</title>
    <link rel="stylesheet" type="text/css" href="inc/userManagement.css">
    <!-- <link rel="stylesheet" type="text/css" href="http://www.mysite.ru/main.css"> -->
    <style>
      table, td, tr { border: none; }
      table tr { border: none; }
      table td { border: none; }
      .adminka {
            float:right;
            background:url("pictures/google_admin_icon_131692.png");
            background-size: cover;
            width:48px;
            height: 48px;
      }
      .adminka:hover {
            float:right;
            background:url("pictures/google_admin_icon_131692_orange.png");
            background-size: cover;
            width:48px;
            height: 48px;
      }
      </style>
    
   </head>
    <body>
    <table >
        <tr >
            <td  width="200"><img src="pictures/logo-tritec-.png" /></td>
            <td><img src="pictures/logo-service-desk-orange.png" /></td>
            <td width="200" align="right"> <a  href="admin/" ><div class="adminka" ></div></a></td>
        </tr>
        <tr>
            <td></td>
            <td> 
            <div style="border: 1px solid #9b9b9b; width: 300px; margin: auto; border-radius: 3px;">    
            <?= $outline ?>
            <form method="POST" action=<?= $_SERVER['PHP_SELF'] ?> >
                Вход:<br>
                <p><input type="text" name="login" placeholder = "Логин(email)" <?php if(isset($_POST['login'])) echo "value=\"{$_POST['login']}\""; ?>/></p>
                <p><input type="password" name="password" placeholder = "Пароль"/></p>
                <p><?= $secret_input ?></p>
                <input type="submit" name="sub_enter" value = "Войти" />
                <input type="hidden" name="id" value=<?= $id ?> />
            </form>
            </div>
        </td>
            <td></td>
        </tr>
    </table>
    <p align="right">IP: <?= getClientIp();?> </p>
    <div id="footer">
        <p> <a href="mailto:oleg.zitzer@gmail.com">Разработчик: Цитцер Олег<br>oleg.zitzer@gmail.com</a></p>
        <p>Саратов, Россия <?= date("Y"); ?></p>
    </div>
    </body>
</html>
<?php 
//print_r($GLOBALS); 
//print_r(get_defined_vars());
?>

