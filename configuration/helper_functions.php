<?php
define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/newproject/');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function displayErrors($errors){
    $display = '<ul >';
    foreach($errors as $error){
        $display.='<li class ="errors">'.$error.'</li>';
    }
    $display.='</ul>';
    return $display;
}
function checkInput($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = addslashes($data);
        return	$data;
}
function is_logged_in(){
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0){
     return  true ;  
    }
    return false;
}

function formatDate($date){
    return date("M d, Y h:i A", strtotime($date));
}
function formatNumber($a){
    if(preg_match("/^[0-9,]*$/", $a)){
        $a =str_replace(',', '', $a);
    }
    return $a;
}
function countTime($titme){
    return ($titme *3600);
}
function get_time_ago($time){
    $time_ago = strtotime($time);
    $current_time = time();
    $seconds = $current_time - $time_ago;
    $minutes = round($seconds/60);
    $hours   = round($seconds/3600);
    $days    = round($seconds/86400);
    $weeks    = round($seconds/604800);
    $months    = round($seconds/2629440);
    $years    = round($seconds/31553280);
    if($seconds <= 60){
        return "Just now";
    }else if($minutes <= 60){
        if($minutes == 1){
            return "One minute ago";
        }else{
            return $minutes." minutes ago";
        }
    }
    else if($hours <=24){
        if($hours == 1){
            return "One hour ago";
        }else{
            return $hours." hours ago";
        }
    }
    else if($days <=7){
        if($days = 1){
            return "One day ago";
        }else{
            return $days. " days ago ";
        }
    }
    else if($weeks <=4.3){
        if($weeks = 1){
            return "One week ago";
        }else{
            return $weeks. " weeks ago ";
        }
    }
    else if($months <=12){
        if($months = 1){
            return "One month ago";
        }else{
            return $months. " months ago ";
        }
    }
    else {
        if($years = 1){
            return "One year ago";
        }else{
            return $years. " years ago ";
        }
    }
}
function SendMail(){
    // $mail = new PHPMailer();
    // $mail->addAddress($userEmail);
    // $mail->setFrom("charles@fingertip.com.ng","Admin");
    // $mail->Subject= $subject;
    // $mail->isHTML(true);
    // $mail->Body = $message;
    // if($mail->send()){
    //   $msg = "Email snet";
    // }else{
    //   $msg= "We could not find the email specified";
    // }
}
function redirectpage(){
    return  header("Location: usersboard/redirectpage.php");
  }