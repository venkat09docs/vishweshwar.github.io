<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_REQUEST['email']))
{
  $to=$_REQUEST['email'];
  $phone=$_REQUEST['phone'];
  $content=$_REQUEST['message'];
  $name=$_REQUEST['name'];
  send_email($phone,$to,$content,$name);
}
function send_email($phone,$to,$content,$name){
//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'evishweshwar@gmail.com';                     //SMTP username
    $mail->Password   = 'Your Gmail ID APP password';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->setFrom('evishweshwar@gmail.com', 'Email Enquiry');
    $mail->addAddress('$to', 'evishweshwar@gmail.com');     //Add a recipient
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Enquiry';
    $mail->Body    = '<h3 align="center"> Details</h3>
		<table border="1" width="100%" cellpadding="5" cellspacing="5">
			<tr>
				<td width="30%">Name</td>
				<td width="70%">'.$_REQUEST['name'].'</td>
			</tr>
      <tr>
      <td width="30%">Phone Number</td>
      <td width="70%">'.$_REQUEST['phone'].'</td>
    </tr>
			<tr>
				<td width="30%">Email Address</td>
				<td width="70%">'.$_REQUEST['email'].'</td>
			</tr>
			
			<tr>
				<td width="30%">message</td>
				<td width="70%">'.$_REQUEST["message"].'</td>
			</tr>
			
		</table>';
    $mail->send();
    echo 'Message has been sent';
    echo '<script>alert("Mail sent successfully");window.location.href="index.html";</script>';
  } catch (Exception $e) {
      echo "Message could not be sent.";
  }
}