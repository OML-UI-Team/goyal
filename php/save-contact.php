<?php

if($_POST) {

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    //$to = "pankaj.kumar@omlogic.com";
    $to = "goyaleye.sde@gmail.com";
    $subject = "New contact query received";
    $headers = "MIME-Version: 1.0\r\n";
    //$headers .= "Bcc: shivani.deshwal@omlogic.com, sumit@omlogic.com, rahul.panchal@omlogic.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Admin Mail
    $message = "<p>Hello Admin,</p> <h3>We have received new contact query:</h3>";
    foreach ($_POST as $key => $value) {

        if(is_array($value)) {
            $message .= "<p>".ucfirst($key).': '.implode(', ', $value)."</p>";
        } else {
            $message .= "<p>".ucfirst($key).': '.$value."</p>";
        }

    }

    $message .= "<br><p>Thank You</p>";
    mail($to,$subject,$message, $headers);
    
    
    $header = "Date, Name, Email, Phone, Comment\n";
            
    $date = date("Y/m/d");
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];
    $data = "$date, $name, $email, $phone, $comment\n";
    $fileName = "contact-queries.csv";
        
    if (file_exists($fileName)) {
        file_put_contents($fileName, $data, FILE_APPEND);
    } else {
        file_put_contents($fileName, $header . $data);
    }

    echo json_encode(['status' => 'success', 'message' => 'Thank you for contact us. We will get back to you soon!']);
    exit;
} else {
    die('invalid attempt');
}