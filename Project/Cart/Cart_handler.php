<?php
    require '../db.php';
    require_once 'Mail_Cart.php';
    $id=$_GET['id'];
    $act=$_GET['act'];
    $order=R::findOne('orders',$id);

    if (strcmp($act,'add')==0)
    {
        $h_add=R::dispense('history');
        $date=date("Y-m-d");
        $total=null;
        if (empty($order->total_lol))
        {
            $total=$order->total;
        }
        else
        {
            $total=$order->total_lol;
        }
        $number=$_SESSION['logged_user']['number'];
        unset($_SESSION['logged_user']['number']);
        $h_add->date=$date;
        $h_add->user=$_SESSION["logged_user"]["name"];
        $h_add->number=$number;
        $h_add->total=$total;
        R::store($h_add);
        $order->status=1;
        R::store($order);
        //R::trash($order);
        mail_cart($_SESSION['logged_user']['name'],$_SESSION['logged_user']['email'],$number);
        header('Location: Cart.php');
    }
    elseif (strcmp($act,'del')==0)
    {
        R::trash($order);
        header('Location: Cart.php');
    }
