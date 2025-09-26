<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tceolin1710@gmail.com';
    $mail->Password = 'TON_MOT_DE_PASSE_APPLICATION';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('tceolin1710@gmail.com', 'Test');
    $mail->addAddress('tceolin1710@gmail.com', 'Test');

    $mail->Subject = 'Test PHPMailer';
    $mail->Body = 'Ceci est un test.';

    $mail->send();
    echo 'Mail envoyé !';
} catch (Exception $e) {
    echo "Erreur : {$mail->ErrorInfo}";
}
