<?php
session_start();
require "functions.php";

$username = $_POST['username'];
$job_title = $_POST['pjob'];
$phone = $_POST['tel'];
$address = $_POST['address'];
$email = $_POST['email'];
$password = $_POST['password'];
$status = $_POST['status'];
$image = $_FILES['image'];
$vk = $_POST['vk'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];

if (isset($_POST)) {
	$user = get_user_by_email($email);
}

if (!empty($user)) {
	set_flash_message("danger", "Такой email уже используется.");
	redirect_to("/project2/create_user.php");
}

if(empty($user)) {
	$user_id = add_user($email, $password);

	edit_profile($username, $job_title, $phone, $address, $user_id);

	set_status($status, $user_id);

	upload_avatar($image, $user_id);

	add_social_links($telegram, $instagram, $vk, $user_id);

	set_flash_message("success", "Пользователь добавлен.");
}

redirect_to("/project2/users.php");













?>