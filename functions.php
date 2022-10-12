<?php
session_start();

// users

function show_all_users () {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
    $sql = "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}

// registration

function get_user_by_email($email) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "SELECT * FROM users WHERE email=:email";
	$statement = $pdo->prepare($sql);
	$statement->execute(["email" => $email]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);

	return $user;
}

function set_flash_message($name, $message) {
	$_SESSION[$name] = $message;
}

function redirect_to($path) {
	header("location: {$path}");
	exit;
}

/**
 	Parametrs:
 		$email string
 		$password string

 	Description: добавить пользователя

 	Return value: int (user_id)
**/
function add_user($email, $password) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$statement = $pdo->prepare($sql);
	$statement->execute([
		"email" => $email,
		"password" => password_hash($password, PASSWORD_DEFAULT)
	]);

	return $pdo->lastInsertId();
}

function display_flash_message($name) {
	if (isset($_SESSION[$name])) {
		echo "<div class='alert alert-{$name} text-dark' role='alert'>{$_SESSION[$name]}</div>";
		unset($_SESSION[$name]);
	}
}

// authorization

function auth_user_by_email($email) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "SELECT * FROM users WHERE email =:emailu";
	$statement = $pdo->prepare($sql);
	$statement->execute(['emailu' => $email]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);

	return $user;
}

function is_not_logged_in() {
	if (!isset($_SESSION['log_in'])) {
		return true;
	} else {
		return false;
	}
}

function is_logged_in() {
	if (isset($_SESSION['log_in'])) {
		return true;
	} else {
		return false;
	}
}

function is_not_admin() {
	if (!isset($_SESSION['admin'])) {
		return true;
	} else {
		return false;
	}
}

function is_role_admin($email) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "SELECT * FROM users WHERE email =:uemail AND role=1";
	$statement = $pdo->prepare($sql);
	$statement->execute(["uemail" => $email]);
	$role = $statement->fetch(PDO::FETCH_ASSOC);

	return $role;
}

// create user

/**
 	Parametrs:
 		$username string
 		$job_title string
 		$phone string
 		$address string
 		$user_id int

 	Description: редактировать профиль

 	Return value: boolean
**/
function edit_profile($username, $job_title, $phone, $address, $user_id) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "UPDATE users SET name =:username, position=:job_title, tel =:phone, address =:address WHERE id =:user_id";
	$statement = $pdo->prepare($sql);
	$statement->execute([
		"username" => $username,
		"job_title" => $job_title,
		"phone" => $phone,
		"address" => $address,
		"user_id" => $user_id
	]);
}

/**
 	Parametrs:
 		$user_id int
 		$status string

 	Description: Установить статус

 	Return value: null | boolean
**/
function set_status($status, $user_id) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "SELECT * FROM status WHERE id =:sid";
	$statement = $pdo->prepare($sql);
	$statement->execute(["sid" => $status]);
	$statuseng = $statement->fetch(PDO::FETCH_ASSOC);
	$s_eng = $statuseng['engname'];

	$sql = "UPDATE users SET statusnew =:status, status =:s_eng WHERE id =:user_id";
	$statement = $pdo->prepare($sql);
	$statement->execute([
		"status" => $status,
		"s_eng" => $s_eng,
		"user_id" => $user_id
	]);
}

function show_all_status() {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "SELECT * FROM status";
	$statement = $pdo->prepare($sql);
	$statement->execute();
	$status = $statement->fetchAll(PDO::FETCH_ASSOC);

	return $status;
}

/**
 	Parametrs:
 		$user_id int
 		$image array

 	Description: загрузить аватар

 	Return value: null | boolean
**/
function upload_avatar($image, $user_id) {

	if ($image["error"]== UPLOAD_ERR_OK) {
		$uploaddir = 'img/demo/avatars/';

		$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");

		$sql = "SELECT * FROM users WHERE id =:uid";
		$statement = $pdo->prepare($sql);
		$statement->execute(["uid" => $user_id]);
		$user = $statement->fetch(PDO::FETCH_ASSOC);

		if (!empty($user['img'])) {
			unlink($user['img']);
		}

		$tmp_name = $image['tmp_name'];
		$name = basename($image['name']);
		$extension = pathinfo($name, PATHINFO_EXTENSION);
		$new_name = uniqid().'.'.$extension;
		$uploadfiles = $uploaddir . $new_name;
		move_uploaded_file($tmp_name, $uploadfiles);
		$sql = "UPDATE users SET img =:image WHERE id =:user_id";
		$statement = $pdo->prepare($sql);
		$statement->execute([
			"image" => $uploadfiles,
			"user_id" => $user_id
		]);
	}
}

/**
 	Parametrs:
 		$user_id int
 		$image string

 	Description: проверяет имеется ли аватар у пользователя

 	Return value: null | boolean
**/
function has_image($user_id, $image) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "SELECT * FROM users WHERE id =:uid";
	$statement = $pdo->prepare($sql);
	$statement->execute(["uid" => $user_id]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);

	if (empty($user['img'])) {
		return true;
	} else {
		return false;
	}
}

/**
 	Parametrs:
 		$telegram string
 		$instagram string
 		$vk string

 	Description: добавить ссылки на соц. сети

 	Return value: null
**/
function add_social_links($telegram, $instagram, $vk, $user_id) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "UPDATE users SET insta =:insta, telega =:telega, vk =:vk WHERE id =:user_id";
	$statement = $pdo->prepare($sql);
	$statement->execute([
		"insta" => $instagram,
		"telega" => $telegram,
		"vk" => $vk,
		"user_id" =>$user_id
	]);
}

// edit user

/**
 	Parametrs:
 		$logged_user_id int
 		$edit_user_id int

 	Description: Проверить, автор ли текущий авторизованный пользователь

 	Return value: boolean
**/
function is_author($logged_user_id, $edit_user_id) {
	if ($logged_user_id == $edit_user_id) {
    	return true;
    } else {
    	return false;
    }
}

/**
 	Parametrs:
 		$user_id int

 	Description: Получить пользователя по id

 	Return value: array
**/
function get_user_by_id($id) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "SELECT * FROM users WHERE id =:uid";
	$statement = $pdo->prepare($sql);
	$statement->execute(["uid" => $id]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);

	return $user;
}

/**
 	Parametrs:
 		$user_id int
 		$username string
 		$job_title string
 		$phone string
 		$address string

 	Description: Редактировать общую информацию

 	Return value: null
**/
function edit_info($user_id, $username, $job_title, $phone, $address) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "UPDATE users SET name =:uname, position =:jtitle, tel =:phone, address =:address WHERE id =:user_id";
	$statement = $pdo->prepare($sql);
	$statement->execute([
		"uname" => $username,
		"jtitle" => $job_title,
		"phone" => $phone,
		"address" =>$address,
		"user_id" =>$user_id
	]);
}

// security

/**
 	Parametrs:
 		$user_id int
 		$email string
 		$password string

 	Description: Редактировать общую информацию

 	Return value: null | boolean
**/
function edit_credentials($user_id, $email, $password) {
	if (!empty($email)) {
		$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
		$sql = "UPDATE users SET email =:emailu WHERE id =:uid";
		$statement = $pdo->prepare($sql);
		$statement->execute([
		"emailu" => $email,
		"uid" => $user_id
		]);
	}

	if (!empty($password)) {
		$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
		$sql = "UPDATE users SET password =:hpass WHERE id =:uid";
		$statement = $pdo->prepare($sql);
		$statement->execute([
		"hpass" => password_hash($password, PASSWORD_DEFAULT),
		"uid" => $user_id
		]);
	}

}

function check_update_user_email ($user_id, $email, $password) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "SELECT * FROM users WHERE email =:emailu AND id !=:uid";
	$statement = $pdo->prepare($sql);
	$statement->execute([
		"emailu" => $email,
		"uid" => $user_id
	]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);

	return $user;
}

// delete users

/**
 	Parametrs:
 		$user_id int

 	Description: Удалить пользователя

 	Return value: null | boolean
**/
function delete_user($user_id) {
	$pdo = new PDO("mysql:host=localhost;dbname=project2","root","root");
	$sql = "SELECT * FROM users WHERE id =:uid";
	$statement = $pdo->prepare($sql);
	$statement->execute(["uid" => $user_id]);
	$user = $statement->fetch(PDO::FETCH_ASSOC);

	if(!empty($user['img'])) {
		unlink($user['img']);
	}

	$sql = "DELETE FROM users WHERE id =:uid";
	$statement = $pdo->prepare($sql);
	$statement->execute(["uid" => $user_id]);
}

function logout_user() {
	if (isset($_SESSION['admin'])) {
	unset($_SESSION['admin']);
	}

	unset($_SESSION['log_in_id']);
	unset($_SESSION['log_in']);
}





?>