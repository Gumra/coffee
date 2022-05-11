<?php
    require "../db.php";

    $data_login=$_POST;

    if (isset($data_login['login']))
    {
        $errors=array();
        $total_array=array();
        if (trim($data_login['login_auth'])=='')
        {
            $errors[]='Введите логин';
            $total_array[]='Введите логин';
        }
        if (trim($data_login['password_auth'])=='')
        {
            $errors[]='Введите пароль';
            $total_array[]='Введите пароль';
        }
        $errors_log[]=array();
        if (empty($errors))
        {
            $user=R::findOne("profiles", 'login=?',array($data_login['login_auth']));
            if ($user)
            {
                if (password_verify($data_login['password_auth'],$user->password))
                {
                   $_SESSION['logged_user']=$user;

                    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                    $number=substr(str_shuffle($permitted_chars), 0, 10);
                    $token=md5($number);
                    $_SESSION['token']=$token;

                   if ($user->admin)
                   {
                      header('Location: ../Pers_akk_profile_admin/Pers_akk_profile_admin.php');
                   }
                   else header('Location: ../Pers_akk_profile/Pers_akk_profile.php');
                }
                else
                {
                    $total_array[]='Неверный пароль';
                }
            }else {
                $total_array[]='Пользователь с логином не существует';
            }
        }
        if (!empty($total_array))
        {
            $_SESSION['errors_login']=array_shift($total_array);
            $_SESSION['user_login']=$data_login;
            header('Location: ./Auth.php');
        }
    }
    elseif (isset($data_login['forgot']))
    {
        header('Location: ../Forgot_1/Forgot_1.php');
    }

