<?
	require_once 'include/db.php'; //$link

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

	// $location = mysqli_query($link,"SELECT * FROM `location`");
	$apartment = mysqli_query($link,"SELECT * FROM `apartment`");
	$user = mysqli_query($link,"SELECT * FROM `user`");
?>

<!DOCTYPE html>

<html lang="ru">

	<head>
		<title>AdminPanel</title><!--AdminPanel-->
		<meta charset="utf-8">
		<meta name="descriprion" content="AdminPanel">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
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
	th, td {
   	padding: 2px;
	}
	</style>

	<body>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
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

	<div style="margin-left: 255px; width: fit-content;">

		<div style="position: sticky; top: 0px; background: #ffffff; z-index: 1;">
			<div style="display: flex; justify-content: space-between; align-items: center; padding-right: 20px; margin: 0;">
				<h3 class="mb-3">Добавить жилое помещение</h3>
				<a href="include/logout.php" class="ex" style="font-size: 24px; text-decoration: none;">ВЫЙТИ</a>
			</div>

			<form action="include/addApartment.php" method="post" class="row g-3" style="margin-bottom: 10px; padding-right: 20px;"  enctype="multipart/form-data">

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Количество комнат *:</label>
					<input type="number" name="number_of_rooms" class="form-control" id="text" required>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Площадь м<sup>2</sup> *:</label>
					<input type="number" name="square" class="form-control" id="text" required>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Вид объекта *:</label>
					<select class="col-md-12 mh-100" name="residential_object" id="select" required>
						<option value="" disabled selected hidden></option>
                  <option value="Квартира">Квартира</option>
                  <option value="Дом">Дом</option>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Санузел *:</label>
					<select class="col-md-12 mh-100" name="bathrom" id="select" required>
						<option value="" disabled selected hidden></option>
                  <option value="Имеется">Имеется</option>
                  <option value="Отсутствует">Отсутствует</option>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Отопление *:</label>
					<select class="col-md-12 mh-100" name="heating" id="select" required>
						<option value="" disabled selected hidden></option>
                  <option value="Имеется">Имеется</option>
                  <option value="Отсутствует">Отсутствует</option>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Выберите срок *:</label>
					<select class="col-md-12 mh-100" name="term" id="select" required>
						<option value="" disabled selected hidden></option>
                  <option value="Месяц">Месяц</option>
                  <option value="Три месяца">Три месяца</option>
                  <option value="Полгода">Полгода</option>
                  <option value="Год">Год</option>
                  <option value="Длительный">Длительный</option>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Статус *:</label>
					<select class="col-md-12 mh-100" name="status" id="select" required>
						<option value="" disabled selected hidden></option>
                  <option value="Свободно">Свободно</option>
                  <option value="Занято">Занято</option>
					</select>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Стоимость в $ *:</label>
					<input type="number" name="cost" class="form-control" id="text" required>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Контактный номер *:</label>
					<input type="number" name="contact_number" class="form-control" id="text" required>
				</div>

				<div class="col-md-4" id="image-form" id="text-form">
					<label for="image" class="form-label">Изображение *:</label>
            	<input type="file" name="image" class="form-control" id="image" required>
				</div>

				<!-- <div class="col-md-3" id="text-form">
					<label for="select" class="form-label">Локация *:</label>
					<select class="col-md-12 mh-100" name="id_location" id="select" required>
						<option value="" disabled selected hidden></option>
						<?php
						//while ($var2 = mysqli_fetch_assoc($location)){
							//echo '<option value="' . $var2["id"] . '">#' . $var2["id"] . ' - г. ' . $var2["city"] . ', ул. ' . $var2["street"] . ' дом ' . $var2["house_number"] . '</option>';
						//}
						?>
					</select>
				</div> -->

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Юзер *:</label>
					<select class="col-md-12 mh-100" name="id_user" id="select" required>
						<option value="" disabled selected hidden></option>
						<?php
						while ($var3 = mysqli_fetch_assoc($user)){
							echo '<option value="' . $var3["id"] . '">#' . $var3["id"] . ' - ' . $var3["login"] . ', ' . $var3["role"] . '</option>';
						}
						?>
					</select>
				</div>

				<div class="col-md-2" id="text-form" style="font-size: 26px; margin-top: 40px">
					Укажите адрес:
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Город *:</label>
					<select class="col-md-12 mh-100" name="city" id="select" required>
					<option value="" disabled selected hidden></option>
                        <option value="Минск">Минск</option>
                        <option value="Гомель">Гомель</option>
                        <option value="Могилёв">Могилёв</option>
                        <option value="Витебск">Витебск</option>
                        <option value="Гродно">Гродно</option>
                        <option value="Брест">Брест</option>
					</select>
					</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Улица *:</label>
					<input type="text" name="street" class="form-control" id="text" required>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Номер дома*:</label>
					<input type="number" name="house_number" class="form-control" id="text" required>
				</div>

				<div class="col-12">
					<button type="submit" class="btn btn-primary">Добавить</button>
				</div>

			</form>
		</div>

		<div style="display: flex; justify-content: space-between; align-items: center; width: 1380px; margin: 0;">
			<h1>Жилые помещения</h1>
		</div>
		<div style="padding-right: 15px;">
		<table class="table">
			<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Кол-во комнат</th>
				<th scope="col">Площадь м<sup>2</sup></th>
				<th scope="col">Вид объекта</th>
				<th scope="col">Санузел</th>
				<th scope="col">Отопление</th>
				<th scope="col">Срок</th>
				<th scope="col">Статус</th>
				<th scope="col">Стоимость в $</th>
				<th scope="col">Контактный номер</th>
				<th scope="col">Изображение</th>
				<th scope="col">Локация</th>
				<th scope="col">Юзер</th>
				<th scope="col"></th>
			</tr>
			</thead>
			<tbody>
			<?
				while ($var = mysqli_fetch_assoc($apartment)){
					$id_apartment = $var["id"];
					$id_location = $var["id_location"];
					$rent = mysqli_query($link,"SELECT * FROM `rent` WHERE `rent`.`id_apartment` = '$id_apartment'");
					while ($var4 = mysqli_fetch_assoc($rent)) {
						$id_user_r = $var4["id_user"];
					}
					$user2 = mysqli_query($link,"SELECT * FROM `user` WHERE `id` = $id_user_r");
					while ($var5 = mysqli_fetch_assoc($user2)) {
						$login = $var5["login"];
						$role = $var5["role"];
					}
					$location2 = mysqli_query($link,"SELECT * FROM `location` WHERE `id` = $id_location");
					while ($var6 = mysqli_fetch_assoc($location2)) {
						$city = $var6["city"];
						$street = $var6["street"];
						$house_number = $var6["house_number"];
					}
					echo '<tr>
					<th scope="row">' . $var["id"] . '</th>
					<td>' . $var["number_of_rooms"] . '</td>
					<td>' . $var["square"] . '</td>
					<td>' . $var["residential_object"] . '</td>
					<td>' . $var["bathrom"] . '</td>
					<td>' . $var["heating"] . '</td>
					<td>' . $var["term"] . '</td>
					<td>' . $var["status"] . '</td>
					<td>' . $var["cost"] . '</td>
					<td>' . $var["contact_number"] . '</td>
					<td>' . $var["image"] . '</td>
					<td>#' . $id_location . ' г. Минск, ул. '.$street.' '.$house_number.'</td>
					<td>#' . $id_user_r . ' - '.$login.', '.$role.'</td>
					<td align="right">
						<div class="btn-group">
							<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Действие</button>
							<ul class="dropdown-menu" style="...">
								<li><a class="dropdown-item" href="updateApartment.php?id=' . $var["id"] . '">Изменить</a></1i>					
								<li><a class="dropdown-item" href="include/deleteApartment.php?id=' . $var["id"] . '">Удалить</a></1i>
							</ul>
						</div>
					</td>
				</tr>';
				}
			?>
			</tbody>
		</table>


	</div>
	</div>
	</div>
	</body>

</html>







