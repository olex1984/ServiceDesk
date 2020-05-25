<?php
$out_service_department = "";
//================================= ДОБАВЛЕНИЕ
if((isset($_GET['manage']) and ($_GET['manage'] == "add"))){
    //echo "ADD";
    $out_service_department .= addUserInTable($dbh,"service_department",$_GET['id']);
    
}
//================================= Удаление
if((isset($_GET['manage']) and ($_GET['manage'] == "delete"))){
    //echo "DELETE";
    $out_service_department .= deleteUserFromTable($dbh,"service_department",$_GET['id']);
}

//======================================Состав сервисного подразделения:
$out_service_department .= "<p>Состав сервисного подразделения:</p>";
$sql = "SELECT service_department.id,name,description FROM users, service_department WHERE users.id = service_department.user_id ORDER BY name ASC";
$raw_data = getDataFromTable($dbh, $sql);
$out_service_department .= " <table class='service_department' ><tr>
            <th>SID</th><th>ФИО</th><th>Описание</th><th>Действие</th>
        </tr>";
$out_service_department .= drawUsersTable($raw_data,"delete");
$out_service_department .= "</table>";
//===========================================Добавить сотрудника:
$out_service_department .= "<p>Добавить сотрудника:</p>";
$sql = "SELECT id,name,description FROM users ORDER BY name ASC";
$raw_data = getDataFromTable($dbh, $sql);
$out_service_department .= " <table class='service_department'><tr>
            <th>ID</th><th>ФИО</th><th>Описание</th><th>Действие</th>
        </tr>";
$out_service_department .= drawUsersTable($raw_data,"add");
$out_service_department .= "</table>";
