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
    <title>На заказ</title>
    <link rel="stylesheet" href="Category_Order_Style.css">
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
                        <li> <a href="#Category_order">На заказ</a> </li>
                    </ul>
                </li>
                <li> <a href="../About_Us/About_Us.php">О нас</a> </li>
                <li> <a href="../Loyaly/Loyaly.php">Лояльность</a> </li>
                <li> <a href="#Category_order">На заказ</a> </li>
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
                    <a href="#" style="background-color: red">На заказ</a>
                </li>
            </ul>
        </div>
                                                <!--Конец шапки-->
                                                <!--Начало контента-->
        <div class="content">

            <div class="order">
                <form action="Cash_order.php" method="get">
                    <a id="Category_order"><h1 style="color: chocolate">На заказ</h1> </a>
                    <p>Оформленные заказы Вы можете забрать в день оформления. Необходимо оформлять заказ в день, когда можете забрать его.</p>
                    <table id="tab" border="1" width="80%">
                        <tr>
                            <td width="30%">Название</td>
                            <td width="20%">Цена</td>
                            <td width="20%">В наличии</td>
                            <td width="10%">Количество</td>
                            <td width="10%"></td>
                        </tr>
                        <?php
                        $orders=R::findAll('desserto');
                        if ($_SESSION['logged_user']['admin']==1)
                        {
                            foreach ($orders as $order)
                            {
                                echo '<tr>';
                                echo '<td><a href="../Item_Category/Item.php?id='.$order->id.'&&cat=desserto"/>' . $order->name . '</td>';
                                echo '<td>'.$order->price.'</td>';
                                echo '<td>'.$order->in_stock.'</td>';
                                echo '<td><input type="number" id="small" name="'.$order->id.'" min="1" max="'.$order->in_stock.'"/></td>';
                                echo '<td> <a href="../Pers_akk_redactions_admin/Pers_akk_redactions_admin.php?id='.$order->id.'&&cat=desserto">Редактировать</a></td>';
                                echo '</tr>';
                            }
                        }
                        else
                        {
                            foreach ($orders as $order)
                            {
                                echo '<tr>';
                                echo '<td><a href="../Item_Category/Item.php?id='.$order->id.'&&cat=desserto"/>' . $order->name . '</td>';
                                echo '<td><a href="../Item_Category/Item.php?id='.$order->id.'&&cat=desserto"/>' . $order->name . '</td>';
                                echo '<td>'.$order->price.'</td>';
                                echo '<td>'.$order->in_stock.'</td>';
                                echo '<td><input type="number" name="'.$order->id.'" min="0" max="'.$order->in_stock.'"/></td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </table>
                    <button name="to_Cart" type="submit">Забронировать</button>
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