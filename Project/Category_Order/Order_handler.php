<?php
    require '../db.php';

    $db_order=R::dispense('orders');
    $db_order->user=$_SESSION['logged_user']['name'];
    $db_order->date=date('Y-m-d');
    $db_order->names=$_SESSION['names'];
    $db_order->prices=$_SESSION['prices'];
    $db_order->stocks=$_SESSION['stocks'];
    $db_order->total=$_SESSION['total'];

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $number=substr(str_shuffle($permitted_chars), 0, 10);
    $_SESSION['logged_user']['number']=$number;
    $db_order->number=$number;
    $db_order->status=0;
    $db_order->status_admin=0;

    if (!empty($total_lol))
    {
        $db_order->total_lol=$total_lol;
    }
    R::store($db_order);

    header('Location: ../Cart/Cart.php');