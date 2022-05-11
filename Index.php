<?php
require "Project/db.php";
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
    <title>Кофейня "Coffee House"</title>
    <link rel="stylesheet" href="Project/Index/Main_style.css">
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
                    if (strcmp($status,'Неавторизированный')==0)
                    {
                        echo '<img src="Project/Index/image_index/unauth.png" width="50" height="50" align="left" hspace="10px" />';
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
                    echo '<form action="Project/Auth/Auth.php" method="post">';
                    echo '<td align="right">';
                    echo '<button type="submit">Войти</button>';
                    echo '</td>';
                    echo '</form>';
                }
                else
                {
                    echo '<form action="Project/Auth/LogOut.php" method="post">';
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
                    <img src="Project/Index/image_index/logo.png" height="70" width="70" align="left" hspace="5px">
                    <h1 style="color: chocolate">Кофейня Coffee House</h1>
                </td>
                <td align="right">
                    <a href="Project/Cart/Cart.php">
                        <img src="Project/Index/image_index/cart.jpg" height="70" width="70">
                    </a>
                </td>
            </table>
        </div>
        <nav class="menu">
            <ul class="parent">
                <li>
                    <a href="Project/Menu/Menu.php">Меню</a>
                    <ul>
                        <li> <a href="Project/Category_Drinks/Category_Drinks.php">Напитки</a> </li>
                        <li> <a href="Project/Category_Dessert/Category_Dessert.php">Десерты</a> </li>
                        <li> <a href="Project/Category_Order/Category_Order.php">На заказ</a> </li>
                    </ul>
                </li>
                <li> <a href="Project/About_Us/About_Us.php">О нас</a> </li>
                <li> <a href="Project/Loyaly/Loyaly.php">Лояльность</a> </li>
                <li> <a href="Project/Category_Order/Category_Order.php">На заказ</a> </li>
                <?php
                if (strcmp($status,'Администратор')==0)
                {
                    echo '<li> <a href="Project/Pers_akk_profile_admin/Pers_akk_profile_admin.php">Личный кабинет</a> </li>';
                }
                elseif (strcmp($status, 'Пользователь')==0)
                {
                    echo '<li> <a href="Project/Pers_akk_profile/Pers_akk_profile.php">Личный кабинет</a> </li>';
                }
                else
                {
                    echo '<li> <a href="Project/Auth/Auth.php">Войти</a> </li>';
                }
                ?>
            </ul>
        </nav>

                                                <!--Конец шапки-->
                                                <!--Начало контента-->
        <div class="content">
           <div class="description">
               <p>
                   <cite> Coffee House </cite> - кофейня, которая перевернёт ваше понимание о кофе, десертах и тортиках.
                   Совсем недавно, мы открылись по адресу Нарвский проспект, дом 16. Здесь вас ждёт отличное
                   обслуживание и незабываемая атмосфера уюта. Спешите нас посетить, в первой половине дня
                   действует скидка 10% на всё меню.
               </p>
           </div>
            <div class="season_one">
                <h1>Наши сезонные напитки</h1>
                <h3>Раф с облепихой</h3>
                <img src="Project/Index/image_index/raf_obl.jpg" height="205" width="205" align="left" hspace="10px" vspace="5px"></a>
                <p> Раф(облепиха) - мы добавляем натуральный ягодный сироп во всеми
                    полюбившийся напиток, который как раз кстати в дождливые осенние
                    деньки. (На выбор предлагается также светлая и средняя обжарка)</p>
            </div>
            <div class="season_two">
                <h3>Латте ягодный</h3>
                <img src="Project/Index/image_index/latte_berry.jpg" height="205" width="205" align="left" hspace="10px" vspace="5px"></a>
                <p> Латте ягодный - насыщенный напиток венской обжарки с ярким ягодным
                    сочетанием. Когда хочется что-то тёплое и летнее одновременно</p>
            </div>
        </div>
                                                            <!--Конец контента-->
                                                            <!--Начало подвала-->
        <div class="footer">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <strong>Мы в социальных сетях:</strong> <br>
                        <a href="https://ru-ru.facebook.com/"> <img src="Project/Index/image_index/logoFacebook.png" width="50" height="50" vspace="10"> </a>
                        <a href="https://twitter.com/?lang=ru"> <img src="Project/Index/image_index/logoTwitter.png" width="50" height="50" vspace="10" hspace="22"> </a>
                        <a href="https://vk.com/id220492653"> <img src="Project/Index/image_index/logoVK.png" width="50" height="50" vspace="10"> </a>
                    </td>
                    <td align="right">
                        <a href="Project/Comments/Comments.php"><button style="width: 200px"> Отзывы </button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="Project/About_Us/About_Us.php#Contact"><button style="width: 200px"> Контакты </button></a>
                    </td>
                    <td align="right">
                        <a href="Project/FaQ/FaQ.php"><button style="width: 200px"> Вопросы </button></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>