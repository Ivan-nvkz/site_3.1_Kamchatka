<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$base = $_POST['base'];
$data = $_POST['data'];
$message = $_POST['message'];
$email = $_POST['email'];
// $phone = $_POST['phone'];
// $area = $_POST['area'];
// $numberadults = $_POST['numberadults'];
// $numberchildren = $_POST['numberchildren'];
// $datain = $_POST['datain'];
// $dataout = $_POST['dataout'];

// $file = $_FILES['myfile'];

// Формирование самого письма
$title = "Новое сообщение с сайта Камчатка";
$body = "
<h2>Новое письмо</h2>
<b>Имя участника: </b>$name<br>
<b>Количество человек: </b>$quantity<br>
<b>Тариф: </b>$base<br>
<b>Дата тура: </b>$data<br>
<b>Сообщение: </b> $message <br>

<h2>Получите памятку туриста</h2>
<b>Почта:</b> $email<br>

---------------------------------------------
Инф-я ниже не комментируется.
Пока оставил как заготовку,
на будущее.



// <b>Телефон:</b> $phone<br>
// <b>Местность Крыма:</b> $area<br>
// <b>Количество взрослых:</b> $numberadults<br>
// <b>Количество детей:</b> $numberchildren<br>
// <b>Почта:</b> $email<br>
// <b>Сообщение:</b> $message <br>
// <b>Дата заезда:</b> $datain <br>
// <b>Дата выезда:</b> $dataout <br>
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    // $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'invent555@mail.ru'; // Логин на почте
    $mail->Password   = '7SDqT7qRPPSNoQdrW8h3'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('invent555@mail.ru', 'Иван'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('invent555@mail.ru');  
   //  $mail->addAddress('youremail@gmail.com'); // Ещё один, если нужен

    // Прикрипление файлов к письму
if (!empty($file['name'][0])) {
    for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
        $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
        $filename = $file['name'][$ct];
        if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
            $mail->addAttachment($uploadfile, $filename);
            $rfile[] = "Файл $filename прикреплён";
        } else {
            $rfile[] = "Не удалось прикрепить файл $filename";
        }
    }   
}
// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
// echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);

header("Location: index.html#application");
exit;