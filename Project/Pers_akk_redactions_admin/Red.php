<?php
    require "../db.php";
    //require_once "translit.php";

    $date_red=$_POST;
    $errors=array();
    $errors_one=array();

    if (trim($date_red['categories'])=='')
    {
        $errors[]='Не выбрана категория';
    }
    if (trim($date_red['name'])=='')
    {
        $errors[]='Не выбрано название';
    }

    if (empty($errors)) {
        $name = $date_red['name'];
        $price = $date_red['price'];
        $description = $date_red['area_description'];
        $image = $date_red['image'];
        $array_item = [$name, $price, $description];

        $complete = array();

        $categories = null;

        switch ($date_red['categories']) {
            case 'Напитки':
            {
                $categories = 'drinks';
                break;
            }
            case 'Десерты':
            {
                $categories = 'dessert';
                break;
            }
            case 'На заказ':
            {
                $categories = 'desserto';
                break;
            }
        }

        if (trim($date_red['area_description']) == '') {
            $errors_one[] = 'Не выбрано описание';
        }
        if (trim($date_red['price']) == '') {
            $errors_one[] = 'Не выбрана цена';
        }

        if (empty($errors_one)) {
            if (isset($date_red['delete_this'])) {
                $find = R::findOne($categories, 'name = ? && price = ? && description = ?', $array_item);
                $delete = R::load($categories, $find->id);
                if (!empty($find))
                {
                    R::trash($delete);
                    header('Location: ./Pers_akk_redactions_admin.php');
                }
                else
                {
                    $hc=htmlentities($array_item[0]);
                    header("Location: ./reflect.php?a=$hc");
                }
            } elseif (isset($date_red['update_this'])) {
                $find = R::findOne($categories, 'name = ?', array($name));
                $find = R::load($categories, $find->id);

                $find->name=$name;
                $find->price=$price;
                $find->description=$description;
                if (!empty($date_red['in_stock']))
                {
                    $find->in_stock=$date_red['in_stock'];
                }

                $tmpFile = $_FILES["image"]["tmp_name"];

                list($width, $height) = getimagesize($tmpFile);

                if ($width >= 200 && $height >= 200) {
                    try {
                        $image = new Imagick($tmpFile);
                        $image->thumbnailImage(200, 200);
                        $image->writeImage($tmpFile);
                    } catch (ImagickException $e) {
                    }
                }

                $img = file_get_contents($tmpFile);
                $find->image=$img;
                R::store($find);
                header('Location: Pers_akk_redactions_admin.php');

            } elseif (isset($date_red['add_this'])) {
                if (R::count($categories, 'name = ? && price = ? && description = ?', $array_item) > 0) {
                    $errors[] = 'Такой продукт уже добавлен';
                } else {
                    $item = R::dispense($categories);
                    $item->name = $name;
                    $item->description = $description;

                    $tmpFile = $_FILES["image"]["tmp_name"];

                    list($width, $height) = getimagesize($tmpFile);

                    if ($width >= 200 && $height >= 200) {
                        try {
                            $image = new Imagick($tmpFile);
                            $image->thumbnailImage(200, 200);
                            $image->writeImage($tmpFile);
                        } catch (ImagickException $e) {
                        }

                    }

                    $img = file_get_contents($tmpFile);
                    $item->image = $img;
                    $item->price = $price;

                    if (!empty($date_red['in_stock']))
                    {
                        $item->in_stock=$date_red['in_stock'];
                    }

                    R::store($item);
                    header('Location: Pers_akk_redactions_admin.php');
                }
            }
        }
        else
        {
            $_SESSION['errors']=array_shift($errors_one);
            header('Location: ./Pers_akk_redactions_admin.php');
        }
    }
    else
    {
        $_SESSION['errors']=array_shift($errors);
        header('Location: ./Pers_akk_redactions_admin.php');
    }


