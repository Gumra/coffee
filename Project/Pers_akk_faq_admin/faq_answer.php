<?php
    require '../db.php';

    $data_answer=$_POST;

    if (isset($data_answer['add_answer']))
    {
        if (!empty($data_answer['area_answer'])&&!empty($data_answer['questions']))
        {
            $faq=R::load('faq',$data_answer['questions']);
            $faq->answer=$data_answer['area_answer'];
            R::store($faq);
            header('Location: Pers_akk_faq_admin.php');
        }
        else
        {
            header('Location: Pers_akk_faq_admin.php');
        }
    }