<?
	require_once 'db.php'; //$link

	$login = $_POST["login"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];

	if ($password == $password2) {
		$password = md5($_POST["password"]);
		mysqli_query($link, "INSERT INTO `user` (`id`, `login`, `password`, `role`) VALUES (NULL, '$login', '$password', 'Client')");

		session_start();
		$_SESSION["login"] = $login;
		$_SESSION["password"] = $password;

		header('location: ../page_add.php');
	} else {
		header('location: ../registration.php');
	}


