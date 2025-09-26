<?php
// filepath: c:\xampp\htdocs\Portfolio\send_mail.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure l'autoloader de Composer ou le chemin vers PHPMailer
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = htmlspecialchars($_POST['name'] ?? '');
    $email   = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    $mail = new PHPMailer(true);

    try {
        // Paramètres du serveur SMTP (utilise ton SMTP ou Gmail)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tceolin1710@gmail.com'; // ton email
        $mail->Password   = 'TON_MOT_DE_PASSE_GMAIL'; // ton mot de passe ou mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinataire
        $mail->setFrom($email, $name);
        $mail->addAddress('tceolin1710@gmail.com', 'Thomas CEOLIN');

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message depuis le portfolio';
        $mail->Body    = "<strong>Nom:</strong> $name<br><strong>Email:</strong> $email<br><strong>Message:</strong><br>$message";
        $mail->AltBody = "Nom: $name\nEmail: $email\nMessage:\n$message";

        $mail->send();
        echo "<script>alert('Message envoyé !');window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Erreur lors de l\'envoi : {$mail->ErrorInfo}');window.location.href='index.html';</script>";
    }
} else {
    header('Location: index.html');
    exit;
}