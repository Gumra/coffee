<?php
    require '../db.php';

    $str_one = "<!--name-->";
    $str_two = "<!--text-->";
    $str_three="<!--path-->";
    $str_four="<!--category-->";
    $str_five="<!--bd-->";

    $new_str_one = $_SESSION['item']['name'];
    $new_str_two = $_SESSION['item']['description'];
    $new_str_three=$_SESSION['item']['path']."\">".$_SESSION['item']['categories'].'</a>';
    $new_str_four=$_SESSION['item']['categories'];
    $new_str_five=$_SESSION['item']['bd'];

    //Index/Index.php">Главное меню</a>
    $my_file_copy=$_SESSION['item']['links'];

    $file =file("..\Item_Category\Item.php");
    if (is_array($file))
    {
        foreach($file as $key => $value)
        {
            if (strpos($value,$str_one)!==false){
                $file[$key]= str_replace($str_one, $new_str_one, $value);
            }
            if (strpos($value,$str_two)!==false){
                $file[$key]= str_replace($str_two, $new_str_two, $value);
            }
            if (strpos($value,$str_three)!==false){
                $file[$key]= str_replace($str_three, $new_str_three, $value);
            }
            if (strpos($value,$str_four)!==false){
                $file[$key]= str_replace($str_four, $new_str_four, $value);
            }
            if (strpos($value,$str_five)!==false){
                $file[$key]= str_replace($str_five, $new_str_five, $value);
            }
        }
        $fp = fopen($my_file_copy, "w+"); // перезаписываем независимо от длины новой строки
        fwrite($fp,implode("",$file));
        fclose($fp);
        header('Location: ../Pers_akk_redactions_admin/Pers_akk_redactions_admin.php');
    }
    else
    {
        exit ("Ошибка");
    }





