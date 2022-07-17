<?
	require_once 'include/db.php'; //$link
    
    session_start();

    $login = $_SESSION['login'];
	$password = $_SESSION['password'];

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
            margin-top: 24px;
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
    </style>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
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
        <form action="include/addRent.php" method="post" enctype="multipart/form-data">
            <div class="wa">
                <div style="width: 200px;">
                    <p style="font-size: 18px;">Укажите параметры<br>жилого помещения:</p>
                    <br>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Количество комнат *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input type="number" name="number_of_rooms" class="form-control" id="text" required>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Площадь м<sup>2</sup> *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input type="number" name="square" class="form-control" id="text" required>
                        </div>
                    </div>
                    <select name="residential_object" required>
                        <option value="" disabled selected hidden>Жилой объект *</option>
                        <option value="Квартира">Квартира</option>
                        <option value="Дом">Дом</option>
                    </select>
                    <select name="bathrom" required>
                        <option value="" disabled selected hidden>Санузел *</option>
                        <option value="Имеется">Имеется</option>
                        <option value="Отсутствует">Отсутствует</option>
                    </select>
                    <select name="heating" required>
                        <option value="" disabled selected hidden>Отопление *</option>
                        <option value="Имеется">Имеется</option>
                        <option value="Отсутствует">Отсутствует</option>
                    </select>
                    <select name="term" required>
                        <option value="" disabled selected hidden>Выберите срок *</option>
                        <option value="Месяц">Месяц</option>
                        <option value="Три месяца">Три месяца</option>
                        <option value="Полгода">Полгода</option>
                        <option value="Год">Год</option>
                        <option value="Длительный">Длительный</option>
                    </select>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Стоимость в $ *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input type="number" name="cost" class="form-control" id="text">
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Контактный номер *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input type="number" name="contact_number" class="form-control" id="text" required>
                        </div>
                    </div>
                </div>
                <!-- <br> -->
                <div style="width: 200px;">
                    <p style="font-size: 18px;">Укажите адрес<br>жилого помещения:</p>
                    <select name="city" required style = "margin-top: 48px;">
                        <option value="" disabled selected hidden>Выбирите город *</option>
                        <option value="Минск">Минск</option>
                        <option value="Гомель">Гомель</option>
                        <option value="Могилёв">Могилёв</option>
                        <option value="Витебск">Витебск</option>
                        <option value="Гродно">Гродно</option>
                        <option value="Брест">Брест</option>
                    </select>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Название улицы *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input type="text" name="street" class="form-control" id="text" required>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>Номер дома *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input type="text" name="house_number" class="form-control" id="text" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="image-form" style = "width: 400px">
                    <label for="image" class="form-label">Изображение *:</label>
                    <input type="file" name="image" class="form-control" id="image" required>
			    </div>
                <button type="submit" class="btn btn-primary" style="width: 200px; margin-top: 24px;">Добавить</button>
            </div>
        </form>
        <div class="apartments" style = "margin-right: 0px">
        <?  $id_user = mysqli_query($link,"SELECT `id` FROM `user` WHERE `login` = '$login' AND `password` = '$password'");
	        while ($var = mysqli_fetch_assoc($id_user)) {
	            $id_user_r = $var["id"];
            }
            // echo $id_user_r;
            $rent = mysqli_query($link,"SELECT * FROM `rent` WHERE `id_user` = '$id_user_r'");
            //ДОСТАЛИ РЕНТУ С НУЖНЫМИ ID_USER И КРУТИМ ЕЁ
            while ($var2 = mysqli_fetch_assoc($rent)) {
                $apartment = mysqli_query($link, "SELECT * FROM `apartment`");
                while ($var3 = mysqli_fetch_assoc($apartment)) {
                    if ($var2["id_apartment"] == $var3["id"]) {
                        $id_of_apartment = $var3["id"];
                        $image = $var3["image"];
                        $cost = $var3["cost"];
                        $number_of_rooms = $var3["number_of_rooms"];
                        $residential_object = $var3["residential_object"];
                        $term = $var3["term"];
                        $square = $var3["square"];
                        $bathrom = $var3["bathrom"];
                        $heating = $var3["heating"];
                        $status = $var3["status"];
                        $contact_number = $var3["contact_number"];
                        $id_location = $var3["id_location"];
                    }
                }
                $location = mysqli_query($link, "SELECT * FROM `location`");
                while ($var4 = mysqli_fetch_assoc($location)) {
                    if ($id_location == $var4["id"]) {
                        $city = $var4["city"];
                        $street = $var4["street"];
                        $house_number = $var4["house_number"];
                    }
                }
                echo '
                <div class = "item add">
                    <div>
                        <p><img src="' . $image . '"style="width: 500px; ""></p>
                    </div>
                    <div class = "bot">
                        <div class = "options">
                            <p>Адрес: г. ' . $city . ', ул. ' . $street . ' дом ' . $house_number . '</p>
                            <p>Стоимость: ' . $cost . '$</p>
                            <p>Количество комнат: ' . $number_of_rooms . '</p>
                            <p>Жилой объект: ' . $residential_object . ';</p>
                            <p>Cрок сдачи: ' . $term . ';</p>
                            <p>Площадь: ' . $square . ' м<sup>2</sup>;</p>
                            <p>Санузел: ' . $bathrom . ';</p>
                            <p>Отопление: ' . $heating . '.</p>
                            <p>Контактный номер: +' . $contact_number . '</p>
                            <p>Статус: ' . $status . '.</p>
                        </div>
                        <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Действие</button>
                        <ul class="dropdown-menu" style="...">
                            <li><a class="dropdown-item" href="updateApartments.php?id=' . $id_of_apartment . '">Изменить</a></1i>
                            <li><a class="dropdown-item" href="include/deleteRoom.php?id=' . $id_of_apartment . '">Удалить</a></1i>
                        </ul>
                    </div>
                    </div>
                </div><br>';
            }
            // $apartment = mysqli_query($link,"SELECT `id` FROM `user` WHERE `login` = '$login' AND `password` = '$password'");
			// 	while ($var = mysqli_fetch_assoc($apartment)){
			// 		$location = mysqli_query($link,"SELECT * FROM `location`");
			// 		while ($var2 = mysqli_fetch_assoc($location)){
			// 			if($var2["id"] == $var["id_location"]) {
            //                 $city = $var2["city"];
            //                 $street = $var2["street"];
            //                 $house_number = $var2["house_number"];
            //             }
			// 		}
			// 		echo '<br>
            //         <div class = "item">
            //             <p>Адрес: г. ' . $city . ', ул. ' . $street . ' дом ' . $house_number . '</p>
            //             <p>Стоимость: ' . $var["cost"] . '$</p>
            //             <p>Количество комнат: ' . $var["number_of_rooms"] . '</p>
            //             <p>Жилой объект: ' . $var["residential_object"] . ';</p>
            //             <p>Cрок сдачи: ' . $var["term"] . ';</p>
            //             <p>Площадь: ' . $var["square"] . ' м<sup>2</sup>;</p>
            //             <p>Санузел: ' . $var["bathrom"] . ';</p>
            //             <p>Обогрев: ' . $var["heating"] . '.</p>
            //             <p>Контактный номер: +' . $var["contact_number"] . '</p>
            //         </div>';
            //     }
	    	?>
        </div>
    </main>
</body>

</html>