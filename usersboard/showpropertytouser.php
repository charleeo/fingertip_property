<?php
require_once ("../configuration/db_config.php");
require_once ("../controllers/showpropertytouserclass.php");
  if(empty($_SESSION['user_id'])){
     $_SESSION['success_flash']= "You need to log in to access this page";
     header('Location: index.php');
  }
  
if($_SERVER['REQUEST_METHOD']=='GET'){
    $userId =checkInput($_GET['user']);
    $usersAds = new DisplayAds;
    $results = $usersAds->publishAds($userId);
?>
<?php 
$page_title ="Created Ads";
include ('usershead.php')
 ?>
  <div class="wrapper">
    <?php include ('topnav.php') ?>
    <div class="body-wrapper">
        <?php include ('usersnavigation.php') ?>
        <div id='property-users-page'>
            <div class="products">
                <h1>Uploaded Property Information</h1>
               
            </div>
            <hr>
            <?php
            if(!empty($results)){
                foreach($results as $result){
                    $images = explode(',',$result['images']);
            ?>
            <div class="products">
                <div class="property-image">
                    <img src="<?php echo $images[0]; ?>" alt="property photo"> <b>|</b>
                  Publish Status: <?php echo (($result["publish_status"]==0)?" ":"Published") ?> 
                 <?php
                  echo (($result['publish_status']!=0)?" about ".get_time_ago(formatDate($result['published_date'])) : " Anytime soon");
                  ?> <b>|</b>
                  <span><a href="usersboard/editads.php?ads=<?php echo checkInput($result['id']); ?>&category=<?php echo checkInput($result['category_id']); ?>"
                  ><i class="fas fa-edit"> Edit</i></a></span> <b>|</b>
                  <span><a href="singleproduct/<?php
                   echo checkInput($result['id']); ?>/<?php
                    echo checkInput($result['category_id']); ?>/<?php 
                    echo checkInput($result['user_id']); ?>"
                  ><i class="fas fa-view"> View Details</i></a></span>
                  <div> 
                      <span> Title: <?php echo  $result['title']; ?>. <b>|</b></span>
                  Ads Type: <?php echo  $result['ads_type']; ?>. <b>|</b>
                        <span>Boost This Ads and sell 5X faster. Choose premium</span>
                      <select name="" id="">
                      <option value="">Change Ads type</option>
                      <option value="Bronze">Bronze Premium</option>
                      <option value="Silver">Silver Premium</option>
                      <option value="Gold">Golden Premium</option>
                  </select></div>
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
}
?>
        </div>
    </div>  
    <?php include(BASEURL."/includes/footer.php") ?>
<script src="js/jquery.js"></script>
<script src="js/navbarjs.js"></script>
<script src="js/dashboard.js"></script>
