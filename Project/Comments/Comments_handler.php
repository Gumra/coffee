<?php
    require '../db.php';

    $data_comment=$_POST;

    if (isset($data_comment['add_comment']))
    {
        if(!empty($data_comment['area_comment']))
        {
            $comment=R::dispense('comments');
            $user=null;
            if (!empty($_SESSION['logged_user']['name']))
            {
                $user=$_SESSION['logged_user']['name'];
            }
            else
            {
                $user='Неизвестный';
            }
            $comment->date=date("Y-m-d");
            $comment->user=$user;
            $comment->comment=$data_comment['area_comment'];
            R::store($comment);
            header('Location: Comments.php');
        }
    }