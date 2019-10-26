<?php
require_once ("../configuration/db_config.php");
require_once ("admincontroller/adminadscontroller.php");
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
          jgjgjgjjg
        </div>
    </div>  
  </div>

</body>
<script src="mycss/js/jquery.js"></script>
<script src="mycss/js/navbarjs.js"></script>
<script src="mycss/dashboardjs/dashboard.js"></script>

</html>
