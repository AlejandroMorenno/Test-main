<?php
require_once 'db.php';//link

$login = $_POST["login"];
$password = md5($_POST["password"]);
$role = $_POST["role"];

// if(empty($id_optional_services))
// $id_optional_services='NULL'; else
// $id_optional_services='"'.$id_optional_services.'"';

mysqli_query($link, "INSERT INTO `user` (`id`, `login`, `password`, `role`) VALUES (NULL, '$login', '$password', '$role')");

header('location: ../users.php');