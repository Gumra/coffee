<?php
    require "../db.php"
?>
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="Auth_Style.css">
</head>
<body>

    <div class="wrapper">
                                                <!--Начало шапки-->
        <div class="users">

            <table width="100%">
                <td>
                    <img src="../Index/image_index/unauth.png" height="50" width="50" align="left" hspace="5px">
                    <strong>Пользователь</strong> <br>
                    <label id="label_user">Не авторизирован</label>
                </td>
                <td align="right">
                    <a href="#"><button>
                        Войти
                    </button></a>
                </td>
            </table>

        </div>
        <div class="logo">
            <table width="100%">
                <td>
                    <img src="../Index/image_index/logo.png" height="70" width="70" align="left" hspace="5px">
                    <h1 style="color: chocolate">Кофейня Coffee House</h1>
                </td>
                <td align="right">
                    <a href="../Cart/Cart.php">
                        <img src="../Index/image_index/cart.jpg" height="70" width="70">
                    </a>
                </td>
            </table>
        </div>
        <nav class="menu">
            <ul class="parent">
                <li>
                    <a href="../Menu/Menu.php">Меню</a>
                    <ul>
                        <li> <a href="../Category_Drinks/Category_Drinks.php">Напитки</a> </li>
                        <li> <a href="../Category_Dessert/Category_Dessert.php">Десерты</a> </li>
                        <li> <a href="../Category_Order/Category_Order.php">На заказ</a> </li>
                    </ul>
                </li>
                <li> <a href="../About_Us/About_Us.php">О нас</a> </li>
                <li> <a href="../Loyaly/Loyaly.php">Лояльность</a> </li>
                <li> <a href="../Category_Order/Category_Order.php">На заказ</a> </li>
                <li> <a href="#">Войти</a> </li>
            </ul>
        </nav>
                                                <!--Конец шапки-->
                                                <!--Начало контента-->
        <div class="content">
            <div class="left">
                <form action="Login.php" method="post">
                    <h1 style="color: chocolate">Войти</h1>
                    <table width="100%" cellpadding="0" class="tab1">
                        <tr>
                            <td width="10%">Логин:</td>
                            <td><input type="text" name="login_auth" value="<?php echo @$_SESSION['user_login']['login_auth']; ?>"></td>
                        </tr>
                        <tr>
                            <td width="10%">Пароль:</td>
                            <td><input type="password" name="password_auth"></td>
                        </tr>
                    </table>
                    <br>
                    <button type="submit" name="login">Войти</button>
                    <button type="submit" name="forgot">Забыли пароль?</button>
                    <?php
                    unset($_SESSION['user_login']);
                    if (isset($_SESSION['errors_login']))
                    {
                        echo '<p class="msg">'.$_SESSION['errors_login'].'</p>';
                        echo '<br>';
                        unset($_SESSION['errors_login']);
                    }
                    ?>
                </form>
            </div>

            <div class="right">
                <form action="SignUP.php" method="post" enctype="multipart/form-data">
                    <h1 style="color: chocolate">Регистрация</h1>
                    <table width="100%" cellpadding="0" class="tab2">
                        <tr>
                            <td width="10%">Имя:</td>
                            <td><input type="text" name="name_reg" value="<?php echo @$_SESSION['user']['name_reg']; ?>"></td>
                        </tr>
                        <tr>
                            <td width="10%">Логин:</td>
                            <td><input type="text" name="login_reg" value="<?php echo @$_SESSION['user']['login_reg']; ?>"></td>
                        </tr>
                        <tr>
                            <td width="10%">Пароль:</td>
                            <td><input type="password" name="password_reg"></td>
                        </tr>
                        <tr>
                            <td width="10%">Аватарка:</td>
                            <td><input type="file" name="image" accept="image/*"></td>
                        </tr>
                        <tr>
                            <td width="10%">Мобильный:</td>
                            <td><input type="text" name="number_reg" value="<?php echo @$_SESSION['user']['number_reg']; ?>"></td>
                        </tr>
                        <tr>
                            <td width="10%">Почта:</td>
                            <td><input type="email" name="mail_reg" value="<?php echo @$_SESSION['user']['mail_reg']; ?>"></td>
                        </tr>
                        <tr>
                            <td width="10%">День рождения:</td>
                            <td><input type="date" name="birthday_reg" value="<?php echo @$_SESSION['user']['birthday_reg']; ?>"></td>
                        </tr>
                        <tr>
                            <td width="10%">Адрес:</td>
                            <td><input type="text" name="address_reg" value="<?php echo @$_SESSION['user']['address_reg']; ?>"></td>
                        </tr>
                    </table>
                    <br>
                    <button type="submit" name="sign">Регистрация</button>
                    <br>
                    <?php
                        unset($_SESSION['user']);
                        if (isset($_SESSION['errors']))
                        {
                            echo '<p class="msg">'.$_SESSION['errors'].'</p>';
                            echo '<br>';
                        }
                        unset($_SESSION['errors'])
                    ?>
                </form>
            </div>

        </div>
                                                            <!--Конец контента-->
                                                            <!--Начало подвала-->
        <div class="footer">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <strong>Мы в социальных сетях:</strong> <br>
                        <a href="https://ru-ru.facebook.com/"> <img src="../Index/image_index/logoFacebook.png" width="50" height="50" vspace="10"> </a>
                        <a href="https://twitter.com/?lang=ru"> <img src="../Index/image_index/logoTwitter.png" width="50" height="50" vspace="10" hspace="22"> </a>
                        <a href="https://vk.com/id220492653"> <img src="../Index/image_index/logoVK.png" width="50" height="50" vspace="10"> </a>
                    </td>
                    <td align="right">
                        <a href="../Comments/Comments.php"><button style="width: 200px"> Отзывы </button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="../About_Us/About_Us.php#Contact"><button style="width: 200px"> Контакты </button></a>
                    </td>
                    <td align="right">
                        <a href="../FaQ/FaQ.php"><button style="width: 200px"> Вопросы </button></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>