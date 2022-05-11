<?php
require "../db.php";
    /*if (!isset($_SESSION['logged_user']))
    {
        header('Location: ../Auth/Auth.php');
    }*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Настройки</title>
    <link rel="stylesheet" href="Pers_akk_properties_Style.css">
</head>
<body>
<a id="top"></a>
<div class="Upper">
    <a href="#top">
        <button>
            Наверх
        </button>
    </a>
</div>
    <div class="wrapper">
                                                <!--Начало шапки-->
        <div class="users">
            <table width="100%">
                <td>
                    <?php
                    if (isset($_SESSION['logged_user'])) {
                        $im = base64_encode($_SESSION['logged_user']['image']);
                        echo '<img src="data:image/jpeg;base64,' . $im . '" width="50" height="50" align="left" hspace="10px" />';
                        echo '<strong>Пользователь</strong> <br>';
                        echo '<p>' . $_SESSION['logged_user']['name'] . '</p>';
                    }
                    ?>
                </td>
                <form action="../Auth/LogOut.php" method="post">
                    <td align="right">
                        <button name="LogOut" type="submit">
                            Выйти
                        </button>
                    </td>
                </form>
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
                <li> <a href="../Pers_akk_profile/Pers_akk_profile.php">Личный кабинет</a> </li>
            </ul>
        </nav>
        <div class="bread">
            <ul>
                <li>
                    <a href="../Index/Index.php">Главное меню</a>
                    <a href="../Pers_akk_profile/Pers_akk_profile.php">Личный кабинет</a>
                    <a href="#" style="background: red">Настройки</a>
                </li>
            </ul>
        </div>
                                                <!--Конец шапки-->
                                                <!--Начало контента-->
        <div class="content">
            <div class="left">
                <ul class="pers_menu">
                    <li> <a href="../Pers_akk_profile/Pers_akk_profile.php">Профиль</a> </li>
                    <li> <a href="../Pers_akk_history/Pers_akk_history.php">История</a> </li>
                    <li> <a href="../Pers_akk_bonus/Pers_akk_bonus.php">Бонусы</a> </li>
                    <li> <a href="#" style="background: red">Настройки</a> </li>
                </ul>
            </div>
            <div class="right">
                <form action="../Pers_akk_properties_admin/properties.php" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($_SESSION['logged_user'])) {
                        $im = base64_encode($_SESSION['logged_user']['image']);
                        echo '<img src="data:image/jpeg;base64,' . $im . '" width="70" height="70" align="left" hspace="10px" />';
                    }
                    ?>
                    <table class="tab">
                        <tr>
                            <td>Логин:</td>
                            <td><input type="text" name="login" value="<?php echo @$_SESSION['logged_user']['login']?>"></td>
                            <td align="center"><button style="width: 100px; height: 30px; padding: 0"  name="update_login" type="submit">Изменить</button></td>
                        </tr>
                        <tr>
                            <td>Имя:</td>
                            <td><input type="text" name="name"value="<?php echo @$_SESSION['logged_user']['name']?>"></td>
                            <td align="center"><button style="width: 100px; height: 30px; padding: 0"  name="update_name" type="submit">Изменить</button></td>
                        </tr>
                        <tr>
                            <td>Мобильный:</td>
                            <td><input type="text" name="phone" value="<?php echo @$_SESSION['logged_user']['phone']?>"></td>
                            <td align="center"><button style="width: 100px; height: 30px; padding: 0"  name="update_number" type="submit">Изменить</button></td>
                        </tr>
                        <tr>
                            <td>Почта:</td>
                            <td><input type="text" name="email" value="<?php echo @$_SESSION['logged_user']['email']?>"></td>
                            <td align="center"><button style="width: 100px; height: 30px; padding: 0" name="update_email" type="submit">Изменить</button></td>
                        </tr>
                        <tr>
                            <td>День рождения:</td>
                            <td><input type="date" name="date" value="<?php echo @$_SESSION['logged_user']['date_born']?>"></td>
                            <td align="center"><button style="width: 100px; height: 30px; padding: 0"  name="update_date" type="submit">Изменить</button></td>
                        </tr>
                        <tr>
                            <td>Адрес:</td>
                            <td><input type="text" name="address" value="<?php echo @$_SESSION['logged_user']['address']?>" ></td>
                            <td align="center"><button style="width: 100px; height: 30px; padding: 0"  name="update_address" type="submit">Изменить</button></td>
                        </tr>
                        <tr>
                            <td>Изображение:</td>
                            <td><input type="file" name="image" accept="image/*"></td>
                            <td align="center"><button style="width: 100px; height: 30px; padding: 0"  name="update_image" type="submit">Изменить</button></td>
                        </tr>
                        <tr>
                            <td>Старый пароль:</td>
                            <td><input type="password" name="old_pass"></td>
                        </tr>
                        <tr>
                            <td>Новый пароль:</td>
                            <td><input type="password" name="new_pass"></td>
                        </tr>
                        <tr>
                            <td>Повторите пароль:</td>
                            <td><input type="password" name="temp_pass"></td>
                            <td align="center"><button style="width: 100px; height: 30px; padding: 0"  name="update_password" type="submit">Изменить</button></td>
                        </tr>
                    </table>
                    <input type="hidden" name="token" value="<?php echo $_SESSION["token"]?>">
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