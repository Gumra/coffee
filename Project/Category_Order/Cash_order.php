<?php
require "../db.php";
$status=null;
$user=null;
$form=null;

if (isset($_SESSION['logged_user']))
{
    if ($_SESSION['logged_user']['admin']==1)
    {
        $status='Администратор';
        $user=$_SESSION['logged_user']['name'];
        $form=2;
    }
    if ($_SESSION['logged_user']['admin']!=1)
    {
        $status='Пользователь';
        $user=$_SESSION['logged_user']['name'];
        $form=2;
    }
    $data_order=$_GET;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Бронирование заказа</title>
    <link rel="stylesheet" href="Cash_order.css">
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

                if (strcmp($status,'Администратор')==0)
                {
                    $im = base64_encode($_SESSION['logged_user']['image']);
                    echo '<img src="data:image/jpeg;base64,' . $im . '" width="50" height="50" align="left" hspace="10px" />';
                    echo '<strong>Администратор</strong> <br>';
                    echo '<p>' . $_SESSION['logged_user']['name'] . '</p>';
                }
                if (strcmp($status,'Пользователь')==0)
                {
                    $im = base64_encode($_SESSION['logged_user']['image']);
                    echo '<img src="data:image/jpeg;base64,' . $im . '" width="50" height="50" align="left" hspace="10px" />';
                    echo '<strong>Пользователь</strong> <br>';
                    echo '<p>' . $_SESSION['logged_user']['name'] . '</p>';
                }
                ?>
            </td>
            <?php
            if ($form==1)
            {
                echo '<form action="../Auth/Auth.php" method="post">';
                echo '<td align="right">';
                echo '<button type="submit">Войти</button>';
                echo '</td>';
                echo '</form>';
            }
            ?>
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
            <?php
            if (strcmp($status,'Администратор')==0)
            {
                echo '<li> <a href="../Pers_akk_profile_admin/Pers_akk_profile_admin.php">Личный кабинет</a> </li>';
            }
            elseif (strcmp($status, 'Пользователь')==0)
            {
                echo '<li> <a href="../Pers_akk_profile/Pers_akk_profile.php">Личный кабинет</a> </li>';
            }
            else
            {
                echo '<li> <a href="../Auth/Auth.php">Войти</a> </li>';
            }
            ?>
        </ul>
    </nav>

    <!--Конец шапки-->
    <!--Начало контента-->
    <div class="content">
        <form action="Order_handler.php" method="post">
            <h1 style="color: chocolate">Бронирование заказа</h1>
            <div class="left">
                <table cellspacing="10px" style="color: var(--color-font)">
                    <tr>
                        <td>Логин:</td>
                        <td><input id="id_user" type="text" value="<?php echo @$_SESSION['logged_user']['login'];?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Имя:</td>
                        <td><input id="id_user" type="text" value="<?php echo @$_SESSION['logged_user']['name'];?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Мобильный:</td>
                        <td><input id="id_user" type="text" value="<?php echo @$_SESSION['logged_user']['phone'];?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Почта:</td>
                        <td><input id="id_user" type="text" value="<?php echo @$_SESSION['logged_user']['email'];?>" readonly></td>
                    </tr>
                    <tr>
                        <td>День рождения:</td>
                        <td><input id="id_user" type="date" value="<?php echo @$_SESSION['logged_user']['date_born'];?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Адрес:</td>
                        <td><input id="id_user" type="text" value="<?php echo @$_SESSION['logged_user']['address'];?>" readonly></td>
                    </tr>
                </table>
            </div>
            <div class="right">
                <?php

                $new_order = array_diff($data_order, array(''));

                $orders_keys=array_keys($new_order);

                $order_array=array();

                $orders=R::loadAll('desserto', $orders_keys);

                foreach ($orders as $order)
                {
                    $order_array["temp"]["name"][]=$order->name;
                    $order_array["temp"]["price"][]=$order->price;
                    $order_array["temp"]["stock"][]=$new_order[$order->id];
                    $order->in_stock=$order->in_stock-$new_order[$order->id];
                    R::store($order);
                }

                $total=0;
                $names=null;
                $stocks=null;
                $prices=null;

                foreach ($order_array["temp"]["price"] as $key => $oa)
                {
                    $total+=(int)$oa*(int)$order_array["temp"]["stock"][$key];
                    $names.=$order_array["temp"]["name"][$key].";";
                    $stocks.=$order_array["temp"]["stock"][$key].";";
                    $prices.=$oa.";";
                }
                if ($_SESSION['logged_user']['code_tort'])
                {
                    $total=(int)$total*0.85;
                }
                $_SESSION['names']=$names;
                $_SESSION['stocks']=$stocks;
                $_SESSION['prices']=$prices;
                $_SESSION['total']=(int)$total*0.5;


                echo "<table width='30%' border='1'>";
                echo "<tr>";
                echo "<th width='30%'>Стоимость брони</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>".(int)$total*0.5."</td>";
                echo "</tr>";
                echo "</table>";
                ?>
                <br>
                <table width="100%" cellspacing="10">
                    <tr>
                        <td><strong>Выберите способ оплаты:</strong></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" >Банковская карта</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" checked>Webmoney</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox">Qiwi</td>
                    </tr>
                </table>
                <br>
                <button name="add_cart" type="submit" style="width: 120px; height: 30px; padding: 0; margin-left: 0">Забронировать</button>
            </div>

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
