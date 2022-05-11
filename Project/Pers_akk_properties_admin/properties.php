<?php
    require '../db.php';

    $data_prop=$_POST;
    var_dump($data_prop);

    if (!empty($data_prop["token"]) && hash_equals($data_prop["token"],$_SESSION["token"]))
    {
        $user = R::findOne('profiles', 'login = ?', array($_SESSION['logged_user']['login']));
        $user = R::load('profiles', $user->id);

        if (isset($data_prop['update_login'])) {
            if (!empty($data_prop['login'])) {
                $user->login = $data_prop['login'];
                R::store($user);
            }
        }
        if (isset($data_prop['update_name'])) {
            if (!empty($data_prop['name'])) {
                $user->name = $data_prop['name'];
                R::store($user);
            }
        }
        if (isset($data_prop['update_number'])) {
            if (!empty($data_prop['phone'])) {
                $user->phone = $data_prop['phone'];
                R::store($user);
            }
        }
        if (isset($data_prop['update_email'])) {
            if (!empty($data_prop['email'])) {
                $user->email = $data_prop['email'];
                R::store($user);
            }
        }
        if (isset($data_prop['update_date'])) {
            if (!empty($data_prop['date'])) {
                $user->date_born = $data_prop['date'];
                R::store($user);
            }
        }
        if (isset($data_prop['update_address'])) {
            if (!empty($data_prop['address'])) {
                $user->address = $data_prop['address'];
                R::store($user);
            }
        }
        if (isset($data_prop['update_image'])) {
            if (!empty($_FILES['image']['tmp_name'])) {
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
                $user->image = $img;
                R::store($user);
            }
        }
        if (isset($data_prop['update_password'])) {
            if (!empty($data_prop['old_pass'])) {
                if (password_verify($data_prop['old_pass'], $user->password)) {
                    if (!empty($data_prop['new_pass'] && !empty($data_prop['temp_pass']))) {
                        if (strcmp($data_prop['temp_pass'], $data_prop['new_pass']) == 0) {
                            $user->password = password_hash($data_prop['new_pass'], PASSWORD_DEFAULT);
                            R::store($user);
                            header('Location: ../Auth/Auth.php');
                            exit();
                        }
                    }
                }
            }
        }
        $_SESSION['logged_user'] = $user;
        if ($_SESSION['logged_user']['admin'] == 1) {
            header('Location: ../Pers_akk_properties_admin/Pers_akk_properties_admin.php');
        } else {
            //header('Location: ../Pers_akk_properties/Pers_akk_properties.php');
        }
    }