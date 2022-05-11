<?php
    require '../db.php';

    $data_faq=$_POST;

    $user=null;

    if (isset($data_faq['faq']))
    {
        if (!empty($data_faq['area_faq']))
        {
            if (!empty($_SESSION['logged_user']))
            {
                $user=$_SESSION['logged_user']['name'];
            }
            else
            {
                $user='Неизвестный';
            }

            $date=date('Y-m-d');

            $bd_faq=R::dispense('faq');
            $bd_faq->date=$date;
            $bd_faq->user=$user;
            $bd_faq->question=htmlentities(strval($data_faq['area_faq']));
            R::store($bd_faq);
            header('Location: FaQ.php');
        }
    }
