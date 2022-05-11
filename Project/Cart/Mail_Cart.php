<?php
function mail_cart($name,$email,$text)
{
// Файлы phpmailer
    require '../../PHPMailer-master/src/PHPMailer.php';
    require '../../PHPMailer-master/src/SMTP.php';
    require '../../PHPMailer-master/src/Exception.php';
    //require '../db.php';

// Формирование самого письма
    $title = "Заказ из кафе";
    $body = "
<h2>Письмо из кафе</h2>
<b>Кому:</b> $name<br>
<b>Почта:</b> $email<br><br>
<b>Номер заказа:</b><br>$text<br><br>
<b>Забрать заказ можете только сегодня)</b><br>
<b>Наша миссия - чтоб каждый день были только свежие тортики)</b><br>
";

    // Настройки PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    try {
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPAuth = true;
        //$mail->SMTPDebug = 2;
        $mail->Debugoutput = function ($str, $level) {
            $GLOBALS['status'][] = $str;
        };

        $mail->Host = 'ssl://smtp.mail.ru';
        $mail->Port = 465;
        $mail->Username = 'shapovalov.dmit@inbox.ru';
        $mail->Password = '123456654321dd';
        $mail->setFrom('shapovalov.dmit@inbox.ru', 'Дмитрий'); // Адрес самой почты и имя отправителя

        // Получатель письма
        $mail->addAddress($email);

        // Отправка сообщения
        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body = $body;

        // Проверяем отравленность сообщения
        if ($mail->send()) {
            $result = "success";
        } else {
            $result = "error";
        }
        //header('Location: ./Forgot_2/Forgot_2.php');
    } catch (Exception $e) {
        $result = "error";
        $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
    }
}