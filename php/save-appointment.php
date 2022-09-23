<?php

if($_POST) {

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    // echo "<pre>";
    // print_r($_POST);
    // die;

    $to = "goyaleye.sde@gmail.com";
    
    if(isset($_POST['name']) && ($_POST['name']=="Pankajdev")) {
        $to = "pankaj.kumar@omlogic.co.in";
    }
    
    $for = (isset($_POST['subject']) && !empty($_POST['subject']))?" for ".$_POST['subject']:'';
    $subject = "New Appointment Request received".$for;
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From:  Goyaleye <no-reply@goyaleye.com>\r\n";
    $headers .= "Bcc: sumit@omlogic.com, rahul.panchal@omlogic.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    // Admin Mail
    $message = "<p>Hello Admin,</p> <h3>We have received new appointment".$for.":</h3>";
    foreach ($_POST as $key => $value) {
        if(in_array($key, ['page', 'subject'])) { continue; }
        if(is_array($value)) {
            $message .= "<p>".str_replace(["-", "_"], " ", ucfirst($key)).': '.implode(', ', $value)."</p>";
        } else {
            $message .= "<p>".str_replace(["-", "_"], " ", ucfirst($key)).': '.$value."</p>";
        }

    }

    $message .= "<br><p>Thank You<br> Team Goyaleye</p>";
    mail($to,$subject,$message, $headers);

    $header = "Date, Name, Email, Phone, Preferred location,Location, Problem, Comment, Page\n";
            
    $date = date("Y/m/d");
    $name = $_POST['name']??"";
    $email = $_POST['email']??"";
    $phone = $_POST['phone']??"";
    $preferred_location = $_POST['preferred_location']??"";
    $location = $_POST['location']??"";
    $problem = $_POST['problem']??"";
    $comment = $_POST['comment']??"";
    $page = $_POST['page']??"";
    
    $data = "$date, $name, $email, $phone, $preferred_location,$location, $problem, $comment, $page\n";
    $fileName = "appointment-leads.csv";
        
    if (file_exists($fileName)) {
        file_put_contents($fileName, $data, FILE_APPEND);
    } else {
        file_put_contents($fileName, $header . $data);
    }

    echo json_encode(['status' => 'success', 'message' => 'Thank you for appointment. We will get back to you soon!']);
    
    // header('location:../thank-you.php');
    exit;
} else {
    die('invalid attempt');
}