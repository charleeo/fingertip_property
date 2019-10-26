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
$page_title="Advert Redirect  Page";
 include ('usershead.php') 
 ?>
  <div class="wrapper">
    <?php include ('topnav.php') ?>
        <!-- this is the script to upload profile image -->
        
    <div class="body-wrapper">
        <?php include ('usersnavigation.php') ?>
        <div class="divider" id="redirected-page" style="--image-url:url(../assets/images/defaultBcg.jpeg)">
            <p>Your advert has been created and you will be notify when it is published by the admin after it  has been moderated. <br>
                Best regard from fingertip team.
            </p>
            </div>
        </div>
    </div>  
    <span id="timer"></span>
  <?php include (BASEURL."/includes/footer.php") ?>
<script src="js/jquery.js"></script>
<script src="js/navbarjs.js"></script>
<script src="js/dashboard.js"></script>
<script src="js/main.js"></script>
