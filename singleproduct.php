<?php
 require_once ("configuration/db_config.php");
 require_once (BASEURL."/controllers/displaysingle.php"); 
?>
    <?php 
    $description ="We help connect sellers and buyers together";
    $keyWords =
     "Buy confortably, sell smarter, get access to real and verified property
                sell like a genius, oline property shop, real estates, cars, houses, shops, mall";
    $title = "Sellers page";
    include (BASEURL.'/includes/head.php')
     ?>
<div class="wrapper">
  <?php include (BASEURL.'/includes/navbar.php');
  // Obtainning the variables for the get request from the displaySingleAd class
  if($_SERVER['REQUEST_METHOD']=='GET'){
    $catId =checkInput($_GET['recognise']);
    $userId =checkInput($_GET['user']);
    $propertyId = checkInput($_GET['recognition']);
    $single = new DisplaySingleAd;
    $singleAd = $single->publishSingleAd($propertyId,$catId,$userId);
    $imageArray = explode(',', $singleAd['images']); 
    if($catId ==2){
      $categoryTwo = new DisplaySingleAd;
      $result = $categoryTwo->getCategoryTwo($catId); 
      }
    if($catId ==3){
      $categoryThree = new DisplaySingleAd;
      $result = $categoryThree->getCategoryThree($catId); 
      }
  ?>
<section class="product">
  <div class="gallery-thumb">        
    <div class='product-section-image' >
         <img src="<?php echo $imageArray[0]?>" alt="Product" class='active' id="currentImage">
            <!-- this area is for the image gallery-modal pop up -->
    </div>
      <div class ="thumbnail-wrapper" id="thumbnail-wrapper">
            <div class="product-thumbnails thumbnails"><img src="<?php echo $imageArray[0]?>" alt="Product"></div>
          <div class="product-thumbnails thumbnails"><img src="<?php echo $imageArray[1]?>" alt="Product"></div>
      <div class="all-image" > 
          <span id = all-images></span> 
            <?php
            $imageCount = count($imageArray);
            if($imageCount > 2){
            ?>
            <span id="plus-sign">+ </span>
          <div class="thumbnails"><img src="<?php echo $imageArray[2]?>" alt="Product" ></div>
            <?php } ?>
      </div>
     
    </div>
     <h1 id="title"><?php echo $singleAd['title'] ?>
         <i class="fa fa-map-marker "></i> IN
         <?php echo $singleAd['region_name'] ?> OF <?php echo $singleAd['state_name'] ?> state
     </h1>
    </div>
   <!-- it end here -->
    <div id = "price">
      <div class="product-general-info">
        <h3 class ="product-price">
        &#8358 <?php echo number_format($singleAd['price']) ?>
        </h3>
        <hr>
       <p class= "profile-image"><img src="<?php echo $singleAd['profile_photo'] ?>" alt="profile photo"></p>  
         <p class= "profile-image"><?php echo $singleAd['firstname'] ?></p>
          <p class= "profile-image"> <?php echo $singleAd['company'] ?> </p> <hr> 
         <h3 class="product-price"> <span id = "show-contact">Show Contact</span>
         <span id ="sellers-phone"><?php echo ($singleAd['phone']) ?></span> </h3> 
        </div>
         <address class="location_info"><i class="fa fa-map-marker "></i>
         <?php echo $singleAd['region_name'] ?> IN <?php echo $singleAd['state_name'] ?> state
        </address> 
     </div>
   </section>
<!-- contact section -->
   <button id="button">click here to connect with seller</button>
    <?php 
        include (BASEURL."/includes/contactseller.php");  
    ?>
<!-- End of contact section -->
            <!-- Property features and details  -->
        <?php include (BASEURL."/includes/categories_features.php")?>
  <!-- end of sellers and single product details page -->
    <hr>
    <section class="details">
      <h3 class="text-center">Detailed Description</h3>
      <p><?php echo nl2br($singleAd['description']) ?></p>
    </section>
  
      <h2 class="text-center">Similar Property</h2>
     <?php 
     include (BASEURL."/includes/similars.php");
     include (BASEURL.'/includes/modals.php') ;
     include (BASEURL.'/includes/footer.php');
    ?>            
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/mainnavbarjs.js"></script>
    <script src="js/singlepage.js"></script>
<?php } 
?>

