<?php

require_once('phpmailer/PHPMailerAutoload.php'); /* classe PHPMailer */

header('Content-Type: application/json; charset=utf-8');
$request_body = file_get_contents('php://input');
$payload = json_decode($request_body);
$name = $payload->name;
$email = $payload->email;
$message = $payload->message;

try {
    $mail = new PHPMailer; //New instance, with exceptions enabled

    /* E-MAIL BODY*/
    $body = "<h2>New Message From Contact Form:</h2>";
    $body .= "<strong>Name</strong>: $name <br>";
    $body .= "<strong>E-mail</strong>: $email <br>";
    $body .= "<strong>Message</strong>:<br>";
    $body .= $message;
    $body .= "<br>";
    $body .= "----------------------------";
    $body .= "<br>";
    $body .= "Sent <strong>" . date("h:m:i m/d/Y") . " by " . $_SERVER['REMOTE_ADDR'] . "</strong>"; //Show IP and Date
    $body .= "<br>";
    $body .= "----------------------------";

    $mail->isSMTP(); //tell the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->Port  = 587; //SMTP port (most used are 25, 465 and 587)
    $mail->Host  = 'smp.server.com'; // SMTP Server
    $mail->Username   = "my_smtp_user";  // SMTP  User
    $mail->Password  = "my_smtp_password";  // SMTP Password

    $mail->addReplyTo($email, $name); //Reply to..
    $mail->from = $email; //Contact Form E-mail
    $mail->fromName   = $name; //Contact Form Name

    // Account Info

    $to = "example@bluestream.com"; //Send E-mail to
    $mail->addAddress($to);
    $mail->subject  = "New contact from Bluestream Site"; //Subject
    $mail->wordWrap   = 80; // set word wrap

    $mail->msgHTML($body);

    $mail->isHTML(true); // send as HTML

    if (!$mail->send()) {
        // Something went wrong. Check message
        http_response_code(500);
        echo json_encode([
            'status' => 500,
            'message' => 'Message could not be sent.',
            'errorMessage' => $mail->ErrorInfo
        ]);
    } else {
        // All Good
        http_response_code(200);
        echo json_encode([
            'status' => 200,
            'message' => 'Message Sent'
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 500,
        'message' => $e->getMessage()
    ]); //Error Message
}
