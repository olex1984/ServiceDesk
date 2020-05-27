<?php
$out_service_department = "";
//================================= ДОБАВЛЕНИЕ
if((isset($_GET['manage']) and ($_GET['manage'] == "add"))){
    if(!isset($_GET['page']))
        $_GET['page'] = 1;
    $out_service_department .= "<p class='message_info'>";
    $out_service_department .= addUserInTable($dbh,"service_department",$_GET['id']);
    header( "refresh:2;url=user_management.php?action=service_department_manage&page={$_GET['page']}" );
    $out_service_department .= "</p>";
}
//================================= Удаление
if((isset($_GET['manage']) and ($_GET['manage'] == "delete"))){
    if(!isset($_GET['page']))
        $_GET['page'] = 1;
    $out_service_department .= "<p class='message_info'>";
    $out_service_department .= deleteUserFromTable($dbh,"service_department",$_GET['id']);
    header( "refresh:2;url=user_management.php?action=service_department_manage&page={$_GET['page']}" );
    $out_service_department .= "</p>";
}

//======================================Состав сервисного подразделения:
$out_service_department .= "<p><h3>Состав сервисного подразделения:</h3></p>";
$sql = "SELECT service_department.id,name,description FROM users, service_department WHERE users.id = service_department.user_id ORDER BY name ASC";
$raw_data = getDataFromTable($dbh, $sql);
$out_service_department .= " <table class='service_department' ><tr>
            <th>SID</th><th>ФИО</th><th>Описание</th><th>Действие</th>
        </tr>";
$out_service_department .= drawUsersTable($raw_data,"delete");
$out_service_department .= "</table>";
//================================================================
$out_service_department .= "<p class='service_uparrow'></p>";
//===========================================Добавить сотрудника:
$page = 1;
    if(isset($_GET['page']))
      $page = (integer)$_GET['page'];
    $stmt = getDataFromTable($dbh,"SELECT COUNT(*) AS num FROM users");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_count = $row['num'];//======================КОЛИЧЕСТВО ПОЛЬЗОВАТЕЛЕЙ в ТАБЛИЦЕ ==========================
    $count_pages = ceil($user_count / USERS_ON_PAGE);
    $offset = (integer)($page - 1);
    $offset = $offset * USERS_ON_PAGE;
    $raw_data = getDataFromTable($dbh,"SELECT id,name,description FROM users ORDER BY name LIMIT {$offset},".USERS_ON_PAGE);
    $out_service_department .= "<p style='text-align:right; padding-right:5px;'>Всего: ".$user_count."</p>";
$out_service_department .= "<p><h3>Добавить сотрудника в сервисное подразделение:</h3></p>";
/* $sql = "SELECT id,name,description FROM users ORDER BY name ASC";
$raw_data = getDataFromTable($dbh, $sql); */
$out_service_department .= " <table class='service_department'><tr>
            <th>ID</th><th>ФИО</th><th>Описание</th><th>Действие</th>
        </tr>";
$out_service_department .= drawUsersTable($raw_data,"add");
$out_service_department .= "</table>";

$out_service_department .= "<p style='text-align:center;'>";
        for($i=1; $i <= $count_pages; $i++){
        if($i == $page)
        $out_service_department .= "<a class='page_number_active' href='{$_SERVER['PHP_SELF']}?action=service_department_manage&page={$i}'>$i</a>";
        if($i != $page)
        $out_service_department .= "<a class='page_number' href='{$_SERVER['PHP_SELF']}?action=service_department_manage&page={$i}'>$i</a>";
        
            $out_service_department .= " ";
        }
        $out_service_department .= "</p>";