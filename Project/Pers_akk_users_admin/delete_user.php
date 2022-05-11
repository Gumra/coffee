<?php
    require '../db.php';
    $id=strval(key($_GET));

    $id_current_user=$_SESSION['logged_user']['id'];

    $delete = R::load('profiles', $id);

    if (strcmp($id,$id_current_user)!=0 && $delete->admin!=1)
    {
        $del_history=R::findAll('history','user=?',array($delete->name));
        foreach ($del_history as $dh)
        {
            R::trash($dh);
        }

        $del_orders=R::findAll('orders','user=?',array($delete->name));
        foreach ($del_orders as $do)
        {
            R::trash($do);
        }
        R::trash($delete);
        header('Location: Pers_akk_orders_admin.php');
    }
    else
    {
        header('Location: Pers_akk_orders_admin.php');
    }