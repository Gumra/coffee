<?php
    require '../db.php';
    $id=strval(key($_GET));

    $order = R::load('orders', $id);

    $order->status_admin=1;

    R::store($order);

    header("Location: Pers_akk_orders_admin.php");

