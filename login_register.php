    <?php
     require_once ('configuration/db_config.php');
     $title ="Authentication";
     $description = "Log in page for registered users";
     $kyeWords ='';
     include ("includes/head.php") ;
    
    ?>
    <div class="wrapper">
       
    <?php
   
    include ("includes/navbar.php") ?>
    <?php 
    if(isset($_GET['sign'])){
        require_once ("auth/registerclass.php");
        
if($_POST){
    $firstName = ((isset($_POST['firstname']))?checkInput($_POST['firstname']):'');
    $lastName = ((isset($_POST['lastname']))?checkInput($_POST['lastname']):'');
    $email = ((isset($_POST['email']))?checkInput($_POST['email']):'');
    $Cpassword = ((isset($_POST['Cpassword']))?checkInput($_POST['Cpassword']):'');
    $password = ((isset($_POST['password']))?checkInput($_POST['password']):'');
    $company = ((isset($_POST['company']))?checkInput($_POST['company']):'');
    $gender = ((isset($_POST['gender']))?checkInput($_POST['gender']):'');
    $designation = ((isset($_POST['designation']))?checkInput($_POST['designation']):'');
    $token = "qwertyuiopasdfghjklzxcvbnmMNBVCXZASDFGHJKLOPUYTREWQ0123456789!$/()*";
    $token = str_shuffle($token);
    $token  = substr($token, 0 , 20);
    $errors =[];
        
        $required = ['email', 'firstname',  'password', 'Cpassword','lastname', 'company', 'gender', 'designation'];
        foreach($required as $req){
            if(empty($_POST[$req])){
                $errors[]='<p class="text-center">You must fill out all fields</p>';
                break;
            }
        }
        // password lenght check
        if(strlen($password) < 6){
            $errors[]='<p class="text-center">Password must not be less than six characters</p>';
        }
        // password matching check
        elseif($password != $Cpassword){
            $errors[]='<p class="text-center">Password do not match</p>';
        }
        // validate email adress
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[]='<p class="text-center">Please use a valid email</p>';
        }
        
        // errors empty ckeck
            if(!empty($errors)){
                // echo displayErrors($errors);
        }

        else{
            $register = new Register();
            $user = $register->register($firstName, $lastName, $email, $password, $company, $gender, $designation, $token);
            $mail = new PHPMailer();
            $mail->addAddress($email);
            $mail->setFrom("charles@fingertip.com.ng","Admin");
            $mail->Subject= "Email verification";
            $mail->isHTML(true);
            $mail->Body = "<p>Your account has been created successfully.</p>
                           <p>Visit  this 
                           <a href = 'https://www.fingertip.com.ng/confirmemail.php?email=".$email."&token=".$token."'>link</a>
                           to verify your email</p> ";
            if($mail->send()){
            $msg = "Email snet";
            }else{
            $msg= "We could not find the email specified";
            }
        }
    } 
    ?>
    <div class="signup-modal">
        <div class="signup-content">
            <h4>Users Register</h4>
            <h4><?php echo ((isset($user)))? $user: "" ; ?></h4>
            <hr>
            <?php
             if(!empty($errors)){
                echo displayErrors($errors);
        }
            ?>
               <form action="" method="post">
            
               <div class="form-group">
                   <!-- <label for="designation">Designation</label> -->
                    <select name="designation" id="" class="form-control">
                        <option value="">Select designation</option>
                        <?php 
                        $designationArray = ["Mr", "Mrs", "Miss", "Chief", "Madam"];
                        foreach($designationArray as $designate){
                        ?>
                       
                        <option value="<?php echo $designate ?>"
                        <?php
                        echo ((isset($designation) && $designation ==$designate)?"selected":"")
                        ?>
                        >
                        <?php echo $designate ?></option>
                        <?php } ?>
                    </select> 
                </div>
                <div class="form-group">
                    <!-- <label for="gender">Gender</label> -->
                <select name="gender" id="" class="form-control">
                    <option value="">Select gender</option>
                    <option value="Male"
                    <?php
                    echo ((isset($gender) && $gender =="Male")?"selected":"")
                    ?>
                    >Male</option>
                    <option value="Female"
                    <?php
                    echo ((isset($gender) && $gender =="Female")?"selected":"")
                    ?>
                    >Female</option>
                </select> 
                </div>
                <div class="form-group">
                    <!-- <label for="role">Role</label> -->
                <select name="company" id="" class="form-control">
                    <option value="">Register as</option>
                    <?php 
                        $roles = ["Properyt Agent", "Land Lord",
                         "Real Esate Developer", "Cars Dealeer"];
                        foreach($roles as $role){
                        ?>
                       
                        <option value="<?php echo $role ?>"
                        <?php
                        echo ((isset($company) && $company ==$role)?"selected":"")
                        ?>
                        >
                        <?php echo $role ?></option>
                        <?php } ?>
                </select>
                </div>
                <div class="form-group">
                    <!-- <label for="firstname">First Name</label> -->
                    <input type="text" name ="firstname" 
                        value="<?php echo ((isset($firstName))?$firstName: "") ?>"
                        placeholder= "First Name" class="form-control" >
                </div>
                <div class="form-group">
                    <!-- <label for="latname">Last Name</label> -->
                    <input type="text" name = "lastname" 
                    value="<?php echo ((isset($lastName))?$lastName: "") ?>"
                    placeholder="Last Name "class="form-control" >
                </div>
               <div class="form-group">
                   <!-- <label for="email">Email Address</label> -->
                    <input type="text" name = "email" 
                    value="<?php echo ((isset($email))?$email: "") ?>"
                    placeholder="Email"class="form-control" >
               </div>
                <div class="form-group">
                    <!-- <label for="password">Password</label> -->
                    <input type="password" name ="password" 
                    placeholder="Pass word"
                    class="form-control" auto-complete="off" >
                </div>
                <div class="form-group">
                    <!-- <label for="Confirmpassword">Confirm Password</label> -->
                    <input type="password"  name = "Cpassword" 
                    placeholder="confirm password" class="form-control">
                </div>
                 
               <button>Register</button>
            </form>
            <p>Already registered? <a href="login_register.php?log=login" id="login-toggler">Log in</a></p>
        </div>
    </div>
    <?php }elseif(isset($_GET['log'])){
        require_once ('auth/loginclass.php');
        $email = ((isset($_POST['email']))?checkInput($_POST['email']):'');
        $email=trim($email);
        $password = ((isset($_POST['password']))?checkInput($_POST['password']):'');
        $errors =[];   
        $password =trim($password); 
        if($_POST){
        // if(hash_equals($csrf, $_POST['csrf'])){           
            // valiate form 
            if(empty($_POST['email'])){
                $errors[] ="<p class ='text-center '>You must provide email</p>";       
            }elseif(empty($_POST['password'])){
                $errors[] ="<p class ='text-center '>You must provide  password</p>";       
            }
            // validate email adress
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[]='Please use a valid email';
            }
            
            // check if no error
            if(!empty($errors)){
                echo displayErrors($errors);
            }else{
            $loginUser = new Login();
            $loginUser->login($email, $password);
            
         }
    }
    
    ?>

    <div class="login-modal">
        <div class="login-content">
            <h4>Users Login</h4> <hr>
               <form action="" method="post">
                <input type="text" placeholder="Email" 
                value="<?php echo ((isset($email))?$email: "") ?>"
                name= "email" class="input-lenght" >
               <input type="password" placeholder="password"class="input-lenght" name ="password" >
               <button>Log in</button>
            </form>
            <p>Not registered? <a href="login_register.php?sign=signup" id="signup">Create Account</a></p>
            <p > <a href="forgetpassword.php" class="text-light">Forgot Password?</a></p>
        </div>
    </div>
    <?php
     } else{ ?>

     <div class="register-defualt-content">
         <button>
             Welcome, You have successfully created your acount. please login to access your dashboard. <br/>
             <a href="login_register.php?log=login">Log in here</a>
         </button>
     </div>

    <?php
     }
    ?>
   
    
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/mainnavbarjs.js"></script>
    <!-- <script src="js/main.js"></script> -->
    <script src="js/categorysearch.js"></script>
</body>
</html>