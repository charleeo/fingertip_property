<?php
echo strtotime(date('D'));
die();
$mail = new PHPMailer();
$mail->addAddress($userEmail);
$mail->setFrom("charles@fingertip.com.ng","Admin");
$mail->Subject= $subject;
$mail->isHTML(true);
$mail->Body = $message;
if($mail->send()){
  $msg = "Email snet";
}else{
  $msg= "We could not find the email specified";
}
