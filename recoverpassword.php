<?php
     require_once ('configuration/db_config.php');
     require_once ('auth/Recoverpassword.php');
     
     $title ="Passwor recovery";
     $description = "Recover your password";
     $kyeWords ='Password';
     include ("includes/head.php") ;
    //  Get the token
    $userPassword = new Recoverpassword();
    
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $password = ((isset($_POST['password']))?checkInput($_POST['password']):'');
        $Cpassword = ((isset($_POST['Cpassword']))?checkInput($_POST['Cpassword']):'');
        $selector = $_POST['selector'];
        $validator = $_POST['token'];
        $currenttime = date("U");
        if(empty($password) || empty($Cpassword)){
            echo "<p class='text-center'> Please fill out all field</p> ";
        }elseif($Cpassword !== $password){
            echo "<p class='text-center'>The repeat password must match with the new password</p>";
        } elseif(strlen($password) <= 6){
            echo "<p class='text-center'>The  password must be greater than six characters</p>";
        }else{
           $result =  $userPassword->resetNewPassword($selector, $currenttime);
           var_dump($result);
           if(!$result){
            echo "There was an error. Please resend the request 1";
            exit();
           }else{
            //    validate thetoken
            $tokenToBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenToBin, $result["token"]);
                if($tokenCheck === false){
                    echo "There was an error. Please resend the request 2";
                    exit();
                }elseif($tokenCheck === true){
                    $email = $result["reset_email"];
                   $output = $userPassword->getTheUserInfo($email);
                   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                   if($output > 0 ){
                       $userPassword->updateUserPassword($email, $hashedPassword);
                   }else{
                       echo "User not found";
                   }
                }
           }
        }
    }
     

    ?>
    <div class="wrapper">
       
    <?php
   
        include ("includes/navbar.php");
        
        ?>
        <div class="login-modal">
        <div class="login-content">
        <h4>Create new password</h4> 
        <p>Password length must be greater than six characters</p>
        <hr>
        <?php
   
        if($_SERVER['REQUEST_METHOD'] == "GET"){
            $tokenselector = ((isset($_GET['selector']))?checkInput($_GET['selector']):'');
            $tokenvalidator = ((isset($_GET['token']))?checkInput($_GET['token']):'');
            if(empty($tokenvalidator) || empty($tokenselector)){
                echo "<p>We can't find this record. Please be sure you sent them or you can resend the message again</p>";
            }else{
                if(ctype_xdigit($tokenselector) !== false && ctype_xdigit($tokenvalidator) !== false){
                }else{
                    echo "This credentials are not valid";
                }
            }
        }
        ?>
               <form action="" method="post">
               <input type="hidden" name="token" value="<?php echo $tokenvalidator ?>">
               <input type="hidden" name="selector" value="<?php echo $tokenselector ?>">
                <input type="password" placeholder=" enter a new password" 
                name= "password" class="input-lenght" >
                <input type="password" placeholder=" repeat new password" 
                name= "Cpassword" class="input-lenght" >
                <button>Reset Password</button> <br/> <br/>
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