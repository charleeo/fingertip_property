    <?php
    require_once ('../configuration/db_config.php');
    require_once ('admincontroller/admin_register_logic.php');
    if($_SESSION['admin_role'] !=="super admin"){
        $_SESSION['error_flash'] = "<p class = 'text-warning text-center'>You dont't have acces to this page</p>";
        header("Location: ../index.php");
    }
        
if($_POST){
    $name = ((isset($_POST['name']))?checkInput($_POST['name']):'');
    $email = ((isset($_POST['email']))?checkInput($_POST['email']):'');
    $Cpassword = ((isset($_POST['Cpassword']))?checkInput($_POST['Cpassword']):'');
    $password = ((isset($_POST['password']))?checkInput($_POST['password']):'');
    $role = ((isset($_POST['role']))?checkInput($_POST['role']):'');
    $errors =[];
        
        $required = ['email', 'name',  'password', 'Cpassword', 'role'];
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
        if($password != $Cpassword){
            $errors[]='<p class="text-center">Password do not match</p>';
        }
        // validate email adress
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[]='<p class="text-center">Please use a valid email</p>';
        }
        
        // errors empty ckeck
            if(!empty($errors)){
        }

        else{
            $register = new AdminRegister();
             $register->adminRegister($name, $email, $password, $role);
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
    <div class="body-wrapper">
        <?php include ('admin_includes/admin_navigation.php') ?>
        <div id = "register-users">
        <h4 class="text-center"> Register New Admin Members</h4>
            <hr>
            <?php
             if(!empty($errors)){
                echo displayErrors($errors);
        }
            ?>
               <form action="" method="post">
            
               <div class="form-group">
                   <!-- <label for="designation">Designation</label> -->
                    <select name="role"  class="form-control">
                        <option value="">Select role</option>
                        <option value="super admin">Super Admin</option>
                        <option value="editor">editor</option>
                        <option value="refresher">Refresher</option>
                        <option value="publisher">Publisher</option>
                    </select> 
                </div>
                <div class="form-group">
                    <!-- <label for="firstname">First Name</label> -->
                    <input type="text" name ="name" placeholder="enter  Name" class="form-control" >
                </div>
                
               <div class="form-group">
                   <!-- <label for="email">Email Address</label> -->
                    <input type="text" name = "email" placeholder="Email"class="form-control" >
               </div>
                <div class="form-group">
                    <!-- <label for="password">Password</label> -->
                    <input type="password" name ="password" placeholder="Pass word"
                    class="form-control" auto-complete="off" >
                </div>
                <div class="form-group">
                    <!-- <label for="Confirmpassword">Confirm Password</label> -->
                    <input type="password"  name = "Cpassword" 
                    placeholder="confirm password" class="form-control">
                </div>
                 <div class="form-group"> <button>Register</button> </div>
            </form>
        </div>
    </div>  
  </div>

</body>
<script src="../mycss/js/jquery.js"></script>
<script src="../mycss/js/navbarjs.js"></script>
<script src="../mycss/dashboardjs/dashboard.js"></script>

</html>