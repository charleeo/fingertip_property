<?php
     require_once ('configuration/db_config.php');
     require_once ('auth/Recoverpassword.php');
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;
     include_once (BASEURL."/PHPMailer/PHPMailer.php");
     include_once (BASEURL."/PHPMailer/Exception.php");
     include_once (BASEURL."/PHPMailer/SMTP.php");
     $title ="Passwor recovery";
     $description = "Recover your password";
     $kyeWords ='Password';
     include ("includes/head.php") ;
    
    ?>
    <div class="wrapper">
       
    <?php
   
        include ("includes/navbar.php");
        // echo date("U") + 1800;
   
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $email = ((isset($_POST['email']))?checkInput($_POST['email']):'');
            $email=trim($email);
            $expire = date("U") + 1800;
            $token = random_bytes(22);
            $selector = bin2hex(random_bytes(8));
            $url = 
            "https://fingertip.com.ng/recoverpassword.php?token=". bin2hex($token) . "&selector=".$selector;
            $subject = "Password Reset Request";
            $message = "<p>You or someone requested for a password reset
            for your account on <b>Fingertip</b>. </p>
            <p>If you didn't request for this, simply ignore this mail. Or follow the below link
                to recover your password .  <br/>
                You can copy and paste into a browser or just click on it.
            </p>
            <a href = '".$url."' target = '_blank'> '".$url."'</a>
            
            ";
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            $mail = new PHPMailer();
            $mail->addAddress($email);
            $mail->setFrom("charles@fingertip.com.ng","Charles Otaru");
            $mail->Subject= $subject;
            $mail->isHTML(true);
            $mail->Body = $message;
            $users = new Recoverpassword();
            $data = $users->checkemail($email);
       
            if(empty($_POST['email'])){
                $errors[] ="<p class ='text-center '>You must provide email</p>";       
            }
            // validate email adress
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[]='<p class="text-center">Please use a valid email</p>';
            }elseif(!$data["email"]){
                $errors[] = "<p class='text-center'>
                This e-mail address is not registered with us</p>";
            }
            // check if no error
            if(!empty($errors)){
                echo displayErrors($errors);
            }else{
            $users->deleteToken($email);
            if($mail->send()){
            $users->sendPasswordEmail($hashedToken, $email, $expire, $selector);
            }else{
               echo "<p class = 'text-center'> We could not send your message. Please try again</p>";
            }
         }
    }
    
    ?>

    <div class="login-modal">
        <div class="login-content">
            <h4>Password recovery</h4> <hr>
               <form action="" method="post">
                <input type="text" placeholder=" enter the registered e-mail address" 
                value="<?php echo ((isset($email))?$email: "") ?>"
                name= "email" class="input-lenght" >
                <button>Recover Password</button> <br/> <br/>
            </form>
        </div>
    </div>

     </div>

   
    
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/mainnavbarjs.js"></script>
    <!-- <script src="js/main.js"></script> -->
    <script src="js/categorysearch.js"></script>
</body>
</html>