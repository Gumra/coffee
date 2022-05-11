<?php
    require "../db.php";

    $id=$_GET['id'];
    $category=$_GET['cat'];

    $item=R::load($category,$id);

    $name=$item->name;
    $category_name=null;
    $path_category=null;

    switch ($category)
    {
        case "drinks": {$category_name='Напитки'; $path_category="../Category_Drinks/Category_Drinks.php";break;}
        case "dessert": {$category_name='Десерты'; $path_category="../Category_Dessert/Category_Dessert.php";break;}
        case "desserto": {$category_name='На заказ'; $path_category="../Category_Order/Category_Order.php";break;}
    }

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
    <title><?php echo $item->name?></title>
    <link rel="stylesheet" href="Item_Style.css">
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
        <div class="bread">
            <ul>
                <li>
                    <?php
                    echo '<a href="../Index/Index.php">Главное меню</a>';
                    echo '<a href="../Menu/Menu.php">Меню</a>';
                    echo '<a href="'.$path_category.'">'.$category_name.'</a>';
                    echo '<a href="#" style="background-color: red">'.$item->name.'</a>';
                    ?>
                </li>
            </ul>
        </div>
                                                <!--Конец шапки-->
                                                <!--Начало контента-->
        <div class="content">
            <?php
                echo '<h1 style="color: chocolate">'.$item->name.'</h1>';
                echo '<br>';
                $im = base64_encode($item->image);
                echo '<img src="data:image/jpeg;base64,'.$im .'" align="left" width="200" height="200" hspace="10px" />';
                echo '<p>'.$item->description.'</p><br>';
                echo '<strong style="color: red">Цена: '.$item->price.'</strong>';
            ?>

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