<?php
    require "../db.php";

    if (!isset($_SESSION['logged_user']))
    {
        header('Location: ../Auth/Auth.php');
    }
    $find_admin=R::load("profiles", $_SESSION["logged_user"]["id"]);
    if (!$find_admin->admin)
    {
        header('Location: ../Pers_akk_profile/Pers_akk_profile.php');
    }

    if (!empty($_GET['cat'])) {
        $category = $_GET['cat'];
        $category_rus = null;
        switch ($category) {
            case 'drinks':
            {
                $category_rus = 'Напитки';
                break;
            }
            case 'dessert':
            {
                $category_rus = 'Десерты';
                break;
            }
            case 'desserto':
            {
                $category_rus = 'На заказ';
                break;
            }
        }
        $id = $_GET['id'];
        $item = R::load($category, $id);
    }
?>
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Изменение</title>
    <link rel="stylesheet" href="Pers_akk_redactions_admin_style.css">
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
                    echo '<strong>Администратор</strong> <br>';
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
                <li> <a href="#">Личный кабинет</a> </li>
            </ul>
        </nav>
        <div class="bread">
            <ul>
                <li>
                    <a href="../Index/Index.php">Главное меню</a>
                    <a href="../Pers_akk_profile_admin/Pers_akk_profile_admin.php">Личный кабинет</a>
                    <a href="#" style="background-color: red">Изменение</a>
                </li>
            </ul>
        </div>
                                                <!--Конец шапки-->
                                                <!--Начало контента-->
        <div class="content">
            <div class="left">
                <ul class="pers_menu">
                    <li> <a href="../Pers_akk_profile_admin/Pers_akk_profile_admin.php">Профиль</a> </li>
                    <li> <a href="../Pers_akk_history_admin/Pers_akk_history_admin.php">История</a> </li>
                    <li> <a href="../Pers_akk_bonus_admin/Pers_akk_bonus_admin.php">Бонусы</a> </li>
                    <li> <a href="../Pers_akk_properties_admin/Pers_akk_properties_admin.php">Настройки</a> </li>
                    <li> <a href="../Pers_akk_users_admin/Pers_akk_users_admin.php">Аккаунты</a> </li>
                    <li> <a href="#" style="background-color: red">Изменение</a> </li>
                    <li> <a href="../Pers_akk_faq_admin/Pers_akk_faq_admin.php">Ответы</a> </li>
                    <li> <a href="../Pers_akk_orders_admin/Pers_akk_orders_admin.php">Заказы</a> </li>
                </ul>
            </div>
            <div class="right">
                <form action="Red.php" method="post" enctype="multipart/form-data">
                    <input name="categories" list="categories" placeholder="Выберите категорию" value="<?php echo $category_rus;?>"/>
                    <datalist id="categories">
                        <option value="Напитки" />
                        <option value="Десерты" />
                        <option value="На заказ" />
                    </datalist>
                    <br> <br>
                    <input type="text" name="name" placeholder="Название" value="<?php echo $item->name;?>"> <br> <br>

                    <?php
                        echo '<textarea name="area_description" placeholder="Описание"">'.$item->description.'</textarea> <br> <br>';
                    ?>

                    <input type="number" name="price" placeholder="Цена" min="0" value="<?php echo $item->price;?>"> <br> <br>
                    <input type="number" name="in_stock" placeholder="Наличие" min="0" value="<?php echo $item->in_stock;?>"> <br> <br>
                    <input type="file" name="image" accept="image/*"><br> <br>
                    <button name="delete_this" type="submit" style="width: 100px; height: 30px; padding: 0; margin-left: 20px">Удалить</button>
                    <br><br>
                    <button name="update_this" type="submit" style="width: 100px; height: 30px; padding: 0; margin-left: 20px">Изменить</button>
                    <br><br>
                    <button name="add_this" type="submit" style="width: 100px; height: 30px; padding: 0; margin-left: 20px">Добавить</button>
                    <br><br>

                    <?php
                    if ($_SESSION['errors'])
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