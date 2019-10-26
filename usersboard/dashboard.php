<?php
require_once ("../configuration/db_config.php");
require_once (BASEURL."/controllers/usersprofilesclass.php");
  if(empty($_SESSION['user_id'])){
     $_SESSION['success_flash']= "<p class='text-center text-light'>You need to log in to access this page</p>";
     header('refresh:5; ../index.php');
     echo " <p class='text-success text-center'> You are being redirected</p> ";
     exit();
  }
?>
<?php
$page_title="Registered Users Profile Page";
 include ('usershead.php') 
 ?>
  <div class="wrapper">
    <?php include ('topnav.php') ?>
        <!-- this is the script to upload profile image -->
        <?php
        if(isset($_GET['profilephoto'])){
            $userId = $_SESSION['user_id'];
            $user = new User();
            $userInfo = $user->getUserInfo($userId);
            require_once (BASEURL.'/auth/loginclass.php');
            if($_SERVER["REQUEST_METHOD"]=="POST"){
           
            $photo = new Login();
            
            $profile_photo  = $photo->uploadProfileImage($userId);
            
            }
            ?>
    <div class="login-modal">
        <div class="login-content">
            <h4>Profile Photo 
            <?php echo (($userInfo['profile_photo']==="assets/profilephoto/avater.png"))?"Upload":"Edit"?></h4> <hr>
               <form action="" method="post" enctype="multipart/form-data">
               <div class="form-group">
                    <input type="file"  name= "profilephoto" > <br/> <br/>
                    <button>Up Load</button>                         
               </div>
               <div class="form-group">
                 <button><a href="dashboard/<?php echo checkInput($userId); ?>">Cancel</a> </button> to go back
               </div>
            </form>
        </div>
    </div>
    <!-- the profile image section ends here -->
            <?php
        }else{
        ?>
    <div class="body-wrapper">
        <?php include ('usersnavigation.php') ?>
        <div class="divider">
        
        <?php 
            if($_SERVER["REQUEST_METHOD"]==="GET"){
                $userId = checkInput($_GET['information']);
                $user = new User();
                $userInfo = $user->getUserInfo($userId);
        ?>
            <div id="first">
                <h2 class="text-center"><i class="fas fa-cogs fa-2x"></i></h2><hr>
                <div class="profile-settings">
                    <button>
                        <a href="editusers/<?php echo $userInfo['user_id']; ?>">
                            <i class="fas fa-edit"></i> Profile
                        </a>
                    </button>
                </div>
                
                <div class="profile-settings"><button> <a href="usersboard/changepassword.php"> 
                 <i class="fas fa-edit"></i> change Password</a></button></div>
                <div class="profile-settings"><button><a href ="logout.php">Log Out</a></button></div>
            </div>
            <div id="second">
               
            <h2 class="text-center">Welcome <?php echo $userInfo['designation'].' '; echo $userInfo['firstname'].','; ?> to your profile <i class="fas fa-info fa-2x"></i></h2><hr>
                <div class="profile-info">
                    <div class="button">
                    
                        <img src="<?php echo $userInfo['profile_photo']; ?>" alt="Profile"> <br/>
                        <?php 
                            if($userInfo['profile_photo'] !== '' && $userInfo['profile_photo'] !== 'assets/profilephoto/avater.png'){
                                if(isset($_GET['delete_image'])){
                                    $image_url = BASEURL.$userInfo['profile_photo']; 
                                    unlink($image_url);
                                    $delete =new User();
                                    $delete->removeImage($userId);
                                }
                        ?>
                            <a href="dashboard/delete_image/1/<?php echo $userInfo['user_id'] ?>"
                                class="text-danger delete">
                                <i class="fas fa-edit"> </i> 
                                Profile Photo
                            </a>
                        <?php } elseif($userInfo['profile_photo'] == ''){ ?>
                            <a href="dashboard/profilephoto/1">
                                <i class="fas fa-upload"> </i> Upload new Profile Photo
                            </a>
                        <?php  }elseif($userInfo['profile_photo'] == 'assets/profilephoto/avater.png'){  ?>
                            <a href="dashboard/profilephoto/1">
                                <i class="fas fa-upload"> </i> Upload a Profile Photo
                            </a>
                        <?php  }  ?>  
                    </div class="button">
                </div> <hr>
                <div class="profile-info">
                    <div class="button"> 
                       <h3> Personal Information</h3> <hr/>
                        <span>Portfolio: <?php echo $userInfo['company']; ?></span> <br/>
                        Names: <?php echo $userInfo['firstname'].' '. ' '.$userInfo['lastname']; ?> <br/>
                        Email: <?php echo $userInfo['email']; ?> 
                    </div class="button">
                </div>
                <?php
                    
                }
            }
            ?>
            </div>
        </div>
    </div>  
    <span id="timer"></span>
  <?php include (BASEURL."/includes/footer.php") ?>
<script src="js/jquery.js"></script>
<script src="js/navbarjs.js"></script>
<script src="js/dashboard.js"></script>
<script src="js/main.js"></script>
