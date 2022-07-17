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
				<li style="text-decoration: underline;">
					<a href="users.php">Пользователи</a>
				</li>
				<li>
					<a href="apartments.php">Жилые помещения</a>
				</li>
			</ul>
		</div>
		</div>

	<div style="margin-left: 255px;">

		<div style="position: sticky; top: 0px; background: #ffffff; z-index: 1;">
			<div style="display: flex; justify-content: space-between; align-items: center; margin: 0; padding-right: 20px;">
				<h3 class="mb-3">Добавить пользователя</h3>
				<a href="include/logout.php" style="font-size: 24px; text-decoration: none;" class="ex">ВЫЙТИ</a>
			</div>

			<form action="include/addUser.php" method="post" class="row g-3" style="margin-bottom: 10px; padding-right: 20px;">

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Логин *:</label>
					<input type="text" name="login" class="form-control" id="text" required>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="text" class="form-label">Пароль *:</label>
					<input type="text" name="password" class="form-control" id="text" required>
				</div>

				<div class="col-md-2" id="text-form">
					<label for="select" class="form-label">Роль *:</label>
					<select class="col-md-12 mh-100" name="role" id="select" required>
						<option value="Client">Client</option>
						<option value="Admin">Admin</option>
					</select>
				</div>

				<div class="col-12">
					<button type="submit" class="btn btn-primary">Добавить</button>
				</div>
			</form>
		</div>

		<div style="display: flex; justify-content: space-between; align-items: center; width: 1380px; margin: 0;">
			<h1>Пользователи</h1>
		</div>
		<div style="padding-right: 20px;">
		<table class="table">
			<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Логин</th>
				<th scope="col">Пароль</th>
				<th scope="col">Роль</th>
				<th scope="col"></th>
			</tr>
			</thead>
			<tbody>
			<?
				while ($var = mysqli_fetch_assoc($user)){
					echo '<tr>
					<th scope="row">' . $var["id"] . '</th>
					<td>' . $var["login"] . '</td>
					<td>' . $var["password"] . '</td>
					<td>' . $var["role"] . '</td>
					<td align="right">
						<div class="btn-group">
							<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Действие</button>
							<ul class="dropdown-menu" style="...">
								<li><a class="dropdown-item" href="updateUser.php?id=' . $var["id"] . '">Изменить</a></1i>					
								<li><a class="dropdown-item" href="include/deleteUser.php?id=' . $var["id"] . '">Удалить</a></1i>
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







