<?php
 
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendEmail($fromEmail, $fromName, $subject, $body) {
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = 0;// Enable verbose debug output
        $mail->isSMTP();// gửi mail SMTP
        $mail->Host = 'smtp.gmail.com';// Set the SMTP server to send through
        $mail->SMTPAuth = true;// Enable SMTP authentication
        $mail->Username = '20210938@eaut.edu.vn';// Địa chỉ email của bản thân
        $mail->Password = 'jwkt fvgi jeox ilow'; // SMTP password
        $mail->SMTPSecure = 'tls';// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 587; // TCP port to connect to
        $mail->CharSet = 'UTF-8'; 
        //Recipients
        $mail->setFrom('20210938@eaut.edu.vn', 'Tân việt'); //Mail người gửi
        $mail->addAddress($fromEmail, $fromName); // Add a recipient
        // $mail->addAddress('quangcover2k3az@gmail.com','Quang'); // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
    
        // Content
        $mail->isHTML(true);   // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        return $status_mail = 1;
    } catch (Exception $e) {
        return $status_mail = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>