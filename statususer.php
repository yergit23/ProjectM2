<?php
session_start();
require "functions.php";

$user_id = $_POST['user_id'];
$status = $_POST['status'];

if(empty($user_id)) {
	set_flash_message("danger", "Вы не выбрали пользователя.");

	redirect_to("users.php");
}

if(!empty($user_id) && !empty($status)) {
	set_status($status, $user_id);

	set_flash_message("success", "Вы обновили статус профиля");

	redirect_to("page_profile.php?id=$user_id");
}


?>