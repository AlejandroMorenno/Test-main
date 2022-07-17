<?
	require_once 'db.php'; //$link

	$id_apartment = $_POST["id_apartment"];

	$cost = $_POST["cost"];
	$number_of_rooms = $_POST["number_of_rooms"];
	$residential_object = $_POST["residential_object"];
	$term = $_POST["term"];
	$square = $_POST["square"];
	$bathrom = $_POST["bathrom"];
	$heating = $_POST["heating"];
	$status = $_POST["status"];
	$contact_number = $_POST["contact_number"];

	$id_location = $_POST["id_location"];

	$city = $_POST["city"];
	$street = $_POST["street"];
	$house_number = $_POST["house_number"];

	$id_user = $_POST["id_user"];
	// $imagass = $_POST["image"];

	//ИЗОБРАЖЕНИЕ
	// $path = "image/" . $_FILES["image"]["name"];
	$path = "image/" . time() . $_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"], '../' . $path);

	$image = $path;

	mysqli_query($link, "UPDATE `location` SET `city` = '$city', `street` = '$street', `house_number` = '$house_number' WHERE `location`.`id` = $id_location");

	$rest = substr($image, -1);
	if ($rest === '1' || $rest === '2' || $rest === '3' || $rest === '4' || $rest === '5' || $rest === '6' || $rest === '7' || $rest === '8' || $rest === '9' || $rest === '0') {
		mysqli_query($link, "UPDATE `apartment` SET `cost` = '$cost', `number_of_rooms` = '$number_of_rooms', `residential_object` = '$residential_object', `term` = '$term', `square` = '$square', `bathrom` = '$bathrom', `heating` = '$heating', `status` = '$status', `contact_number` = '$contact_number' WHERE `apartment`.`id` = $id_apartment");
	} else {
		mysqli_query($link, "UPDATE `apartment` SET `cost` = '$cost', `number_of_rooms` = '$number_of_rooms', `residential_object` = '$residential_object', `term` = '$term', `square` = '$square', `bathrom` = '$bathrom', `heating` = '$heating', `status` = '$status', `contact_number` = '$contact_number', `image` = '$image' WHERE `apartment`.`id` = $id_apartment");
	}

	mysqli_query($link, "UPDATE `rent` SET `id_user` = '$id_user'  WHERE `rent`.`id_apartment` = $id_apartment");

	header('Location: ../apartments.php');
?>