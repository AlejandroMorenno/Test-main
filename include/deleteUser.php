<?
	require_once 'db.php'; //$link

	$id = $_GET["id"];

	$rent = mysqli_query($link,"SELECT * FROM `rent` WHERE `id_user` = '$id'");
	mysqli_query($link, "DELETE FROM `user` WHERE `user`.`id` = $id");
	while ($var = mysqli_fetch_assoc($rent)) {
		$id_rent_to_delete = $var["id"];
		$id_apartment = $var["id_apartment"];
		$apartment = mysqli_query($link,"SELECT * FROM `apartment` WHERE `id` = '$id_apartment'");
		while ($var2 = mysqli_fetch_assoc($apartment)) {
			$id_apartment_to_delete = $var2["id"];
			$id_location = $var2["id_location"];
		}
		$location = mysqli_query($link,"SELECT * FROM `location` WHERE `id` = '$id_location'");
		while ($var3 = mysqli_fetch_assoc($location)) {
			$id_location_to_delete = $var3["id"];
		}
		mysqli_query($link, "DELETE FROM `rent` WHERE `rent`.`id` = $id_rent_to_delete");
		mysqli_query($link, "DELETE FROM `user` WHERE `user`.`id` = $id");
		mysqli_query($link, "DELETE FROM `apartment` WHERE `apartment`.`id` = $id_apartment_to_delete");
		mysqli_query($link, "DELETE FROM `location` WHERE `location`.`id` = $id_location_to_delete");
	} 



	header('Location: ../users.php');