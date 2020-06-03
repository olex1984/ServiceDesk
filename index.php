<?php
require_once "inc/config.php";// SESSION CHECK is there
$form_header = "<h1>Service Desk</h1>";
$header_text = $form_header;
$content = "";
$footer = "";
$page = "listTickets.php";

if(isset($_GET['action'])){
  if($_GET['action'] == "add_ticket") {
    $page = "add_ticket.php";
    $form_header = "<h1> Новое обращение:</h1>";
    
  }elseif($_GET['action'] == "changeUser") {
    require_once "add_user.php";
    $form_header = "<h1> Изменение учетной записи пользователя:</h1>";
    $outline = $change_user_outline;
  }elseif($_GET['action'] == "service_department_manage") {
    require_once "service_department.php";
    $form_header = "<h1> Управление сервисным подразделением</h1>";
    $outline = $out_service_department;
  }
}

require_once $page;
//<!-- =============================== HTML HTML HTML ============================ -->
// =========================== HEADER - BODY - FOOTER =======================================
require_once "body.php";
//print_r($GLOBALS);