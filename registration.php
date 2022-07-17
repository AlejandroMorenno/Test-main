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
    <header>
        <div class="wraper">
            <div class="logo">
                <a href="index.php"><img src="image/logo.png"></a>
            </div>
            <div class="v">
                <p><a href="index.php" title="Главная">ГЛАВНАЯ</a></p>
                <p><a href="sign.php" title="Добавить объявление">ДОБАВИТЬ ОБЪЯВЛЕНИЕ</a></p>
                <p><ins><a href="sign.php" title="Вход или регистрация">ВОЙТИ</a><ins></p>
            </div>
        </div>
    </header>

    <?
    // session_start();

    // $login = "admin";
    // $password = "12345";

    // if ($_SESSION['login'] === $login && $_SESSION['password'] === $password){
    //     header('Location: AdminPanel.php');
    // }


?>
        <style>
            main {
                flex-direction: column;
                display: flex;
                height: 80vh;
                justify-content: center;
                align-items: center;
            }
        </style>

        <main>
            <form action="include/regin.php" method="post" class="row g-3 col-md-6" style="width: 400px" ;>
                <h2>Регистрация</h2>
                <div class="col-md-12">
                    <label for="var-title" class="form-label">Логин</label>
                    <input type="text" name="login" class="form-control" id="var-title">
                </div>
                <div class="col-md-12">
                    <label for="var-title" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control" id="var-title">
                </div>
                <div class="col-md-12">
                    <label for="var-title" class="form-label">Повторите пароль</label>
                    <input type="password" name="password2" class="form-control" id="var-title">
                </div>

                <div class="col-md-12" style="display: flex; justify-content: center">
                    <button type="submit" class="btn btn-primary" style="width: 384px">Зарегистрироваться</button>
                </div>

            </form>
        </main>

</html>
</body>

</html>