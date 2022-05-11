<?php
    require '../db.php';

    $data_loyaly=$_POST;
    var_dump($_POST);

    $user=R::findOne('profiles','name = ?',array($_SESSION['logged_user']['name']));
    $user=R::load('profiles',$user->id);

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

    if (isset($data_loyaly['add']))
    {
        $service=$data_loyaly["add"];
        if ($service==1)
        {
            if (empty($user->code_menu))
            {
                $code_menu=substr(str_shuffle($permitted_chars), 0, 10);
                $user->code_menu=$code_menu;
                $_SESSION['logged_user']['code_menu']=$code_menu;
            }
        }
        elseif ($service==2)
        {
            if (empty($user->code_tort))
            {
                $code_tort=substr(str_shuffle($permitted_chars), 0, 10);
                $user->code_tort=$code_tort;
                $_SESSION['logged_user']['code_tort']=$code_tort;
            }
        }
        R::store($user);
        header('Location: Loyaly.php');
    }
    elseif (isset($data_loyaly['del']))
    {
        header('Location: Loyaly.php');
    }

