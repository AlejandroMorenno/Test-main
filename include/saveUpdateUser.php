<?
	require_once 'db.php'; //$link

	$id = $_POST["id"];
	$login = $_POST["login"];
	$role = $_POST["role"];
	$password = $_POST["password"];
	// $passwordNew = $_POST["passwordNew"];

	if (empty($_POST["passwordNew"])) {
		mysqli_query($link, "UPDATE `user` SET `login` = '$login', `role` = '$role' WHERE `user`.`id` = $id");
	} else {
		$passwordNew = md5($_POST["passwordNew"]);
		mysqli_query($link, "UPDATE `user` SET `login` = '$login', `role` = '$role', `password` = '$passwordNew' WHERE `user`.`id` = $id");
	}

	header('Location: ../users.php');

	session_start();

	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	$role = $_SESSION['role'];

	if ($login == "" || $password == "" || $role !== "Admin"){
		header('Location: index.php');
	}
?>