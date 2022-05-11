<?php
require "../db.php";
if (!isset($_SESSION['logged_user']))
{
    header('Location: ../Auth/Auth.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Лояльность</title>
    <link rel="stylesheet" href="Loyaly_style.css">
</head>
<body>
    <div class="wrapper">
        <!--Начало шапки-->
        <div class="users">
            <table width="100%">
                <td>
                    <?php
                    if (isset($_SESSION['logged_user'])) {
                        $im = base64_encode($_SESSION['logged_user']['image']);
                        echo '<img src="data:image/jpeg;base64,' . $im . '" width="50" height="50" align="left" hspace="10px" />';
                        if ($_SESSION['logged_user']['admin']==1)
                        {
                            echo '<strong>Администратор</strong> <br>';
                        }
                        else
                        {
                            echo '<strong>Пользователь</strong> <br>';
                        }
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
            <li> <a href="#">Лояльность</a> </li>
            <li> <a href="../Category_Order/Category_Order.php">На заказ</a> </li>
            <?php
            if ($_SESSION['logged_user']['admin']==1)
            {
                echo '<li> <a href="../Pers_akk_profile_admin/Pers_akk_profile_admin.php">Личный кабинет</a> </li>';
            }
            else
            {
                echo '<li> <a href="../Pers_akk_profile/Pers_akk_profile.php">Личный кабинет</a> </li>';
            }
            ?>
        </ul>
    </nav>
        <div class="bread">
            <ul>
                <li>
                    <a href="../Index/Index.php">Главное меню</a>
                    <a href="#" style="background-color: red">Лояльность</a>
                </li>
            </ul>
        </div>
                                                <!--Конец шапки-->
                                                <!--Начало контента-->
        <div class="content">
            <form action="Cash.php" method="post">
                <a id="Loyaly"><h1 style="color: chocolate">Наши скидки</h1></a>
                <p>Скидка 10% на меню в Ваш день рождения (при предъявлении паспорта на кассе)</p>
                <h3>Для зарегистрированных пользователей</h3>
                <p>При покупке 6 напитков, 7 напиток в подарок</p>
                <p>Имеется возможность приобрести купоны на скидку:</p>
                <table width="50%">
                    <tr>
                        <td><p>Для заказов тортов скидка 15%</p></td>
                        <td><Button name="code_tort" type="submit">Оформить</Button></td>
                    </tr>
                    <tr>
                        <td><p>Скидка 15% на всё меню</p></td>
                        <td><Button name="code_menu" type="submit">Оформить</Button></td>
                    </tr>
                </table>
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