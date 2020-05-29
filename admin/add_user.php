<?php
    
  
if($_GET['action'] == "add_user") {
  if(isset($error_add_user))
    $add_user_outline = $error_add_user ." 
    <form enctype=\"multipart/form-data\" method='POST' action='{$_SERVER['PHP_SELF']}' >
    Email: <br><input type='text' name='inp_email' value='{$_POST['inp_email']}' /><span class='warning_text'>*</span> (будет использоваться в качестве Логина)<br>
    Пароль:<br> <input type='password' name='inp_pass' /><span class='warning_text'>*</span> (используйте буквы латинского алфавита, цифры и спецфисмволы)<br>
    ФИО: <br><input type='text' name='inp_name' value='{$_POST['inp_name']}' /> <br>
    Описание: <br><input type='text' name='inp_desc' value='{$_POST['inp_desc']}' /> (например: должность)<br>
    Заметки:<br> <textarea rows=\"5\" cols=\"45\" name=\"inp_note\">{$_POST['inp_note']}</textarea> (например: дополнительные контакты)<br>
    <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\" />
    ФОТО (макс.9МБ): <input name=\"user_photo\" type=\"file\" value=\"\" /> <br>
    <br><input type='submit' name='user_action' value='Сохранить'/>
    <input type=\"button\" onclick=\"javascript:window.location='user_management.php';\" value = 'Отмена'/>
    </form><br>
    <span class='warning_text'>* - обязательные поля</span>
    ";

    if(!isset($error_add_user))
    $add_user_outline = "
    <form enctype=\"multipart/form-data\" method='POST' action='{$_SERVER['PHP_SELF']}' >
    Email: <br><input type='text' name='inp_email' /><span class='warning_text'>*</span> (будет использоваться в качестве Логина)<br>
    Пароль:<br> <input type='password' name='inp_pass' /><span class='warning_text'>*</span> (используйте буквы латинского алфавита, цифры и спецфисмволы)<br>
    ФИО: <br><input type='text' name='inp_name' /> <br>
    Описание: <br><input type='text' name='inp_desc' /> (например: должность)<br>
    Заметки:<br> <textarea rows=\"5\" cols=\"45\" name=\"inp_note\"></textarea> (например: дополнительные контакты)<br>
    <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\" />
    ФОТО (макс.9МБ): <input name=\"user_photo\" type=\"file\" value=\"\" /> <br>
    <br><input type='submit' name='user_action' value='Сохранить'/>
    <input type=\"button\" onclick=\"javascript:window.location='user_management.php';\" value = 'Отмена'/>
    </form>
    <br>
    <span class='warning_text'>* - обязательные поля</span>
    ";

    //onclick="javascript:window.location='http://stackoverflow.com';"
    //<input type=\"button\" onclick=\"window.history.back()\" value = 'Отмена'/>
}
if($_GET['action'] == "changeUser"){
    $raw_data = getDataFromTable($dbh,"SELECT * FROM users WHERE `id` = ".$_GET['id'].";");
    $raw_data->setFetchMode(PDO::FETCH_NUM);
    $row = $raw_data->fetch();
    
    $change_user_outline = "
    <form enctype=\"multipart/form-data\" method='POST' action='{$_SERVER['PHP_SELF']}' >
		<table cellpadding='5px' style='border:none;'><tr>
     <td style='text-align:left; border:none;'>
      <h2>".$row[3]."<br></h2>".$row[1]."<br>
      <input type=\"checkbox\" name=\"status\" value=\"1\" ". (($row[7]==1)?'checked':'')."/>Активно<br>
      Новый пароль:<br><input type='password' size='35' name='inp_new_pass' /> (используйте буквы латинского алфавита, цифры и спецфисмволы)<br>
      ФИО: <br> <input type='text' size='35' name='inp_name' value='".$row[3]."'/> <br>
      Описание:  <br><input type='text' size='35' name='inp_desc' value='".$row[4]."'/> (например: должность)<br>
      Заметки:<br>
      <textarea rows=\"5\" cols=\"45\" name=\"inp_note\">".$row[5]."</textarea> <br>
        
      <input type=\"hidden\" name=\"photoid\" value='".$row[6]."' /><br>
        
      <br><input type='submit' name='user_action' value='Обновить'/>
      <input type=\"button\" onclick=\"javascript:window.location='user_management.php';\" value = 'Отмена'/>		
    </td>
    <td width='200px' style='border:none;text-align: center; vertical-align: top;'>
        <img width='150' height='150' src='../photo/". $row[6] .".jpg'alt=\"AVATAR\"><br>
        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\" />
        Изменить фото(макс.9МБ): <br> <input name=\"user_photo\" type=\"file\" value=\"\" />
        <input type='hidden' name='id' value='".$row[0]."' />
    </td>    
    </tr>
    </table>
    
    <table cellpadding='5px' style='border-top: 1px solid #6c6c6c; border-left: none; border-bottom: 1px solid #6c6c6c; border-right: none; text-align:left;'><tr>
    <td style='border: none; text-align:left;'>
    <h1><p style='color:red; font-weight:bold;'>Удаление пользователя:</p></h1>
    <div>
      <img src=\"gd/noise-picture.php\" />
    </div>
    <p><input type='text' name='inp_captcha' placeholder='Код с картинки' /></p>
    <input type=\"submit\" name=\"delete_user\" value = 'Удалить пользователя'/>
    </td>
    </tr></table>
    
    </form>
    ";
    //if($_SERVER['REQUEST_METHOD'])
    //print_r($GLOBALS);
    
}