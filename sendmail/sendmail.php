<?php
    // $to_email = "ua758323@gmail.com";
    // $subject = "Simple Email Test via PHP";
    // $body = "Hi, This is test email send by PHP Script";
    // $headers = "From: ua758323@gmail.com";

    // if (mail($to_email, $subject, $body, $headers)) {
    //     echo "Email successfully sent to $to_email...";
    // } else {
    //     echo "Email sending failed...$mail";
    // }

    require_once 'config.php';
    require 'vendor/autoload.php'; // If you're using Composer (recommended)

    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom(FROM_EMAIL, FROM_NAME);
    $email->setSubject("Finally Send EMAIl");
    $email->addTo(TO_EMAIL, TO_NAME);
    $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
    $email->addContent( "text/html", "<strong>Usama Finally Learn how to send Mail Fron Send Grid</strong>");

    $sendgrid = new \SendGrid( SENDGRID_API_KEY );
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }

?>