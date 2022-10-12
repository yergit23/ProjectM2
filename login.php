<?php
session_start();
require "functions.php";

$email = $_POST['email'];
$password = $_POST['password'];

$user = auth_user_by_email($email);
$role = is_role_admin($email);

if (empty($user)) {
	set_flash_message("danger", "Вы ввели неверный логин.");
	redirect_to("/project2/page_login.php");
}

if (!password_verify($password, $user['password'])) {
	set_flash_message("danger", "Вы ввели неверный пароль.");
	redirect_to("/project2/page_login.php");
}

if (!empty($user)) {
	$_SESSION['log_in'] = $user['email'];
	$_SESSION['log_in_id'] = $user['id'];
}

if (!empty($role)) {
	$_SESSION['admin'] = $role['email'];
}

redirect_to("/project2/users.php");





?>