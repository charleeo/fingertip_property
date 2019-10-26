<?php
    require_once ("../configuration/db_config.php");
    require_once (BASEURL."/controllers/usersprofilesclass.php");
    require_once (BASEURL."/auth/loginclass.php");
  if(empty($_SESSION['user_id'])){
     $_SESSION['success_flash']= "<p class='text-center text-light'>You need to log in to access this page</p>";
     header('refresh:5; ../index.php');
     echo " <p class='text-success text-center'> You are being redirected</p> ";
     exit();
  }
  if($_POST){
    $user_id = $_SESSION['user_id'];
    $user = new Login();
    $user_data = $user->getUserInfoForPasswordChange($user_id);
    $hashed = $user_data['password'];
    $oldPassword = ((isset($_POST['oldPassword']))?checkInput($_POST['oldPassword']):'');
    $oldPassword =trim($oldPassword); 
    $password = ((isset($_POST['password']))?checkInput($_POST['password']):'');
    $password =trim($password); 
    $confirm_password = ((isset($_POST['confirm_password']))?checkInput($_POST['confirm_password']):'');
    $confirm_password =trim($confirm_password); 
    $newHashed = password_hash($password, PASSWORD_DEFAULT);
    // valiate form 
    if(empty($_POST['oldPassword']) ||empty($_POST['confirm_password'])|| empty($_POST['password'])){
        $errors[] ="You must fill out fields";       
    }
    
    // check for password lenght
   elseif(strlen($password) < 6){
        $errors[]="Password must be at leat 6 characters long";
    }
//    check if new password matches confirm
elseif($password != $confirm_password){
    $errors[]='The new password and the confirm password have to match';
}
    // check if password match 
    elseif(!password_verify($oldPassword, $hashed)){
        $errors[]='Oldpassword do not match our records please check your input';
    }
    elseif($oldPassword == $password){
        $errors[]='Oldpassword and new password are still the same. please change it or cancel to go back';
    }
    // check if no error
    if(!empty($errors)){
        echo displayErrors($errors);
    }else{
        // change password
       $user->changePassword($user_id, $newHashed);
        $_SESSION['success_flash']= 'Your password has been updated';
    }
}
?>
<?php
$page_title="Registered Users Profile Page";
 include ('usershead.php') 
 ?>
  <div class="wrapper">
    <?php include ('topnav.php') ?>
        <!-- this is the script to upload profile image -->
    
    <div class="body-wrapper">
        <?php include ('usersnavigation.php') ?>
        <div class="divider">
        <div>
            <h2 class="text-center">Change Password</h2>
            <form action="" method ="POST">
                <div class="form-group">
                    <label for="oldPassword">Old Password:</label>
                    <input type="password" class="form-control" name ="oldPassword"   value ="">
                </div>
                <div class="form-group">
                    <label for="password"> New Password:</label>
                    <input type="password" class="form-control" name ="password"  value ="">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" class="form-control" name ="confirm_password"  value ="">
                </div>

                <div class="form-group">
                    <input type="submit" value = "Change Password" class="btn btn-success"> <br> <br>
                    <a href="index.php" >Cancel Password Change Action</a> 
                   
                </div>
            </form>
        </div>
    </div>
</div>  
    <span id="timer"></span>
  <?php include (BASEURL."/includes/footer.php") ?>
<script src="js/jquery.js"></script>
<script src="js/navbarjs.js"></script>
<script src="js/dashboard.js"></script>
<script src="js/main.js"></script>
