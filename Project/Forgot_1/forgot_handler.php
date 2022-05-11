<?php
    require "../db.php";

    $data_forgot=$_POST;
    if (isset($data_forgot['to_handler']))
    {
        $login=$data_forgot['login_forg'];
        $mail=$data_forgot['mail_forg'];
        $user=R::findOne("profiles", 'login=?',array($data_forgot['login_forg']));
        if (R::count('profiles',"login=?",array($data_forgot['login_forg']))==1)
        {
            if (strcmp($user->email,$mail)==0)
            {
                $text=rand(0,4444);
                $user->temp=$text;
                $_SESSION['forgot_user']=$user;
                R::store($user);
                header('Location: ../mail.php');
            }
        }
    }
