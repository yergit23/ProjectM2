<?php
session_start();
require "functions.php";

$user_id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];

$check_email = check_update_user_email($user_id, $email, $password);

if (!empty($check_email)) {
	set_flash_message("danger", "Введенный email уже существует!");
	redirect_to("security.php?id=$user_id");
}

if (empty($password)) {
	set_flash_message("danger", "Вы не ввели новый пароль");
	redirect_to("security.php?id=$user_id");
}

edit_credentials($user_id, $email, $password);

set_flash_message("success", "Вы обновили данные профиля.");

redirect_to("page_profile.php?id=$user_id");

?>