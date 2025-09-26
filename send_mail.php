<?php
// filepath: c:\xampp\htdocs\Portfolio\send_mail.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure l'autoloader de Composer ou le chemin vers PHPMailer
require 'vendor/autoload.php';

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim(htmlspecialchars($_POST['name'] ?? ''));
    $email   = trim($_POST['email'] ?? '');
    $message = trim(strip_tags($_POST['message'] ?? ''));

    if (!$name || !$email || !$message || !is_valid_email($email)) {
        echo "<script>alert('Données invalides.');window.location.href='index.html';</script>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Paramètres du serveur SMTP (utilise ton SMTP ou Gmail)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tceolin1710@gmail.com'; // ton email
        $mail->Password   = 'ksnscybzbvfmexrd'; // ton mot de passe ou mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Expéditeur fixe, Reply-To visiteur
        $mail->setFrom('tceolin1710@gmail.com', 'Portfolio Website');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('tceolin1710@gmail.com', 'Thomas CEOLIN');

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message depuis le portfolio';
        $mail->Body    = "<strong>Nom:</strong> " . htmlentities($name) . "<br><strong>Email:</strong> " . htmlentities($email) . "<br><strong>Message:</strong><br>" . nl2br(htmlentities($message));
        $mail->AltBody = "Nom: $name\nEmail: $email\nMessage:\n$message";

        $mail->send();
        echo "<script>alert('Message envoyé !');window.location.href='index.html';</script>";
    } catch (Exception $e) {
        // Ne pas afficher l'erreur technique à l'utilisateur
        echo "<script>alert('Erreur lors de l\'envoi.');window.location.href='index.html';</script>";
    }
} else {
    header('Location: index.html');
    exit;
}