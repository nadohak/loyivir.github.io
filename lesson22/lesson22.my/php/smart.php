<?php 
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.yandex.ru';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'емэйл';                 // SMTP username
$mail->Password = 'пароль';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('loyivir@yandex.ru', 'Form Manager');
$mail->addAddress('loyivir@gmail.com', 'Admin');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Регистрация пользователя';
$mail->Body    = 'Имя: '.htmlspecialchars($name).'<br>E-mail:'.htmlspecialchars($email).'<br>Пароль: '.htmlspecialchars($password);
$mail->AltBody = 'Имя: '.htmlspecialchars($name).'\r\nE-mail:'.htmlspecialchars($email).'\r\nПароль: '.htmlspecialchars($password);;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>