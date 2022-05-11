<?php
    require "../db.php";
    $status=null;
    $user=null;
    $form=null;
    if (!isset($_SESSION['logged_user']))
    {
        $status='Неавторизированный';
        $form=1;
    }
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
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>О нас</title>
    <link rel="stylesheet" href="About_Us_style.css">
</head>
<body>
<div class="wrapper">
    <a id="top"></a>
    <div class="Upper">
        <a href="#top">
            <button>
                Наверх
            </button>
        </a>
    </div>                                                       <!--Начало шапки-->
    <div class="users">
        <table width="100%">
            <td>
                <?php
                    if (strcmp($status,'Неавторизированный')==0)
                    {
                        echo '<img src="../Index/image_index/unauth.png" width="50" height="50" align="left" hspace="10px" />';
                        echo '<strong>Пользователь</strong> <br>';
                        echo '<p>Не авторизирован</p>';
                    }
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
                else
                {
                    echo '<form action="../Auth/LogOut.php" method="post">';
                    echo '<td align="right">';
                    echo '<button type="submit" name="LogOut">Выйти</button>';
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
            <li> <a href="#About_us">О нас</a> </li>
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
    <div class="bread">
        <ul>
            <li>
                <a href="../Index/Index.php">Главное меню</a>
                <a href="#" style="background-color: red" >О нас</a>
            </li>
        </ul>
    </div>
                                                                    <!--Конец шапки-->
                                                                    <!--Начало контента-->
    <div class="content">
        <a id="About_us"><h1 style="color: chocolate">Кофейня Coffee House</h1> </a>
        <p>Хорошее утро начинается с хорошего кофе. Мы - новая и процветающая кофейня, которая может
            это Вам предоставить. Мы выбираем самые лучше сорта кофе для вашего напитка. Каждый наш
            бариста - мастер своего дела, который любит и ценит свою работу. Так же, помимо кофе есть
            десерты и возможность приобрести тортики на заказ. Сделай утро ярче, заходи в нашу кофейню.</p>
        <a id="Contact"><h3>Контакты</h3></a>
        <p>
            <strong>Служба Поддержки Гостей</strong> <br>
            Обращайтесь по телефону 8 (923) 632-1072 и 8 (951) 617-5276 ежедневно с 9:30 до 20:30 или на
            почту coffee_house.com в любое время.
        </p>
        <p>
            <strong>Работа у нас</strong> <br>
            8 (908) 954-3327
            job.coffee_house.com
        </p>
        <p>
            <strong>Менеджер по работе с корпоративными клиентами</strong> <br>
            Екатерина Курбангулова
            8 (908) 954-3327
            Eg_corp@alshaya.com
        </p>
        <p>
            <strong>Реклама</strong> <br>
            8 (908) 954-3327
        </p>

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
                    <a href="#Contact"><button style="width: 200px"> Контакты </button></a>
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