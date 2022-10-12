<?php
session_start();
require "functions.php";

$user_id = $_POST['user_id'];
$image = $_FILES['file'];

if(empty($user_id)) {
	set_flash_message("danger", "Вы не выбрали пользователя.");

	redirect_to("users.php");
}

if(empty($image['name'])) {
	set_flash_message("danger", "Вы не выбрали аватар.");

	redirect_to("media.php?id=$user_id");
}

upload_avatar($image, $user_id);

set_flash_message("success", "Вы обновили аватар");

redirect_to("page_profile.php?id=$user_id");




?>