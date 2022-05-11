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
    <title>Ответы</title>
    <link rel="stylesheet" href="Pers_akk_faq_admin_style.css">
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
                <li> <a href="../Pers_akk_profile_admin/Pers_akk_profile_admin.php">Личный кабинет</a> </li>
            </ul>
        </nav>
        <div class="bread">
            <ul>
                <li>
                    <a href="../Index/Index.php">Главное меню</a>
                    <a href="../Pers_akk_profile_admin/Pers_akk_profile_admin.php" >Личный кабинет</a>
                    <a href="#" style="background-color: red">Ответы на вопросы</a>
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
                    <li> <a href="../Pers_akk_redactions_admin/Pers_akk_redactions_admin.php">Изменение</a> </li>
                    <li> <a href="#" style="background-color: red">Ответы</a> </li>
                    <li> <a href="../Pers_akk_orders_admin/Pers_akk_orders_admin.php">Заказы</a> </li>
                </ul>
            </div>
            <div class="right">
                <form action="faq_answer.php" method="post">
                    <h1 style="color: chocolate">Ваши вопросы - наши ответы</h1>
                    <table width="100%" border="1" class="tab">
                        <tr>
                            <td width="10%">Дата</td>
                            <td width="10%">Пользователь</td>
                            <td width="10%">Номер вопроса</td>
                            <td width="20%">Вопрос</td>
                            <td width="20%">Ответ</td>
                        </tr>
                        <?php
                            $faq_table=R::findAll('faq');
                            foreach ($faq_table as $faq)
                            {
                                echo '<tr>';
                                echo '<td>'.$faq->date.'</td>';
                                echo '<td>'.$faq->user.'</td>';
                                echo '<td>'.$faq->id.'</td>';
                                echo '<td>'.$faq->question.'</td>';
                                echo '<td>'.$faq->answer.'</td>';
                                //echo '<td><input type="text" maxlength="100" name="req"></td>';
                                //echo '<td align="center"><button style="width: 100px; height: 30px; padding: 0" name="'.$faq->id.'">Ответить</button></td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                            echo '<br>';
                            echo '<input name="questions" list="questions" placeholder="Выберите вопрос"/>';
                            echo '<datalist id="questions">';

                            foreach ($faq_table as $faq)
                            {
                                echo '<option value="'.$faq->id.'" />';
                            }

                            echo '</datalist> <br> <br>';

                        ?>
                        <textarea name="area_answer" placeholder="Введите ответ"></textarea> <br> <br>
                        <button name="add_answer" type="submit" style="width: 100px; height: 30px; padding: 0; margin-left: 0">Ответить</button>
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