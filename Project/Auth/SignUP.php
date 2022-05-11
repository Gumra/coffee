<?php
    require "../db.php";

    $data_sign=$_POST;
    if (isset($data_sign['sign']))
    {
        $errors=array();

        if (trim($data_sign['name_reg']==''))
        {
            $errors[]='Введите имя';
        }
        if (trim($data_sign['login_reg']==''))
        {
            $errors[]='Введите логин';
        }
        if (trim($data_sign['password_reg']==''))
        {
            $errors[]='Введите пароль';
        }
        if (trim($data_sign['number_reg']==''))
        {
            $errors[]='Введите номер';
        }
        else {
            $phone=$data_sign['number_reg'];
            if (!preg_match('/^8\([0-9][0-9][0-9]\)[0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]/', $phone)){
                $errors[]="Введите корректный номер";
            }
        }
        if (empty($_FILES['image']['tmp_name']))
        {
            $errors[]='Выберите аватар';
        }
        if (trim($data_sign['mail_reg']==''))
        {
            $errors[]='Введите почту';
        }
        if (!filter_var($data_sign['mail_reg'],FILTER_VALIDATE_EMAIL)) {
            $errors[]='Неправильно введена почта';
        }
        if (trim($data_sign['birthday_reg']==''))
        {
            $errors[]='Введите день рождения';
        } else{
            $date=date_create($data_sign['birthday_reg']);
            $date_norm=date_format($date,"Y-m-d");
        }
        if (trim($data_sign['address_reg']==''))
        {
            $errors[]='Введите адрес';
        }
        if (R::count('profiles',"login=?",array($data_sign['login_reg']))>0)
        {
            $errors[]='Пользователь с логином существует';
        }
        if (R::count('profiles',"email=?",array($data_sign['mail_reg']))>0)
        {
            $errors[]='Пользователь с почтой существует';
        }

        if (empty($errors)){
            $user=R::dispense('profiles');
            $user->name=$data_sign['name_reg'];
            $user->login=$data_sign['login_reg'];
            $user->password=password_hash($data_sign['password_reg'],PASSWORD_DEFAULT);
            $user->phone=$data_sign['number_reg'];
            $user->email=$data_sign['mail_reg'];
            $user->date_born=$data_sign['birthday_reg'];
            $user->address=$data_sign['address_reg'];

            $tmpFile = $_FILES["image"]["tmp_name"];

            list($width, $height) = getimagesize($tmpFile);

            if ($width >= 70 && $height >= 70) {
                try {
                    $image = new Imagick($tmpFile);
                    $image->thumbnailImage(70, 70);
                    $image->writeImage($tmpFile);
                } catch (ImagickException $e) {
                }

            }

            $img = file_get_contents($tmpFile);

            $user->image=$img;
            R::store($user);
            header('Location: ./Auth.php');
        }else
        {
          $_SESSION['errors']=array_shift($errors);
          $_SESSION['user']=$data_sign;
          header('Location: ./Auth.php');
        }
    }