<?
	require_once 'include/db.php'; //$link
	$user = mysqli_query($link,"SELECT * FROM `user`");

	session_start();

	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	$role = $_SESSION['role'];

   //new session
	$session = mysqli_query($link, "SELECT * FROM `user`");
	$value = true;
	while ($varSession = mysqli_fetch_assoc($session)) {
		 if ($login == $varSession["login"] && $password == $varSession["password"] && 	$role == $varSession["role"]) {
			  $value = false;
		 }
	}
	if ($value) {
		 unset($login);
		 unset($password);
		 unset($role);
		 header('Location: index.php');
	}
	//

	if ($login == "" || $password == "" || $role !== "Admin"){
		header('Location: index.php');
	}

	$id = $_GET["id"];
	$var = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `apartment` WHERE `apartment`.`id` = $id"));
	$id_location = $var["id_location"];
	$var2 = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `location` WHERE `location`.`id` = $id_location"));
	$var3 = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `rent` WHERE `rent`.`id_apartment` = $id"));
	$id_user = $var3["id_user"];
	$var4 = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `user` WHERE `user`.`id` = $id_user"));
?>

<?
	// require_once 'include/db.php'; //$link

	// session_start();

	// $login = $_SESSION['login'];
	// $password = $_SESSION['password'];
	// $role = $_SESSION['role'];

	// if ($login == "" || $password == "" || $role !== "Admin"){
	// 	header('Location: index.php');
	// }

	// $location = mysqli_query($link,"SELECT * FROM `location`");
	// $apartment = mysqli_query($link,"SELECT * FROM `apartment`");
	// $user = mysqli_query($link,"SELECT * FROM `user`");
?>

<!DOCTYPE html>

<html lang="ru">

	<head>
		<title>AdminPanel</title><!--AdminPanel-->
		<meta charset="utf-8">
		<meta name="descriprion" content="AdminPanel">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >
		<link rel="stylesheet" href="Home_page.css">
		<!-- <link rel="stylesheet" href="css/style.css"> -->
	</head>

	<style>

	.menu1{
		padding-left: 0px;
	}
	.menu1 li{
		list-style-type: none;
		margin-bottom: 20px;
    /* убирает маркера */
	}
	.menu1 li a{
		text-decoration: none;
		color: #ffffff;
		font-size: 22px;
		cursor: pointer;
	}
	select {
            width: 183px;
            height: 38px;
            display: block;
        }
	</style>

	<body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<div>
		<div style="height: 100%; background-color:#0d6efd; position: fixed;">
		<div style="width: 250px; display: flex; flex-direction: column; align-items: center;">
			<h1 style="color:#ffffff; margin-top:100px; margin-bottom: 50px;">AdminPanel</h1>
			<ul class="menu1">
				<li>
					<a href="users.php">Пользователи</a>
				</li>
				<li style="text-decoration: underline;">
					<a href="apartments.php">Жилые помещения</a>
				</li>
			</ul>
		</div>
		</div>

	<div style="margin-left: 255px;">

		<div style="position: sticky; top: 0px; background: #ffffff; z-index: 1;">
			<div style="display: flex; justify-content: space-between; padding-right: 20px; align-items: center; margin: 0;">
				<h3 class="mb-3">Изменить жилое помещение</h3>
				<a href="include/logout.php" class="ex" style="font-size: 24px; text-decoration: none;">ВЫЙТИ</a>
			</div>

			<form action="include/saveUpdateApartment.php" method="post" class="row g-3" style="margin-bottom: 10px; padding-right: 20px;"  enctype="multipart/form-data">

			<input type="hidden" value="<?php echo $id;?>" name="id_apartment" >
			<input type="hidden" value="<?php echo $id_location;?>" name="id_location" >
			
				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Количество комнат *:</label>
					<input type="number" value="<?php echo $var["number_of_rooms"];?>" name="number_of_rooms" class="form-control" id="text" required>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Площадь м<sup>2</sup> *:</label>
					<input type="number" value="<?php echo $var["square"];?>" name="square" class="form-control" id="text" required>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Вид объекта *:</label>
					<select class="col-md-12 mh-100" name="residential_object" id="select" required>
					<?php if ($var["residential_object"] == 'Дом') {
                            echo '<option value="Квартира">Квартира</option>
                                  <option value="Дом" selected>Дом</option>';
                        } else {
                            echo '<option value="Квартира" selected>Квартира</option>
                            <option value="Дом">Дом</option>';
                        }?>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Санузел *:</label>
					<select class="col-md-12 mh-100" name="bathrom" id="select" required>
					<?php if ($var["bathrom"] == 'Имеется') {
                            echo '<option value="Имеется" selected>Имеется</option>
                                  <option value="Отсутствует">Отсутствует</option>';
                        } else {
                            echo '<option value="Имеется">Имеется</option>
                            <option value="Отсутствует" selected>Отсутствует</option>';
                        }?>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Отопление *:</label>
					<select class="col-md-12 mh-100" name="heating" id="select" required>
					<?php if ($var["heating"] == 'Имеется') {
                            echo '<option value="Имеется" selected>Имеется</option>
                                  <option value="Отсутствует">Отсутствует</option>';
                        } else {
                            echo '<option value="Имеется">Имеется</option>
                            <option value="Отсутствует" selected>Отсутствует</option>';
                        }?>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Выберите срок *:</label>
					<select class="col-md-12 mh-100" name="term" id="select" required>
					<?php if ($var["term"] == 'Месяц') {
                            echo '<option value="Месяц" selected>Месяц</option>
                            <option value="Три месяца">Три месяца</option>
                            <option value="Полгода">Полгода</option>
                            <option value="Год">Год</option>
                            <option value="Длительный">Длительный</option>';
                        } else if ($var["term"] == 'Три месяца'){
                            echo '<option value="Месяц">Месяц</option>
                            <option value="Три месяца" selected>Три месяца</option>
                            <option value="Полгода">Полгода</option>
                            <option value="Год">Год</option>
                            <option value="Длительный">Длительный</option>';
                        } else if ($var["term"] == 'Полгода'){
                            echo '<option value="Месяц">Месяц</option>
                            <option value="Три месяца">Три месяца</option>
                            <option value="Полгода" selected>Полгода</option>
                            <option value="Год">Год</option>
                            <option value="Длительный">Длительный</option>';
                        } else if ($var["term"] == 'Год'){
                            echo '<option value="Месяц">Месяц</option>
                            <option value="Три месяца">Три месяца</option>
                            <option value="Полгода">Полгода</option>
                            <option value="Год" selected>Год</option>
                            <option value="Длительный">Длительный</option>';
                        } else if ($var["term"] == 'Длительный'){
                            echo '<option value="Месяц">Месяц</option>
                            <option value="Три месяца">Три месяца</option>
                            <option value="Полгода">Полгода</option>
                            <option value="Год">Год</option>
                            <option value="Длительный" selected>Длительный</option>';
                        }?>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Статус *:</label>
					<select class="col-md-12 mh-100" name="status" id="select" required>
					<?php if ($var["status"] == 'Свободно') {
                            echo '<option value="Свободно" selected>Свободно</option>
                                  <option value="Занято">Занято</option>';
                        } else {
                            echo '<option value="Свободно">Свободно</option>
                            <option value="Занято" selected>Занято</option>';
                        }?>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Стоимость в $ *:</label>
					<input type="number" value = "<?php echo $var["cost"];?>" name="cost" class="form-control" id="text" required>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Контактный номер *:</label>
					<input type="number" value = "<?php echo $var["contact_number"];?>" name="contact_number" class="form-control" id="text" required>
				</div>

				<div class="col-md-4" id="image-form" id="text-form">
					<label for="image" class="form-label">НОВОЕ Изображение *:</label>
            	<input type="file" name="image" class="form-control" id="image">
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Юзер *:</label>
					<select class="col-md-12 mh-100" name="id_user" id="select" required>
						<option value="" disabled selected hidden></option>
						<?php
						$user2 = mysqli_query($link,"SELECT * FROM `user`");
						while ($var42 = mysqli_fetch_assoc($user2)){
							if($var42["id"] != $id_user) {
								echo '<option value="' . $var42["id"] . '">#' . $var42["id"] . ' - ' . $var42["login"] . ', ' . $var42["role"] . '</option>';
							} else {
								echo '<option selected value="' . $var42["id"] . '">#' . $var42["id"] . ' - ' . $var42["login"] . ', ' . $var42["role"] . '</option>';
							}
						}
						?>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Город *:</label>
					<select class="col-md-12 mh-100" name="city" id="select" required>
					<?php if ($var2["city"] == 'Минск') {
                            echo '<option value="Минск" selected>Минск</option>
                            <option value="Гомель">Гомель</option>
                            <option value="Могилёв">Могилёв</option>
                            <option value="Витебск">Витебск</option>
                            <option value="Гродно">Гродно</option>
                            <option value="Брест">Брест</option>';
                        } else if ($var2["city"] == 'Гомель') {
                            echo '<option value="Минск">Минск</option>
                            <option value="Гомель" selected>Гомель</option>
                            <option value="Могилёв">Могилёв</option>
                            <option value="Витебск">Витебск</option>
                            <option value="Гродно">Гродно</option>
                            <option value="Брест">Брест</option>';
                        } else if ($var2["city"] == 'Могилёв') {
                            echo '<option value="Минск">Минск</option>
                            <option value="Гомель">Гомель</option>
                            <option value="Могилёв" selected>Могилёв</option>
                            <option value="Витебск">Витебск</option>
                            <option value="Гродно">Гродно</option>
                            <option value="Брест">Брест</option>';
                        } else if ($var2["city"] == 'Витебск') {
                            echo '<option value="Минск">Минск</option>
                            <option value="Гомель">Гомель</option>
                            <option value="Могилёв">Могилёв</option>
                            <option value="Витебск" selected>Витебск</option>
                            <option value="Гродно">Гродно</option>
                            <option value="Брест">Брест</option>';
                        } else if ($var2["city"] == 'Гродно') {
                            echo '<option value="Минск">Минск</option>
                            <option value="Гомель">Гомель</option>
                            <option value="Могилёв">Могилёв</option>
                            <option value="Витебск">Витебск</option>
                            <option value="Гродно" selected>Гродно</option>
                            <option value="Брест">Брест</option>';
                        } else if ($var2["city"] == 'Брест') {
                            echo '<option value="Минск">Минск</option>
                            <option value="Гомель">Гомель</option>
                            <option value="Могилёв">Могилёв</option>
                            <option value="Витебск">Витебск</option>
                            <option value="Гродно">Гродно</option>
                            <option value="Брест" selected>Брест</option>';
                        }?>
					</select>
					</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Улица *:</label>
					<input type="text" value = "<?php echo $var2["street"];?>" name="street" class="form-control" id="text" required>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Номер дома*:</label>
					<input type="number" value = "<?php echo $var2["house_number"];?>" name="house_number" class="form-control" id="text" required>
				</div>

				<div class="col-12">
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>

			</form>
		</div>
	</div>
	</div>
	</body>

</html>







