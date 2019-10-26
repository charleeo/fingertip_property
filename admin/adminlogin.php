<?php
    require_once ('../configuration/db_config.php');
    require_once ('admincontroller/admin_login_logic.php');
        
if($_POST){
    $email = ((isset($_POST['email']))?checkInput($_POST['email']):'');
    $password = ((isset($_POST['password']))?checkInput($_POST['password']):'');
    $errors =[];
        
        $required = ['email', 'password'];
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
        // validate email adress
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[]='<p class="text-center">Please use a valid email</p>';
        }
        
        // errors empty ckeck
            if(!empty($errors)){
        }

        else{
            $register = new AdminLogin();
             $register->adminLogin($email, $password);
        }
    } 
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include ('admin_includes/admin_head.php') ?>
<title>All Published Ads</title>
</head>

<body>   
  <div class="wrapper">
    <?php include ('admin_includes/admintopnav.php') ?>
            
        <div id = "register-users">
        <h4 class="text-center"> Login Form</h4>
            <hr>
            <?php
             if(!empty($errors)){
                echo displayErrors($errors);
        }
            ?>
               <form action="" method="post">
                
               <div class="form-group">
                   <!-- <label for="email">Email Address</label> -->
                    <input type="text" name = "email" placeholder="Email"class="form-control" >
               </div>
                <div class="form-group">
                    <!-- <label for="password">Password</label> -->
                    <input type="password" name ="password" placeholder="Pass word"
                    class="form-control" auto-complete="off" >
                </div>
                 <div class="form-group"> <button>Log In</button> </div>
            </form>
        </div>
    </div>  
</body>
<script src="mycss/js/jquery.js"></script>
<script src="mycss/js/navbarjs.js"></script>
<script src="mycss/dashboardjs/dashboard.js"></script>

</html>