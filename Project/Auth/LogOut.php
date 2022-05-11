<?php
    require '../db.php';
    $data_LogOut=$_POST;

    if (isset($data_LogOut['LogOut']))
    {
        unset ($_SESSION['logged_user']);
        header('Location: ./Auth.php');
    }
