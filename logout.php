<?php
session_start();
require "functions.php";

if (isset($_SESSION['admin'])) {
	unset($_SESSION['admin']);
}

unset($_SESSION['log_in_id']);
unset($_SESSION['log_in']);

redirect_to("/project2/page_login.php");

?>