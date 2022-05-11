<?php
    require "../db.php";
?>
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Восстановление доступа</title>
    <link rel="stylesheet" href="Forgot_1_Style.css">
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
                    <a href="../Auth/Auth.php"><button>
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
            </ul>
        </nav>
                                                <!--Конец шапки-->
                                                <!--Начало контента-->
        <div class="content">
            <form action="forgot_handler.php" method="post">
                <h1 style="color: chocolate">Восстановление доступа</h1>
                <p>Для восстановления доступа к странице введите Ваш логин и почту, после этого нажмите на кнопку "выслать код". На
                    Вашу почту прийдёт сообщение с кодом для восстановления страницы, его нужно будет ввести в следующее окно.
                </p>
                <table width="30%" cellpadding="0" class="tab">
                    <tr>
                        <td width="10%">Логин:</td>
                        <td><input type="text" name="login_forg"></td>
                    </tr>
                    <tr>
                        <td width="10%">Почта:</td>
                        <td><input type="text" name="mail_forg"></td>
                    </tr>
                </table>
                <br>
                <button type="submit" name="to_handler">Выслать код</button>
            </form>
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