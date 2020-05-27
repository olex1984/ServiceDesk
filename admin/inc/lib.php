<?php
//============================================================ SYSTEM ====================
function redirectURL($url){
    header("HTTP/1.1 303 See Other");
    header("Location: $url");
    exit("Перенаправление на другую страницу");
}
/* 
##################### MYSQL ###############################
*/
function connectSqlServer($server, $db, $db_user, $db_pass){
    try
    {
        GLOBAL $dbh;
        $dbh = new PDO("mysql:host=".$server.";dbname=".$db.";charset=utf8", $db_user, $db_pass,[ PDO::ATTR_EMULATE_PREPARES => false, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }catch (PDOException $e){               //  <<<<<<======================================== ERROR ERROR ERROR =======================
        $error = "Error:".iconv("windows-1251", "UTF-8",$e->getMessage());
        echo $error;
        return $error;
    }
}
 
function getDataFromTable($dbh, $query)
{
    try
    {
        $result = $dbh->query($query);
        return $result;
    }catch (PDOException $e){   //  <<<<<<======================================== ERROR ERROR ERROR =======================
        $error = "Error:".iconv("windows-1251", "UTF-8",$e->getMessage());
        echo $error;
        return $error;
    }
}

function setDataInToTable($dbh, $table, $data)
{
    try
    {
    $data = $data;
    $count = count($data);
    $safe_data = [];
    for($i=0; $i<$count; $i++){
        $safe_data[] = htmlspecialchars(trim($data[$i]));
    }
    
    if($count > 0)
        {
            $a = [];
            for($i=0; $i<$count; $i++){
                $a[$i] = "?";
            }
            $pseudo = implode(",",$a);
            $critery = implode(",",$data);
            $critery = $dbh->quote($critery);
            $stmt = $dbh->prepare("INSERT INTO " . $table . " values ('', ". $pseudo .")"); // довести до конца просчет ? в зависимости сколько данных в массиве 
            $stmt->execute($safe_data);
            //$info = $stmt->errorInfo();
            return "Успешно.";
        } else {
           return "Вы не заполнили обязательные поля. Пользователь не добавлен.";   // ПЕРЕДЕЛАТЬ ---- НЕПРАВИЛЬНЫЙ ОБРАБОТЧИК ПУСТОГО ПОЛЯ
        }
    }catch(PDOException $e){        //  <<<<<<======================================== ERROR ERROR ERROR =======================
        return "Error:" . iconv("windows-1251", "UTF-8",$e->getMessage());
    } 
}
function updateDataInTable($dbh, $table, $id, $data, $password = NULL)
{
    try
    {
    $data = $data;
    $count = count($data);
    $safe_data = [];
    for($i=0; $i<$count; $i++){
        $safe_data[] = htmlspecialchars(trim($data[$i]));
    }
    if($count > 0)
        {
            $a = [];
            for($i=0; $i<$count; $i++){
                $a[$i] = "?";
            }
            $pseudo = implode(",",$a);
            if(!is_null($password)) {
                    $sql = "UPDATE ".$table." SET password=?, name=?, description=?, note=?, photo_id=?, status=? WHERE id=?";
                    $arr = [getHashPassword($password)];
                    foreach($safe_data as $val)
                        $arr[] = $val;
                    $arr[] = $id;
                    
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute($arr);
            }
            if(is_null($password)){
                    $arr = $safe_data;
                    $arr[] = $id;
                    $sql = "UPDATE ".$table." SET name=?, description=?, note=?, photo_id=?, status=? WHERE id=?";
                    
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute($arr);
                    //$dbh->prepare($sql)->execute($arr);
            }
            return "Обновление параметров пользователя - успешно.";
        } else {
           return "Обновление параметров пользователя - ошибка.";   // ПЕРЕДЕЛАТЬ ---- НЕПРАВИЛЬНЫЙ ОБРАБОТЧИК ПУСТОГО ПОЛЯ
        }
    }catch(PDOException $e){        //  <<<<<<======================================== ERROR ERROR ERROR =======================
        return "Error:" . iconv("windows-1251", "UTF-8",$e->getMessage());
    } 
}

function deleteUserFromTable($dbh,$table,$id,$photo_id = NULL){
    //$id_id = (int) $id;
    $arra = [(int)$id];
    try{
        $stmt = $dbh->prepare("DELETE FROM ".$table." WHERE id=?");
        //$stmt->bindParam("tbl",$table,":id",$id_id);
        $stmt->execute($arra);
        $no=$stmt->rowCount();
        if($no > 0)
            return "Пользователь успешно удален.";
            if($photo_id != 1){
                unlink(USER_PHOTO_PATH ."/". $photo_id .".jpg");
            }
        if($no <= 0)
            return "Пользователь не удален.";
    }catch(PDOException $e){
        return "Error:" . iconv("windows-1251", "UTF-8",$e->getMessage());
    }
}
function addUserInTable($dbh,$table,$id){
    $arra = [(integer)$id];
    try{
        $stmt = $dbh->prepare("INSERT INTO ".$table." VALUES (NULL,?)");
        //$stmt->bindParam("tbl",$table,":id",(ineger)$id_id);
        $stmt->execute($arra);
        $no=$stmt->rowCount();
        if($no > 0)
            return "Пользователь успешно добавлен.";
        if($no <= 0)
            return "Пользователь не добавлен.";
    }catch(PDOException $e){
        return "Error:" . iconv("windows-1251", "UTF-8",$e->getMessage());
    }
}

function drawUsersTable($sql_data,$delete_field = NULL){
    if(!isset($_GET['page']))
        $_GET['page'] = 1;
    $outline = "";
    $sql_data->setFetchMode(PDO::FETCH_NUM);
    $id = 0;
    while($row = $sql_data->fetch())
    {
        $outline .= "<tr>";
        $id = $row[0];
        for($i=0;$i < count($row);$i++){
        /* foreach ($row as $val) { */
            if(is_null($delete_field)){
                if($i == (count($row) - 1)){ //ЕСЛИ последняя ячейка - отрисовываем картинку, если нет, просто ссылку со значением
                    if($row[$i]) $img = "trafficlight-green_40427.png";
                    if(!$row[$i]) $img = "trafficlight-red_40428.png";
                    $outline .= "<td><img src='../pictures/".$img."' width='16' height='16'/></td>";
                }else{
                    $outline .= "<td><a href='" . $_SERVER['PHP_SELF']."?action=changeUser&id=".$id."'>$row[$i]</a></td>";
                }
                
            }
            //Если есть последнее поле(доб. или удалит.) - убираем ссылки на редактирование пользователя (ПОДРАЗДЕЛЕНИЕ ИСПОЛНИТЕЛЯ)
            if(!is_null($delete_field))
                $outline .= "<td>$row[$i]</td>"; 
            
        }
        // ОБРАБОТКА, Если есть наличие поля ДОБАВИТЬ и УДАЛИТЬ
        if(!is_null($delete_field)) 
                if($delete_field == "delete")
                        $outline .= "<td><a href='" . $_SERVER['PHP_SELF']."?action=service_department_manage&manage=delete&id=".$id."&page={$_GET['page']}'>Удалить</a></td>";
        if(!is_null($delete_field)) 
                if($delete_field == "add")
                        $outline .= "<td><a href='" . $_SERVER['PHP_SELF']."?action=service_department_manage&manage=add&id=".$id."&page={$_GET['page']}'>Добавить</a></td>";
                
        
        $outline .= "</tr>";
    }
    return $outline;
}

function userExist ($username, $table, $field){
    global $dbh;
    $sql = "SELECT * FROM ".$table." WHERE ".$field."='".$username."'";
    $result = getDataFromTable($dbh, $sql);
    if( $result->rowCount() > 0 ) 
        return TRUE;

    return FALSE;
}
/*
##################### HASH ##########################
*/
function getUniqId(){
    return uniqid('',true);
}

function getHashPassword($string){
    $hash = md5($string);
    //$out = $hash;
    $h1 = $hash[0];
    $h2 = $hash[1];
    $hash[0] = $h2;
    $hash[1] = $h1;
    //$out .= " :: " . $hash;
    return $hash;
}
/*
##################### USERS MANAGEMENT ##########################
*/
function uploadUserPhoto(){
    //print_r($_FILES);
    if($_FILES['user_photo']['size'] > 0)
        {
            $uniqid = getUniqId();
            $file = $_FILES;
            $uploadfile = USER_PHOTO_PATH . $uniqid . ".jpg";//basename($file['user_photo']['name']);
            if (move_uploaded_file($file['user_photo']['tmp_name'], $uploadfile)) {
                return $uniqid; 
                } else {
                    return  "false";
                }
        }else{
        return false;
        }
    
    
}