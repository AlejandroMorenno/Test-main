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
$status = $_POST["status"];
$cost = $_POST["cost"];
$contact_number = $_POST["contact_number"];
// $image = $_POST["image"];
// $id_location = $_POST["id_location"];
$city = $_POST["city"];
$street = $_POST["street"];
$house_number = $_POST["house_number"];

$id_user = $_POST["id_user"];

$path = "image/" . time() . $_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"], '../' . $path);

$image = $path;

	//СОЗДАЁМ ЛОКАЦИЮ
mysqli_query($link, "INSERT INTO `location` (`id`, `city`, `street`, `house_number`) VALUES (NULL, '$city', '$street', '$house_number')");
	//ИЩЕМ ID ТОЛЬКО ЧТО СОЗДАННОЙ ЛОКАЦИИ
$id_location = mysqli_query($link,"SELECT `id` FROM `location` WHERE `city` = '$city' AND `street` = '$street' AND `house_number` = '$house_number'");
while ($var = mysqli_fetch_assoc($id_location)) {
	$id_location_r = $var["id"];
}
	//СОЗДАЁМ ОБЪЕКТ
mysqli_query($link, "INSERT INTO `apartment` (`id`, `number_of_rooms`, `square`, `residential_object`, `bathrom`, `heating`, `term`, `cost`, `status`, `contact_number`, `image`, `id_location`) VALUES (NULL, '$number_of_rooms', '$square', '$residential_object', '$bathrom', '$heating', '$term', '$cost', '$status', '$contact_number', '$image', '$id_location_r')");
	//ИЩЕМ ID СОЗДАННОГО ОБЪЕКТА
$id_apartment = mysqli_query($link,"SELECT `id` FROM `apartment` WHERE `cost` = '$cost' AND `number_of_rooms` = '$number_of_rooms' AND `residential_object` = '$residential_object' AND `term` = '$term' AND `square` = '$square' AND `bathrom` = '$bathrom' AND `heating` = '$heating' AND `contact_number` = '$contact_number' AND `id_location` = '$id_location_r'");
while ($var2 = mysqli_fetch_assoc($id_apartment)) {
	$id_apartment_r = $var2["id"];
}

mysqli_query($link, "INSERT INTO `rent` (`id`, `id_apartment`, `id_user`) VALUES (NULL, '$id_apartment_r', '$id_user')");

// header('location: ../apartments.php');