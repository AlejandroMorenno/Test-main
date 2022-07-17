<?
	require_once 'db.php'; //$link

	$login = $_POST["login"];
	// $password = $_POST["password"];
	$password = md5($_POST["password"]);

	$sql="SELECT * FROM `user` WHERE `login` = '".$login."' AND `password`='".$password."'";
	$result=mysqli_query($link,$sql);


	header('Location: ../sign.php');

	while ($var = mysqli_fetch_assoc($result))
	{
		if ($var["login"]==$login AND $var["password"]==$password){
			session_start();
			$_SESSION["login"] = $login;
			$_SESSION["password"] = $password;
			$_SESSION["role"] = $var["role"];

			header('Location: ../page_add.php');
		}
		if ($var["role"]=="Admin") {
			header('Location: ../users.php');
		}
	}