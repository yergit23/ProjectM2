<?php
session_start();
require "functions.php";

$id = $_GET['id'];

if(is_not_logged_in()) {
    set_flash_message("danger", "Войдите в систему");
    redirect_to("page_login.php");
}

if (!isset($id)) {
    set_flash_message("danger", "Вы не выбрали пользователя");
    redirect_to("users.php");
}

if (is_author($_SESSION['log_in_id'], $id)) {
    delete_user($id);
    set_flash_message("success", "Вы удалили свой профиль пользователя, для входа нужна регистрация.");
    logout_user();
    redirect_to("page_register.php");
} elseif (isset($_SESSION['admin'])) {
    delete_user($id);
    set_flash_message("success", "Вы удалили профиль пользователя");
    redirect_to("users.php");
} else {
    set_flash_message("danger", "Вы удаляете не свой профиль или у Вас нет прав администратора.");
    redirect_to("users.php");
}




?>