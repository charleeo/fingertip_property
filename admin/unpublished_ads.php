<?php
require_once ("../configuration/db_config.php");
require_once ("admincontroller/adminadscontroller.php");
    $total = 0;
    $usersAds = new DisplayAds;
    $results = $usersAds->displayAds();
    if(!empty($results)){
        $total = count($results);
    }
  if(isset($_GET['publish'])){
      $publish_id = checkInput($_GET['publish']);
      $publish = new DisplayAds;
      $publish->publishAds($publish_id);
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include ('admin_includes/admin_head.php') ?>
<title>Users Profile</title>
</head>

<body>   
  <div class="wrapper">
    <?php include ('admin_includes/admintopnav.php') ?>
    <div class="body-wrapper">
        <?php include ('admin_includes/admin_navigation.php') ?>
        <div id='property-users-page'>
            <div class="products">
                <h1><span class="badge"><?php echo $total ?></span> Ad<?php echo (($total > 1)?"s": "") ?> Yet To Be Published</h1>
            </div>
            <hr>
            <?php
            if(!empty($results)){
               
                foreach($results as $result){
                    $images = explode(',', $result['images']);
            ?>
            <div class="products">
                <div class="property-image">
                    <img src="<?php echo $images[0]; ?>" alt="property photo"> <b>|</b>
                   Price: &#8358 <?php echo  $result['price']; ?> <b>|</b>
                   For: <?php echo  strtoupper($result['purpose']); ?> <b>|</b>
                  Publish Status: <?php echo (($result["publish_status"]==0)?"Not Published":"Published") ?> <b>|</b>
                  Published Date: <?php
                  echo (($result['published_date']!='')?formatDate($result['published_date']) : "Anytime soon");
                  ?> 
                  <div> 
                      <span> Title: <?php echo  $result['title']; ?>. <b>|</b></span>
                      <span><a href="unpublished_ads/<?php echo $result['id'] ?>">Publish this ads</a></span>
                  </div>
                </div>
            </div>
            <hr>
        <?php
        }
    }else{
       echo '<div class="products">
       <p class="text-center">No More  Ads to publish</p>
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
