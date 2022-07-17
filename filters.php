<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	require_once 'include/db.php';//$link
	$link->set_charset("utf8");
    session_start();

    $login = $_SESSION['login'];
	$password = $_SESSION['password'];
	// $apartment = mysqli_query($link,"SELECT * FROM `apartment`");

    // $term = 'false';
	// $bathrom = 'false';
    // $heating = 'false';
    // $low_cost = 0;
    // $hight_cost = 2147483647;

    $city_name = $_POST["city_name"];
	$term = $_POST["term"];
	$bathrom = $_POST["bathrom"];
    $heating = $_POST["heating"];
    $low_cost = $_POST["low_cost"];
    $hight_cost = $_POST["hight_cost"];
    $number_of_rooms = $_POST["number_of_rooms"];
    $residential_object = $_POST["residential_object"];

    if (empty($low_cost)) {
        $low_cost = 0;
    }
    if (empty($hight_cost)) {
        $hight_cost = 2147483647;
    }
    // echo $number_of_rooms;
    // echo $floor;
    //СУКАСУКАСУКАСУКАСУКАСУКА


    if ($number_of_rooms == '') {
        // echo 'ПУСТО';
        $apartment = mysqli_query($link,"SELECT * FROM `apartment` WHERE `cost` >= $low_cost AND `cost` <= $hight_cost AND `term` = '$term' AND `bathrom` = '$bathrom' AND `heating` = '$heating' AND `residential_object` = '$residential_object'");
    };
    if ($number_of_rooms !== '') {
        // echo 'ПУСТО';
        $apartment = mysqli_query($link,"SELECT * FROM `apartment` WHERE `cost` >= $low_cost AND `cost` <= $hight_cost AND `term` = '$term' AND `bathrom` = '$bathrom' AND `heating` = '$heating' AND `residential_object` = '$residential_object' AND `number_of_rooms` = '$number_of_rooms'");
    };

    // if ($number_of_rooms == '' && $floor == '') {
    //     // echo 'ПУСТО';
    //     $apartment = mysqli_query($link,"SELECT * FROM `apartment` WHERE `cost` >= $low_cost AND `cost` <= $hight_cost AND `term` = '$term' AND `bathrom` = '$bathrom' AND `heating` = '$heating'");
    // };
    // if ($number_of_rooms !== '' && $floor !== '') {
    //     // echo 'ГУСТО';
    //     $apartment = mysqli_query($link,"SELECT * FROM `apartment` WHERE `cost` >= $low_cost AND `cost` <= $hight_cost AND `term` = '$term' AND `bathrom` = '$bathrom' AND `heating` = '$heating' AND `floor` = $floor AND `number_of_rooms` = $number_of_rooms");
    // };
    // if ($number_of_rooms !== '' && $floor == '') {
    //     // echo 'С КОМНАТАМИ';
    //     $apartment = mysqli_query($link,"SELECT * FROM `apartment` WHERE `cost` >= $low_cost AND `cost` <= $hight_cost AND `term` = '$term' AND `bathrom` = '$bathrom' AND `heating` = '$heating' AND `number_of_rooms` = $number_of_rooms");
    // };
    // if ($number_of_rooms == '' && $floor !== '') {
    //     // echo 'БЕЗ КОМНАТ';
    //     $apartment = mysqli_query($link,"SELECT * FROM `apartment` WHERE `cost` >= $low_cost AND `cost` <= $hight_cost AND `term` = '$term' AND `bathrom` = '$bathrom' AND `heating` = '$heating' AND `floor` = $floor");
    // };





    // if ($number_of_rooms $floor) {
        
    // };
    // if ($number_of_rooms $floor) {
        
    // };


    // if (empty($heating)) {
    //     $heating = 'false';
    // }

    // if ($heating == 'Имеется') {
    //     echo $heating;
    //     $heating = "Имеется";
    //     echo $heating;
    // };
    // if ($heating == 'Отсутствует') {
    //     echo $heating;
    //     $heating = "Отсутствует";
    //     echo $heating;
    // };

	// $apartment = mysqli_query($link,"SELECT * FROM `apartment` WHERE `cost` >= $low_cost AND `cost` <= $hight_cost AND `term` = '$term' AND `bathrom` = '$bathrom' AND `heating` = '$heating'");






    // and `heating` <=> $heating and `term` <=> $term and `cost` >= $low_cost and `cost` <= $hight_cost

	// session_start();
	// $_SESSION ['come_date']=$come_date;
	// $_SESSION ['leave_date']=$leave_date;
	// $_SESSION ['capacity']=$capacity;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Home_page.css">
    <title>Document</title>
</head>

<body>
    <?
    // if ($_SESSION['login'] !== $login || $_SESSION['password'] !== $password){
    if ($login == "" || $password == ""){
		// header('Location: index.php');
        echo '<header>
                <div class="wraper">
                    <div class="logo">
                        <a href="index.php"><img src="image/logo.png"></a>
                    </div>
                    <div class="v">
                        <p><ins><a href="index.php" title="Главная">ГЛАВНАЯ</a></ins></p>
                        <p><a href="sign.php" title="Добавить объявление">ДОБАВИТЬ ОБЪЯВЛЕНИЕ</a></p>
                        <p><a href="sign.php" title="Вход или регистрация">ВОЙТИ</a></p>
                    </div>
                </div>
             </header>';
	} else {
        echo '<header>
                <div class="wraper">
                    <div class="logo" style = "display: flex; width: auto;">
                        <a href="index.php"><img src="image/logo.png"></a>
                        <p style = "line-height: 50px; margin-left: 30px;">ПОЛЬЗОВАТЕЛЬ: ' . $login . '<p>
                    </div>
                    <div class="v">
                        <p><ins><a href="index.php" title="Главная">ГЛАВНАЯ</a></ins></p>
                        <p><a href="page_add.php" title="Объявления">МОИ ОБЪЯВЛЕНИЯ</a></p>
                        <p><a href="include/logout.php" title="Выход">ВЫЙТИ</a></p>
                    </div>
                </div>
            </header>';
    }
    ?>
    <!-- <header>
        <div class="wraper">
            <div class="logo">
                <a href="index.php"><img src="image/logo.png"></a>
            </div>
            <div class="v">
                <p><a href="index.php" title="Главная">ГЛАВНАЯ</a></p>
                <p><a href="page_add.php" title="Добавить объявление">ДОБАВИТЬ ОБЪЯВЛЕНИЕ</a></p>
                <p><a href="sign.php" title="Вход или регистрация">ВОЙТИ</a></p>
            </div>
        </div>
    </header> -->
    <main>
    <form action="filters.php" method="post">
            <div class="filters">
                <p>Поиск по фильтрам:</p>
                <p style="font-size: 14px;">Обязательные поля помечены знаком *</p>
                <select name="city_name" required>
                    <option value="" disabled selected hidden>Выбирите город *</option>
                    <option value="Минск">Минск</option>
                    <option value="Гомель">Гомель</option>
                    <option value="Могилёв">Могилёв</option>
                    <option value="Витебск">Витебск</option>
                    <option value="Гродно">Гродно</option>
                    <option value="Брест">Брест</option>
                </select>
                <select name="term" required>
                    <option value="" disabled selected hidden>Выбирите срок *</option>
                    <option value="Месяц">Месяц</option>
                    <option value="Три месяца">Три месяца</option>
                    <option value="Полгода">Полгода</option>
                    <option value="Год">Год</option>
                    <option value="Длительный">Длительный</option>
                </select>
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
                <div class="col-md-100">
                    <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                        <p>Цена в $:</p>
                        <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                        <input type="number" name="low_cost" class="form-control" id="text" placeholder="от">
                    </div>
                    <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                        <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                        <input type="number" name="hight_cost" class="form-control" id="text" placeholder="до">
                    </div>
                </div>
                <div class="col-md-100">
                    <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                        <p>Количество комнат:</p>
                        <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                        <input type="number" name="number_of_rooms" class="form-control" id="text">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 160px;">Поиск</button>
            </div>
        </form>
        <div class="apartments">
            <?
				// while ($var = mysqli_fetch_assoc($apartment)){
				// 	$location = mysqli_query($link,"SELECT * FROM `location`");
				// 	while ($var2 = mysqli_fetch_assoc($location)){
				// 		if($var2["id"] == $var["id_location"]) {
                //             $city = $var2["city"];
                //             $street = $var2["street"];
                //             $house_number = $var2["house_number"];
                //         }
				// 	}
				// 	echo '<br>
                //     <div class = "item">
                //         <p>Адрес: г. ' . $city . ', ул. ' . $street . ' дом ' . $house_number . '</p>
                //         <p>Стоимость: ' . $var["cost"] . '$</p>
                //         <p>Количество комнат: ' . $var["number_of_rooms"] . '</p>
                //         <p>Этаж: ' . $var["floor"] . ';</p>
                //         <p>Cрок сдачи: ' . $var["term"] . ';</p>
                //         <p>Площадь: ' . $var["square"] . ' м<sup>2</sup>;</p>
                //         <p>Санузел: ' . $var["bathrom"] . ';</p>
                //         <p>Обогрев: ' . $var["heating"] . '.</p>
                //         <p>Контактный номер: +' . $var["contact_number"] . '</p>
                //     </div>';
                // }

				while ($var = mysqli_fetch_assoc($apartment)){
                    $location = mysqli_query($link,"SELECT * FROM `location`");
                    while ($var2 = mysqli_fetch_assoc($location)){
                         if($var2["id"] == $var["id_location"]) {
                            $city = $var2["city"];
                            $street = $var2["street"];
                            $house_number = $var2["house_number"];
                        }
                    }
                    if ($city == $city_name) {
                        echo '
                        <div class = "item">
                            <div>
                                <p><img src="' . $var["image"] . '"style="width: 500px; ""></p>
                            </div>
                            <div class = "options">
                                <p>Адрес: г. ' . $city . ', ул. ' . $street . ' дом ' . $house_number . ';</p>
                                <p>Стоимость: ' . $var["cost"] . '$</p>
                                <p>Количество комнат: ' . $var["number_of_rooms"] . ';</p>
                                <p>Жилой объект: ' . $var["residential_object"] . ';</p>
                                <p>Cрок сдачи: ' . $var["term"] . ';</p>
                                <p>Площадь: ' . $var["square"] . ' м<sup>2</sup>;</p>
                                <p>Санузел: ' . $var["bathrom"] . ';</p>
                                <p>Обогрев: ' . $var["heating"] . '.</p>
                                <p style = "font-size: 20px">Контактный номер:<br><b>+' . $var["contact_number"] . '</b></p>
                            </div>
                        </div><br>';
                    }
                }
	    	?>
        </div>
    </main>
</body>

</html>

    <!-- <form action="Filters.php" method="post" class="row g-3">
        <div class="col-md-10">
            <div class="col-md-3">
                <p>Города</p>
                <select class="md-24 mh-100" name="selector" id="select">
                <option value="1">Брест</option>
                <option value="2">Витебск</option>
                <option value="3">Гомель</option>
                <option value="4">Гродно</option>
                <option value="5">Минск</option>
                <option value="6">Могилёв</option> 
            </select>
            </div>

            <div class="col-md-3" id="text-form">
                <p>Количество комнат</p>
                <select class="md-24 mh-100" name="selector" id="select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option> 
            </select>
            </div>
            <div class="col-md-3">
                <div class="col-md-3" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;" required>
                    <p>Цена</p>
                    <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                    <input type="text" name="capacity" class="form-control" id="text" placeholder="от">

                </div>
                <div class="col-md-3" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;" required>
                    <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                    <input type="text" name="capacity" class="form-control" id="text" placeholder="до">

                </div>
            </div>
            <div class="col-md-3">
                <div class="col-md-3" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;" required>
                    <p>Этаж</p>
                    <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                    <input type="text" name="capacity" class="form-control" id="text" placeholder="">
                </div>
            </div>
        </div>
    </form> -->