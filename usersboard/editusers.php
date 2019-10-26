<?php
    require_once ("../configuration/db_config.php");
    require_once ("../auth/editusers.php");
    require_once ("../controllers/usersprofilesclass.php");
    if(!is_logged_in()){
        $_SESSION['success_flash']= "You need to log in to access this page";
        header('Location: ../index.php');
     }
    if($_SERVER['REQUEST_METHOD']==='GET'){
       $user_id = checkInput((int)$_GET['information']);
        $user_data = new User;
        $userInfo = $user_data->getUserInfo($user_id);
    }if($_POST){
        $firstname = checkInput($_POST['firstname']);
        $lastname = checkInput($_POST['lastname']);
        $email = checkInput($_POST['email']);
        $designate = checkInput($_POST['designation']);
        $gender = checkInput($_POST['gender']);
        $company = checkInput($_POST['company']);
        $user_id = $_SESSION['user_id'];
        $errors = [];
        $required = ['firstname', 'lastname', 'designation', 'gender', 'company'];
        foreach($required as $require){
            if($_POST[$require]==''){
                $errors[] = "<p class= 'text-center text-danger'>
                    Please fill out all fields
                </p>";
            }
        }
        if(!empty($errors)){
            echo displayErrors($errors);
        }else{
            $updateUser = new EditUser();
            $updateUser->editUsers($firstname, $lastname, $company, $gender, $designate, $user_id);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('usershead.php') ?>
    <title>Edit Acount</title>
</head>
<body>
    <div class="wrapper">
        <?php include ('topnav.php') ?>
        <div class="body-wrapper">
        <?php include ('usersnavigation.php') ?>
            <div class="edit-users">
                    <h4 class="text-center">Update Account</h4>
                    <hr>
                    <form action="" method="post">
                    <div class="form-group">
                    <select name="designation" id="" class="form-control">
                            <option value="">Select Portfolio</option>
                        <?php 
                            $designationArray = ['Chief','Mr', 'Mrs', 'Miss', 'Madam'];
                            foreach($designationArray as $designation){
                        ?>
                            <option value="<?php echo $designation ?>"
                            <?php echo ((isset($userInfo['designation'])
                             && $userInfo['designation']
                             ==$designation)?"selected":"");
                             echo ((isset($designate) && $designate == $designation)?"selected":""); ?>>
                            <?php echo $designation ?></option>
                        <?php } ?>
                        </select>
                        </div>
                        <div class="form-group">
                            <!-- <label for="gender">Gender</label> -->
                        <select name="gender" id="" class="form-control">
                            <option value="">Select gender</option>
                            <option value="Male"
                            <?php echo ((isset($userInfo['gender'])
                             && $userInfo['gender'] =='Male')?"selected":"");
                             echo ((isset($gender)
                             && $gender =='Male')?"selected":""); 
                             ?>
                            > Male</option>
                            <option value="Female"
                            <?php echo ((isset($userInfo['gender']) 
                            && $userInfo['gender'] =='Female')?"selected":"");
                            echo ((isset($gender)
                             && $gender =='Female')?"selected":"");
                            ?>
                            >Female</option>
                        </select> 
                        </div>
                        
                        <div class="form-group">
                            <!-- <label for="role">Role</label> -->
                        <select name="company" id="" class="form-control">
                            <option value="">Select Portfolio</option>
                        <?php 
                            $porfolioArray = ['Property Agent', 'Land Lord', 'Real Estate Agent', 'Cars Dealer'];
                            foreach($porfolioArray as $portfolio){
                        ?>
                            <option value="<?php echo $portfolio ?>"
                            <?php echo ((isset($userInfo['company'])
                             && $userInfo['company']
                             ==$portfolio)?"selected":"");
                             echo ((isset($company) && $company == $portfolio)?"selected":""); ?>>
                            <?php echo $portfolio ?></option>
                        <?php } ?>
                        </select>
                        </div>
                        <div class="form-group">
                            <!-- <label for="firstname">First Name</label> -->
                            <input type="text" name ="firstname" placeholder="First Name" 
                            value="<?php echo ((isset($userInfo['firstname']))? $userInfo['firstname']:"");
                            echo ((isset($firstname))?$firstname:"") ;?>" 
                            class="form-control" >
                        </div>
                        <div class="form-group">
                            <!-- <label for="latname">Last Name</label> -->
                            <input type="text" name = "lastname" placeholder="Last Name "class="form-control"
                            value="<?php echo ((isset($userInfo['lastname']))? $userInfo['lastname']:"");
                            echo ((isset($lastname))?$lastname:"") ; ?>" >
                        </div>   
                        <div class="form-group">
                        <!-- <label for="email">Email Address</label> -->
                            <input type="text" name = "email" placeholder="Email"
                            class="form-control" readonly ="readonly"
                            value="<?php echo ((isset($userInfo['email']))? $userInfo['email']:""); 
                            echo ((isset($email))?$email:"") ;?>">
                        </div>   
                        <input type="hidden" name ="user_id">           
                        <div class="form-group">
                            <button class="form-control">Update</button>
                        </div>
                    </form>
                    <div class="form-group">
                            <button class="form-control">
                            <a href="index.php?information=<?php echo $_SESSION['user_id']; ?>">Cnacel</a>
                            </button>
                    </div>
                    <hr>
              </div>
            </div>
        </div>
</body>
<script src="../mycss/js/jquery.js"></script>
<script src="../mycss/js/navbarjs.js"></script>
<script src="../mycss/dashboardjs/dashboard.js"></script>

</html>