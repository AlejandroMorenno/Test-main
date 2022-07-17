<?php
$link = mysqli_connect('localhost','root','root','sereda',);

if(mysqli_connect_errno())
{
	echo 'Ошибка в подключении к бд ('.mysqli_connect_errno().'): '.mysqli_connect_error();
	exit();
}
?>
