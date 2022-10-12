<?php
session_start();
require "functions.php";

$user_id = $_POST['id'];
$username = $_POST['username'];
$job_title = $_POST['pjob'];
$phone = $_POST['tel'];
$address = $_POST['address'];


edit_info($user_id, $username, $job_title, $phone, $address);

set_flash_message("success", "Профиль обновлен.");

redirect_to("page_profile.php?id=$user_id");






?>