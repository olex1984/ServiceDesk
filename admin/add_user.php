<?php
if($_GET['action'] == "add_user") {
   
    $add_user_outline = "
    <form enctype=\"multipart/form-data\" method='POST' action='".$_SERVER['PHP_SELF']."' >
    Email: <br><input type='text' name='inp_email' /> (будет использоваться в качестве Логина)<br>
    Пароль:<br> <input type='password' name='inp_pass' /> (используйте буквы латинского алфавита, цифры и спецфисмволы)<br>
    ФИО: <br><input type='text' name='inp_name' /> <br>
    Описание: <br><input type='text' name='inp_desc' /> (например: должность)<br>
    Заметки:<br> <textarea rows=\"5\" cols=\"45\" name=\"inp_note\"></textarea> (например: дополнительные контакты)<br>
    <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\" />
    ФОТО (макс.9МБ): <input name=\"user_photo\" type=\"file\" value=\"\" /> <br>
    <br><input type='submit' name='user_action' value='Сохранить'/>
    <input type=\"button\" onclick=\"javascript:window.location='user_management.php';\" value = 'Отмена'/>
    </form>
    ";

    //onclick="javascript:window.location='http://stackoverflow.com';"
    //<input type=\"button\" onclick=\"window.history.back()\" value = 'Отмена'/>
}
if($_GET['action'] == "changeUser"){
    $raw_data = getDataFromTable($dbh,"SELECT * FROM users WHERE `id` = ".$_GET['id'].";");
    $raw_data->setFetchMode(PDO::FETCH_NUM);
    $row = $raw_data->fetch();
    //print_r($GLOBALS);
    //print_r($row);
    $change_user_outline = "
    <form enctype=\"multipart/form-data\" method='POST' action='{$_SERVER['PHP_SELF']}' >
    <input type='hidden' name='id' value='".$row[0]."' /><br>
    <img width='96' height='96' src='../photo/". $row[6] .".jpg'alt=\"AVATAR\"><br>
    <label>".$row[1]."</label><br>
    Новый пароль: <br> <input type='password' name='inp_new_pass' /> (используйте буквы латинского алфавита, цифры и спецфисмволы)<br>
    ФИО: <br> <input type='text' name='inp_name' value='".$row[3]."'/> <br>
    Описание:  <br><input type='text' name='inp_desc' value='".$row[4]."'/> (например: должность)<br>
    Заметки:<br>
    <textarea rows=\"5\" cols=\"45\" name=\"inp_note\">".$row[5]."</textarea> <br>
    <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\" />
    ФОТО (макс.9МБ): <br> <input name=\"user_photo\" type=\"file\" value=\"\" /><br>
    <input type=\"hidden\" name=\"photoid\" value='".$row[6]."' /><br>
    <input type=\"checkbox\" name=\"status\" value=\"1\" ". (($row[7]==1)?'checked':'')."/>Активно<br> 
    <br><input type='submit' name='user_action' value='Обновить'/>
    <input type=\"button\" onclick=\"javascript:window.location='user_management.php';\" value = 'Отмена'/>
    <h1><p style='color:red; font-weight:bold;'>Удаление пользователя:</p></h1>
    <div>
      <img src=\"gd/noise-picture.php\" />
    </div>
    <p><input type='text' name='inp_captcha' placeholder='Код с картинки' /></p>
    <input type=\"submit\" name=\"delete_user\" value = 'Удалить пользователя'/>
    </form>
    ";

    //if($_SERVER['REQUEST_METHOD'])
    //print_r($GLOBALS);
}