<?
	require_once 'db.php'; //$link

	$id = $_GET["id"];

	$apartment = mysqli_query($link,"SELECT * FROM `apartment` WHERE `apartment`.`id` = $id");
	while ($var = mysqli_fetch_assoc($apartment)) {
		$id_apartment_to_delete = $var["id"];
		$id_location_to_delete = $var["id_location"];
	}
	mysqli_query($link, "DELETE FROM `rent` WHERE `id_apartment` = $id_apartment_to_delete");
	mysqli_query($link, "DELETE FROM `apartment` WHERE `apartment`.`id` = $id");
	mysqli_query($link, "DELETE FROM `location` WHERE `location`.`id` = $id_location_to_delete");

	header('Location: ../apartments.php');