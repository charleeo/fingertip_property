<?php 
 require_once ("configuration/db_config.php");
 require_once (BASEURL."/controllers/displaysingle.php"); 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 include_once (BASEURL."/PHPMailer/PHPMailer.php");
 include_once (BASEURL."/PHPMailer/Exception.php");
 include_once (BASEURL."/PHPMailer/SMTP.php");
if(isset($_POST["submit_button"])){
    $name = checkInput($_POST['sender']);
    $propertyId = checkInput($_POST["property_id"]);
    $categoryId = checkInput($_POST['category_id']);
    $email = checkInput($_POST['email']);
    $user_id = checkInput($_POST['user_id']);
    $user_email = checkInput($_POST['user_email']);
    $message= checkInput($_POST["message"]);
    $newMessage = new displaySingleAd();
    $newMessage->sendMessage($name, $email,  $message, $propertyId, $categoryId,  $user_id);
}

?>