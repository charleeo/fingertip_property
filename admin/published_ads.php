<?php
require_once ("../configuration/db_config.php");
require_once ("admincontroller/adminadscontroller.php");
if(empty($_SESSION['admin_id'])){
    header("Location:adminlogin");
}
    $usersAds = new DisplayAds;
    $results = $usersAds->displayPublishedAds();

  if(isset($_GET['refresh_ads'])){
      $refresh_ads_id = checkInput($_GET['refresh_ads']);
      $rePublish = new DisplayAds;
      $rePublish->rePublishhAds($refresh_ads_id );
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
        <div id='property-users-page'>
            <div class="products">
                <h1>Published Property Information</h1>
               
            </div>
            <hr>
            <?php
            if(!empty($results)){
                foreach($results as $result){
                    $images = explode(',',$result['images']);
                    $refresh_status = $result['refresh_status'];
            ?>
            <div class="products">
                <div class="property-image">
                    <img src="<?php echo $images[0]; ?>" alt="property photo"> <b>|</b>
                 <span> Published Date: <?php   echo formatDate($refresh_status) ;?> <b>|</b></span>
                      <span> Ads type: <?php echo  $result['ads_type']; ?>. <b>|</b></span>
                      <?php
                      $checkTime = countTime(20);
                      date_default_timezone_set('Africa/Lagos');
                      $now = strtotime(date("M d, Y h:i A"));
                      $db_date = strtotime($refresh_status);
                      $time_interval = $now - $db_date;
                      $time_past = round(($time_interval/3600)- ($checkTime/3600));
                      $time_remaining = ($checkTime - $time_interval);
                      $time_remaining =round($time_remaining/3600);
                      if( $time_interval >= $checkTime){
                      ?>
                      <span><a href="published_ads/<?php echo $result['id'] ?>">
                      <?php echo $time_past ?> Hour<?php echo (($time_past > 1)?"s":"") ?> Past Due Date. Please Refresh
                      </a></span>
                      <?php }else
                      echo $time_remaining. "&nbsp Hours To Due Date";
                      ?>
                </div>
            </div>
            <hr>
        <?php
        }
    }else{
       echo '<div class="products">
       <p>No Property associated with this account yet</p>
       <p>You can create one by clicking this 
         <a href = "ads.php"><button class="click-button"> page</button> </a> </P>
        </button>
       </div>';
    }

?>
        </div>
    </div>  
  </div>

</body>
<script src="mycss/js/jquery.js"></script>
<script src="mycss/js/navbarjs.js"></script>
<script src="mycss/dashboardjs/dashboard.js"></script>

</html>
