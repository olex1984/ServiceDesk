<?php
require_once "inc/config.php";
$content = "";

if( (isset($_GET['action'])) and ($_GET['action']=="add_ticket")) {
    try{
        $stmt = getDataFromTable($dbh,"SELECT name FROM users ORDER BY name ASC");
        $user_names = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $stmt = getDataFromTable($dbh,"SELECT * FROM users WHERE email='" . $_SESSION['username'] . "'");
        $creator_data = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) 
    {   //  <<<<<<======================================== ERROR ERROR ERROR =======================
        $error = "Error:".iconv("windows-1251", "UTF-8",$e->getMessage());
        echo $error;
        return $error;
    }
    $content .= "
    <form method='POST' action='add_ticket.php'>
    <p>Создатель:<br>
    <input type='text name='creator' value='{$creator_data['name']}' disabled /></p>
    <p>От имени кого:<br>
    <select name='owner' required>
    <option value='{$creator_data['name']}'>{$creator_data['name']}</option>";
    foreach($user_names as $val)
        $content .= "<option value='{$val}'>$val</option>";
    $content .= "</select></p>
    <p>Контроль/Копия:<br>
    <select name='control' ><option value='blank'></option>";
    foreach($user_names as $val)
        $content .= "<option value='{$val}'>$val</option>";
    $content .= "</select></p>
    <p>Тема:<br>
    <input type='text' name='subject' placeholder='Тема обращения' required/></p>
    <p>Описание:<br>
    <textarea rows=\"5\" cols=\"45\" name='description'></textarea></p>
    <p><input type='submit' name='add_ticket'value='Отправить' /> 
    <input type=\"button\" onclick=\"javascript:window.location='index.php';\" value = 'Отмена'/>
    </p>
    </form>
    ";
   /*  $content .="<br><br>
        <span class='warning_text'>* - обязательные поля</span>";
 */
}

if( isset($_POST['add_ticket']) ) { // ===========================CREATION NEW TICKET
    $stmt = getDataFromTable($dbh,"SELECT id FROM users WHERE name ='".$_POST."'");
    $user_names = $stmt->fetchAll(PDO::FETCH_COLUMN);

}