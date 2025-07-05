<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php'; // Composer autoload

if (!function_exists('sendOTPEmail')) {
    function sendOTPEmail($toEmail, $name, $otp) {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;            // 0 = off, 2 = debug
            $mail->Debugoutput = 'html';

            $mail->isSMTP();
            $mail->Host       = 'mail.thankyounepaltrip.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'info@thankyounepaltrip.com';
            $mail->Password   = 'HSd6750CZQZwV7S3';  // your SMTP password
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('info@thankyounepaltrip.com', 'Thank You Nepal Trip');
            $mail->addAddress($toEmail, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';
            $mail->Body    = "<p>Hello <strong>$name</strong>,<br>Your OTP is: <strong>$otp</strong><br>Valid for 15 minutes.</p>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log('Mailer Error: ' . $mail->ErrorInfo);
            return false;
        }
    }
}

if (!function_exists('sendWelcomeEmail')) {
    function sendWelcomeEmail($toEmail, $name) {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;

            $mail->isSMTP();
            $mail->Host       = 'mail.thankyounepaltrip.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'info@thankyounepaltrip.com';
            $mail->Password   = 'HSd6750CZQZwV7S3';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('info@thankyounepaltrip.com', 'Thank You Nepal Trip');
            $mail->addAddress($toEmail, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Welcome!';
            $mail->Body    = "<h3>Welcome, $name!</h3><p>Your account has been successfully created.</p>";

            $mail->send();
        } catch (Exception $e) {
            error_log('Welcome Email Error: ' . $mail->ErrorInfo);
        }
    }
}
