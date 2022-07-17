<?
	require_once 'include/db.php'; //$link
    session_start();

    $login = $_SESSION['login'];
	$password = $_SESSION['password'];

    // if ($_SESSION['login'] !== $login || $_SESSION['password'] !== $password){
    if ($login == "" || $password == ""){
		header('Location: index.php');
	}

    //new session
    $session = mysqli_query($link, "SELECT * FROM `user`");
    $value = true;
    while ($varSession = mysqli_fetch_assoc($session)) {
        if ($login == $varSession["login"] && $password == $varSession["password"]) {
            $value = false;
        }
    }
    if ($value) {
        unset($login);
        unset($password);
        header('Location: index.php');
    }
    //

	$id = $_GET["id"];
	$var = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `apartment` WHERE `apartment`.`id` = $id"));
	$id_location = $var["id_location"];
	$var2 = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `location` WHERE `location`.`id` = $id_location"));
    // echo $login;
    // echo $password;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Home_page.css">
    <title>Document</title>
</head>
    
    <style>
        select {
            width: 183px;
            height: 38px;
            display: block;
            /* margin-top: 24px; */
        }
        .wa {
            position: sticky;
            top: 100px;
            width: 420px;
            background: #eee;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .options {
            margin-left: 0px;
        }
        .bot {
            display: flex;
            align-items: flex-start;
            margin-top: 10px;
            justify-content: flex-start;
        }
		  main {
				justify-content: center;
		  }
    </style>

	<body>
		<header>
			<div class="wraper">
					<div class="logo" style = "display: flex; width: auto;">
						<a href="index.php"><img src="image/logo.png"></a>
						<p style = "line-height: 50px; margin-left: 30px;"><?echo 'ПОЛЬЗОВАТЕЛЬ: ' . $login . '';?><p>
					</div>
					<div class="v">
						<p><a href="index.php" title="Главная">ГЛАВНАЯ</a></p>
						<p><ins><a href="page_add.php" title="Объявления">МОИ ОБЪЯВЛЕНИЯ</a></ins></p>
						<p><a href="include/logout.php" title="Выход">ВЫЙТИ</a></p>
					</div>
			</div>
		</header>
		<main>
        <form action="include/saveUpdateApartments.php" method="post" enctype="multipart/form-data">
            <div class="wa">
				<input type="hidden" value="<?php echo $var["id"];?>" name="id" >
				<input type="hidden" value="<?php echo $id_location;?>" name="id_location" >
                <div style="width: 200px;">
                    <p style="font-size: 18px;">Укажите параметры<br>жилого помещения:</p>
                    <br>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Количество комнат *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var["number_of_rooms"];?>" type="number" name="number_of_rooms" class="form-control" id="text" required>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Площадь м<sup>2</sup> *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var["square"];?>" type="number" name="square" class="form-control" id="text" required>
                        </div>
                    </div>
                    <!---->
                    <!---->
                    <!---->
                    <!---->
                    <!---->
                    <p>Жилой объект *:</p>
                    <select name="residential_object" required>
                        <!-- <option value="" disabled selected hidden>Жилой объект *</option> -->
                        <!-- <option value="Квартира">Квартира</option> -->
                        <!-- <option value="Дом">Дом</option> -->
                        <?php if ($var["residential_object"] == 'Дом') {
                            echo '<option value="Квартира">Квартира</option>
                                  <option value="Дом" selected>Дом</option>';
                        } else {
                            echo '<option value="Квартира" selected>Квартира</option>
                            <option value="Дом">Дом</option>';
                        }?>
                    </select>
                    <p>Санузел *:</p>
                    <select name="bathrom" required>
                        <!-- <option value="" disabled selected hidden>Санузел *</option> -->
                        <!-- <option value="Имеется">Имеется</option> -->
                        <!-- <option value="Отсутствует">Отсутствует</option> -->
                        <?php if ($var["bathrom"] == 'Имеется') {
                            echo '<option value="Имеется" selected>Имеется</option>
                                  <option value="Отсутствует">Отсутствует</option>';
                        } else {
                            echo '<option value="Имеется">Имеется</option>
                            <option value="Отсутствует" selected>Отсутствует</option>';
                        }?>
                    </select>
                    <p>Отопление *:</p>
                    <select name="heating" required>
                        <!-- <option value="" disabled selected hidden>Отопление *</option> -->
                        <!-- <option value="Имеется">Имеется</option> -->
                        <!-- <option value="Отсутствует">Отсутствует</option> -->
                        <?php if ($var["heating"] == 'Имеется') {
                            echo '<option value="Имеется" selected>Имеется</option>
                                  <option value="Отсутствует">Отсутствует</option>';
                        } else {
                            echo '<option value="Имеется">Имеется</option>
                            <option value="Отсутствует" selected>Отсутствует</option>';
                        }?>
                    </select>
                    <p>Выбирите срок *:</p>
                    <select name="term" required>
                        <!-- <option value="" disabled selected hidden>Выбирите срок *</option>
                        <option value="Месяц">Месяц</option>
                        <option value="Три месяца">Три месяца</option>
                        <option value="Полгода">Полгода</option>
                        <option value="Год">Год</option>
                        <option value="Длительный">Длительный</option> -->
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
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Стоимость в $ *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var["cost"];?>" type="number" name="cost" class="form-control" id="text">
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Контактный номер *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var["contact_number"];?>" type="number" title="please enter number only" name="contact_number" class="form-control" id="text" required>
                        </div>
                    </div>
                </div>
                <!-- <br> -->
                <div style="width: 200px;">
                    <p style="font-size: 18px;">Укажите адрес<br>жилого помещения:</p>
                    <p style = "margin-top: 24px;">Выбирите город *:</p>
                    <select name="city" required>
                        <!-- <option value="" disabled selected hidden>Выбирите город *</option>
                        <option value="Минск">Минск</option>
                        <option value="Гомель">Гомель</option>
                        <option value="Могилёв">Могилёв</option>
                        <option value="Витебск">Витебск</option>
                        <option value="Гродно">Гродно</option>
                        <option value="Брест">Брест</option> -->
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
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Название улицы *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var2["street"];?>" type="text" name="street" class="form-control" id="text" required>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Номер дома *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var2["house_number"];?>" type="text" name="house_number" class="form-control" id="text" required>
                        </div>
                    </div>
                    <p>Статус *:</p>
					<select name="status" required>
                    <?php if ($var["status"] == 'Свободно') {
                            echo '<option value="Свободно" selected>Свободно</option>
                                  <option value="Занято">Занято</option>';
                        } else {
                            echo '<option value="Свободно">Свободно</option>
                            <option value="Занято" selected>Занято</option>';
                        }?>
                        <!-- <option value="" disabled selected hidden>Статус *</option> -->
                        <!-- <option value="Свободно">Свободно</option> -->
                        <!-- <option value="Занято">Занято</option> -->

                    </select>
                </div>
                <div class="col-md-12" id="image-form" style = "width: 400px">
                    <label for="image" class="form-label">НОВОЕ изображение:</label>
                    <input type="file" name="image" class="form-control" id="image">
			    </div>
                <button type="submit" class="btn btn-primary" style="width: 200px; margin-top: 24px;">Обновить</button>
            </div>
        </form>
		</main>
	</body>
</html>