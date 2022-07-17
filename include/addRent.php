<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	require_once 'db.php';//$link
	$link->set_charset("utf8");

	$number_of_rooms = $_POST["number_of_rooms"];
	$square = $_POST["square"];
	$residential_object = $_POST["residential_object"];
	$bathrom = $_POST["bathrom"];
	$heating = $_POST["heating"];
	$term = $_POST["term"];
	$cost = $_POST["cost"];
	$contact_number = $_POST["contact_number"];

	$city = $_POST["city"];
	$street = $_POST["street"];
	$house_number = $_POST["house_number"];

	//ИЗОБРАЖЕНИЕ
	$path = "image/" . time() . $_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"], '../' . $path);
	
	$image = $path;

	session_start();

	$login = $_SESSION['login'];
	$password = $_SESSION['password'];


	//СОЗДАЁМ ЛОКАЦИЮ
	mysqli_query($link, "INSERT INTO `location` (`id`, `city`, `street`, `house_number`) VALUES (NULL, '$city', '$street', '$house_number')");
	//ИЩЕМ ID ТОЛЬКО ЧТО СОЗДАННОЙ ЛОКАЦИИ
	$id_location = mysqli_query($link,"SELECT `id` FROM `location` WHERE `city` = '$city' AND `street` = '$street' AND `house_number` = '$house_number'");
	while ($var = mysqli_fetch_assoc($id_location)) {
		$id_location_r = $var["id"];
	}
	// echo '<p>ID локации:</p>';
	// echo $id_location_r;
	//ИЩЕМ ID СОЗДАННОГО ЮЗЕРА
	$id_user = mysqli_query($link,"SELECT `id` FROM `user` WHERE `login` = '$login' AND `password` = '$password'");
	while ($var2 = mysqli_fetch_assoc($id_user)) {
		$id_user_r = $var2["id"];
	}
	// echo '<p>ID юзера:</p>';
	// echo $id_user_r;
	//СОЗДАЁМ КОМНАТУ
	mysqli_query($link, "INSERT INTO `apartment` (`id`, `cost`, `number_of_rooms`, `residential_object`, `term`, `square`, `bathrom`, `heating`, `status`, `contact_number`, `image`, `id_location`) VALUES (NULL, '$cost', '$number_of_rooms', '$residential_object', '$term', '$square', '$bathrom', '$heating', 'Свободно', '$contact_number', '$image', '$id_location_r')");
	//ИЩЕМ ID ТОЛЬКО ЧТО СОЗДАННОЙ КОМНАТЫ
	$id_apartmient = mysqli_query($link,"SELECT `id` FROM `apartment` WHERE `cost` = '$cost' AND `number_of_rooms` = '$number_of_rooms' AND `residential_object` = '$residential_object' AND `term` = '$term' AND `square` = '$square' AND `bathrom` = '$bathrom' AND `heating` = '$heating' AND `contact_number` = '$contact_number' AND `id_location` = '$id_location_r'");
	while ($var3 = mysqli_fetch_assoc($id_apartmient)) {
		$id_apartmient_r = $var3["id"];
	}
	echo '<p>ID комнаты:</p>';
	echo $id_apartmient_r;
	//СОЗДАЁМ РЕНТУ
	mysqli_query($link, "INSERT INTO `rent` (`id`, `id_apartment`, `id_user`) VALUES (NULL, '$id_apartmient_r', '$id_user_r')");

	header('location: ../page_add.php');