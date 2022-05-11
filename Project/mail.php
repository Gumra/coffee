<?php
// Файлы phpmailer
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/Exception.php';
require 'db.php';

// Переменные, которые отправляет пользователь
    $name = $_SESSION['forgot_user']['login'];
    $email = $_SESSION['forgot_user']['email'];;
    $text = $_SESSION['forgot_user']['temp'];

// Формирование самого письма
    $title = "Восстановление пароля";
    $body = "
<h2>Письмо из кафе</h2>
<b>Кому:</b> $name<br>
<b>Почта:</b> $email<br><br>
<b>Код:</b><br>$text
";

    // Настройки PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    try {
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPAuth   = true;
        //$mail->SMTPDebug = 2;
        $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

        $mail->Host = 'ssl://smtp.mail.ru';
        $mail->Port = 465;
        $mail->Username = 'shapovalov.dmit@inbox.ru';
        $mail->Password = 'fhhsGWvgAKNyvFnmVTQX';
        $mail->setFrom('shapovalov.dmit@inbox.ru', 'Дмитрий'); // Адрес самой почты и имя отправителя

        // Получатель письма
        $mail->addAddress($email);

        // Отправка сообщения
        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body = $body;

        // Проверяем отравленность сообщения
        if ($mail->send()) {$result = "success";}
        else {$result = "error";}
        header('Location: ./Forgot_2/Forgot_2.php');

    } catch (Exception $e) {
        $result = "error";
        $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
    }
