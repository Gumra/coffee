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
    <title>Корзина</title>
    <link rel="stylesheet" href="Cart_style.css">
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
    <div class="wrapper">                                                <!--Начало шапки-->
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
                    <a href="#">
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
                    <a href="#" style="background-color: red">Корзина</a>
                </li>
            </ul>
        </div>
                                                <!--Конец шапки-->
                                                <!--Начало контента-->
        <div class="content">
            <form action="" method="get">
                    <?php
                        $array_find=array($_SESSION['logged_user']['name'],0);
                        $orders=R::findAll('orders','user=? && status=?',$array_find);
                        if (!empty($orders)) {
                            echo '<table width="100%" border="1">';
                            foreach ($orders as $order) {
                                echo '<tr>';
                                echo '<th colspan="7">Дата</th>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<th colspan="7">' . $order->date . '</th>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<th>Название</th>';
                                echo '<th>Стоимость</th>';
                                echo '<th>Количество</th>';
                                echo '<th width="10%">Итого</th>';
                                echo '<th width="10%">Итого со скидкой</th>';
                                echo '<th width="10%">Оформление</th>';
                                echo '<th width="10%">Удаление</th>';
                                echo '</tr>';
                                $array_names = explode(";", $order->names);
                                $array_prices = explode(";", $order->prices);
                                $array_stocks = explode(";", $order->stocks);

                                foreach ($array_names as $key => $an) {
                                    echo '<tr>';
                                    echo '<td>' . $an . '</td>';
                                    echo '<td>' . $array_prices[$key] . '</td>';
                                    echo '<td>' . $array_stocks[$key] . '</td>';
                                }
                                echo '<td>' . $order->total . '</td>';
                                echo '<td>' . $order->total_lol . '</td>';
                                echo '<td> <a href="Cart_handler.php?id=' . $order->id . '&&act=add">Оформить</a></td>';
                                echo '<td> <a href="Cart_handler.php?id=' . $order->id . '&&act=del">Удалить</a></td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                        }
                        else
                        {
                            echo '<h3>У вас пока нет заказов</h3>';
                            echo '<h3>Сделать заказ можете <a href="../Category_Order/Category_Order.php">здесь:</a></h3>';
                        }
                    ?>
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