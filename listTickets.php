<?php

try {
    $page_num = 1;
    $outline = "";
    if(isset($_GET['page_num']))
        $page_num = (integer)$_GET['page'];
    $stmt = getDataFromTable($dbh,"SELECT COUNT(*) AS num FROM tickets");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $tickets_count = $row['num'];//======================КОЛИЧЕСТВО ОБРАЩЕНИЙ/КАРТОЧЕК в ТАБЛИЦЕ ==========================
    $count_pages = ceil($tickets_count / USERS_ON_PAGE);
    $offset = (integer)($page_num - 1);
    $offset = $offset * USERS_ON_PAGE;
    $raw_data = getDataFromTable($dbh,"SELECT id,time,owner,control,subject,description,status,uid FROM tickets ORDER BY id DESC LIMIT {$offset},".USERS_ON_PAGE);
    $data = $raw_data->fetch(PDO::FETCH_ASSOC);
    $outline .= "<p style='text-align:right; padding-right:5px;'>Всего: ".$tickets_count."</p>";
    $outline .= " <table><tr>
            <th>ID</th><th>Дата</th><th>От кого</th><th>На контроле</th><th>Тема</th><th>Описание</th><th>Статус</th><th>UID</th>
        </tr>";
    //$outline .= drawUsersTable($raw_data);
    $outline .= "</table>";


     //=================================== ВЫВОД СТРАНИЦ с пользователями =============================
     if($count_pages >= 0){ //change > 1
        $outline .= "<p style='text-align:center;'>";
        for($i=0; $i <= $count_pages; $i++){ // change $=1
          if($i == $page_num)
            $outline .= "<a class='page_number_active' href='{$_SERVER['PHP_SELF']}?page={$i}'>$i</a>";
          if($i != $page_num)
            $outline .= "<a class='page_number' href='{$_SERVER['PHP_SELF']}?page={$i}'>$i</a>";
          
            $outline .= " ";
        }
        $outline .= "</p>";
      }

    } 
    catch (PDOException $e) 
    {   //  <<<<<<======================================== ERROR ERROR ERROR =======================
        $error = "Error:".iconv("windows-1251", "UTF-8",$e->getMessage());
        echo $error;
        return $error;
    }

    $content = $outline;