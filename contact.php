<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);
    try {
        // Email data
        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['comments']);

        // SMTP setup
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kelvinmutungi46@gmail.com'; // Your Gmail address
        $mail->Password = 'izpkafvujqmiqkby'; // ⚠️ Use an App Password, not your real one
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email headers
        $mail->setFrom($email, $name);
        $mail->addAddress('kelvinmutungi46@gmail.com');
        $mail->Subject = $subject;
        $mail->Body = "Name: $name\nEmail: $email\nMessage:\n$message";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
