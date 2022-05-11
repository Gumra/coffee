<?php
    require '../db.php';

    $data_forgot2=$_POST;
    $errors=array();

    if (isset($data_forgot2['to_handler']))
    {
        $code=$data_forgot2['code_forg2'];
        if (strcmp($code,$_SESSION['forgot_user']['temp'])==0)
        {
            $password = $data_forgot2['new_pass_forg2'];
            $password_temp = $data_forgot2['temp_pass_forg2'];

            if (!empty($password)&&!empty($password_temp))
            {
                if (strcmp($password, $password_temp) != 0) {
                    $errors[]='не совпадают пароли';
                }
            }
            else
            {
                $errors[]='Пароли пустые';
            }
        }
        else
        {
            $errors[]='сначала пройдите проверку';
        }

        if (empty($errors))
        {
            $user=R::findOne("profiles", 'login=?',array($_SESSION['forgot_user']['login']));
            $user->password=password_hash($password,PASSWORD_DEFAULT);
            R::store($user);
            header('Location: ../Auth/Auth.php');
        }
        else
        {
            $_SESSION['errors']=array_shift($errors);
            $_SESSION['code']=$code;
            header('Location: Forgot_2.php');
        }
    }