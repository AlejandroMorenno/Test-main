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
						<p style = "line-height: 50px; margin-left: 30px;"><?echo '????????????????????????: ' . $login . '';?><p>
					</div>
					<div class="v">
						<p><a href="index.php" title="??????????????">??????????????</a></p>
						<p><ins><a href="page_add.php" title="????????????????????">?????? ????????????????????</a></ins></p>
						<p><a href="include/logout.php" title="??????????">??????????</a></p>
					</div>
			</div>
		</header>
		<main>
        <form action="include/saveUpdateApartments.php" method="post" enctype="multipart/form-data">
            <div class="wa">
				<input type="hidden" value="<?php echo $var["id"];?>" name="id" >
				<input type="hidden" value="<?php echo $id_location;?>" name="id_location" >
                <div style="width: 200px;">
                    <p style="font-size: 18px;">?????????????? ??????????????????<br>???????????? ??????????????????:</p>
                    <br>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>???????????????????? ???????????? *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var["number_of_rooms"];?>" type="number" name="number_of_rooms" class="form-control" id="text" required>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>?????????????? ??<sup>2</sup> *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var["square"];?>" type="number" name="square" class="form-control" id="text" required>
                        </div>
                    </div>
                    <!---->
                    <!---->
                    <!---->
                    <!---->
                    <!---->
                    <p>?????????? ???????????? *:</p>
                    <select name="residential_object" required>
                        <!-- <option value="" disabled selected hidden>?????????? ???????????? *</option> -->
                        <!-- <option value="????????????????">????????????????</option> -->
                        <!-- <option value="??????">??????</option> -->
                        <?php if ($var["residential_object"] == '??????') {
                            echo '<option value="????????????????">????????????????</option>
                                  <option value="??????" selected>??????</option>';
                        } else {
                            echo '<option value="????????????????" selected>????????????????</option>
                            <option value="??????">??????</option>';
                        }?>
                    </select>
                    <p>?????????????? *:</p>
                    <select name="bathrom" required>
                        <!-- <option value="" disabled selected hidden>?????????????? *</option> -->
                        <!-- <option value="??????????????">??????????????</option> -->
                        <!-- <option value="??????????????????????">??????????????????????</option> -->
                        <?php if ($var["bathrom"] == '??????????????') {
                            echo '<option value="??????????????" selected>??????????????</option>
                                  <option value="??????????????????????">??????????????????????</option>';
                        } else {
                            echo '<option value="??????????????">??????????????</option>
                            <option value="??????????????????????" selected>??????????????????????</option>';
                        }?>
                    </select>
                    <p>?????????????????? *:</p>
                    <select name="heating" required>
                        <!-- <option value="" disabled selected hidden>?????????????????? *</option> -->
                        <!-- <option value="??????????????">??????????????</option> -->
                        <!-- <option value="??????????????????????">??????????????????????</option> -->
                        <?php if ($var["heating"] == '??????????????') {
                            echo '<option value="??????????????" selected>??????????????</option>
                                  <option value="??????????????????????">??????????????????????</option>';
                        } else {
                            echo '<option value="??????????????">??????????????</option>
                            <option value="??????????????????????" selected>??????????????????????</option>';
                        }?>
                    </select>
                    <p>???????????????? ???????? *:</p>
                    <select name="term" required>
                        <!-- <option value="" disabled selected hidden>???????????????? ???????? *</option>
                        <option value="??????????">??????????</option>
                        <option value="?????? ????????????">?????? ????????????</option>
                        <option value="??????????????">??????????????</option>
                        <option value="??????">??????</option>
                        <option value="????????????????????">????????????????????</option> -->
                        <?php if ($var["term"] == '??????????') {
                            echo '<option value="??????????" selected>??????????</option>
                            <option value="?????? ????????????">?????? ????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="??????">??????</option>
                            <option value="????????????????????">????????????????????</option>';
                        } else if ($var["term"] == '?????? ????????????'){
                            echo '<option value="??????????">??????????</option>
                            <option value="?????? ????????????" selected>?????? ????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="??????">??????</option>
                            <option value="????????????????????">????????????????????</option>';
                        } else if ($var["term"] == '??????????????'){
                            echo '<option value="??????????">??????????</option>
                            <option value="?????? ????????????">?????? ????????????</option>
                            <option value="??????????????" selected>??????????????</option>
                            <option value="??????">??????</option>
                            <option value="????????????????????">????????????????????</option>';
                        } else if ($var["term"] == '??????'){
                            echo '<option value="??????????">??????????</option>
                            <option value="?????? ????????????">?????? ????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="??????" selected>??????</option>
                            <option value="????????????????????">????????????????????</option>';
                        } else if ($var["term"] == '????????????????????'){
                            echo '<option value="??????????">??????????</option>
                            <option value="?????? ????????????">?????? ????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="??????">??????</option>
                            <option value="????????????????????" selected>????????????????????</option>';
                        }?>
                    </select>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>?????????????????? ?? $ *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var["cost"];?>" type="number" name="cost" class="form-control" id="text">
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>???????????????????? ?????????? *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var["contact_number"];?>" type="number" title="please enter number only" name="contact_number" class="form-control" id="text" required>
                        </div>
                    </div>
                </div>
                <!-- <br> -->
                <div style="width: 200px;">
                    <p style="font-size: 18px;">?????????????? ??????????<br>???????????? ??????????????????:</p>
                    <p style = "margin-top: 24px;">???????????????? ?????????? *:</p>
                    <select name="city" required>
                        <!-- <option value="" disabled selected hidden>???????????????? ?????????? *</option>
                        <option value="??????????">??????????</option>
                        <option value="????????????">????????????</option>
                        <option value="??????????????">??????????????</option>
                        <option value="??????????????">??????????????</option>
                        <option value="????????????">????????????</option>
                        <option value="??????????">??????????</option> -->
                        <?php if ($var2["city"] == '??????????') {
                            echo '<option value="??????????" selected>??????????</option>
                            <option value="????????????">????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="????????????">????????????</option>
                            <option value="??????????">??????????</option>';
                        } else if ($var2["city"] == '????????????') {
                            echo '<option value="??????????">??????????</option>
                            <option value="????????????" selected>????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="????????????">????????????</option>
                            <option value="??????????">??????????</option>';
                        } else if ($var2["city"] == '??????????????') {
                            echo '<option value="??????????">??????????</option>
                            <option value="????????????">????????????</option>
                            <option value="??????????????" selected>??????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="????????????">????????????</option>
                            <option value="??????????">??????????</option>';
                        } else if ($var2["city"] == '??????????????') {
                            echo '<option value="??????????">??????????</option>
                            <option value="????????????">????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="??????????????" selected>??????????????</option>
                            <option value="????????????">????????????</option>
                            <option value="??????????">??????????</option>';
                        } else if ($var2["city"] == '????????????') {
                            echo '<option value="??????????">??????????</option>
                            <option value="????????????">????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="????????????" selected>????????????</option>
                            <option value="??????????">??????????</option>';
                        } else if ($var2["city"] == '??????????') {
                            echo '<option value="??????????">??????????</option>
                            <option value="????????????">????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="??????????????">??????????????</option>
                            <option value="????????????">????????????</option>
                            <option value="??????????" selected>??????????</option>';
                        }?>
                    </select>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>???????????????? ?????????? *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var2["street"];?>" type="text" name="street" class="form-control" id="text" required>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="col-md-100" id="text-form" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <p>?????????? ???????? *:</p>
                            <label for="text" class="form-label" style="margin-bottom: 0px"></label>
                            <input value = "<?php echo $var2["house_number"];?>" type="text" name="house_number" class="form-control" id="text" required>
                        </div>
                    </div>
                    <p>???????????? *:</p>
					<select name="status" required>
                    <?php if ($var["status"] == '????????????????') {
                            echo '<option value="????????????????" selected>????????????????</option>
                                  <option value="????????????">????????????</option>';
                        } else {
                            echo '<option value="????????????????">????????????????</option>
                            <option value="????????????" selected>????????????</option>';
                        }?>
                        <!-- <option value="" disabled selected hidden>???????????? *</option> -->
                        <!-- <option value="????????????????">????????????????</option> -->
                        <!-- <option value="????????????">????????????</option> -->

                    </select>
                </div>
                <div class="col-md-12" id="image-form" style = "width: 400px">
                    <label for="image" class="form-label">?????????? ??????????????????????:</label>
                    <input type="file" name="image" class="form-control" id="image">
			    </div>
                <button type="submit" class="btn btn-primary" style="width: 200px; margin-top: 24px;">????????????????</button>
            </div>
        </form>
		</main>
	</body>
</html>