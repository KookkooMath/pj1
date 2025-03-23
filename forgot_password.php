<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true;
    $mail->Username   = 'filmnaritsara123@gmail.com'; // ใส่อีเมลของน้อง
    $mail->Password   = 'hwvknmpsqslnjoso';  // ใช้ App Password ถ้าเป็น Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;


    $mail->setFrom('filmnaritsara123@gmail.com', 'feem');
    $mail->addAddress('Phapfeem@gmail.com', 'momo'); 

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = '<h1>Hello!</h1><p>This is a test email.</p>';

    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
