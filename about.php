<!DOCTYPE html>
<html lang="en">
<head>
   <?php
    require_once ("configuration/db_config.php");
    require_once ("controllers/displayads.php"); 
    require_once ("controllers/location.php"); 
    require_once ("controllers/searchcategories.php"); 
    $title ="About Us";
    $description ="We are wweb solution for all property shopping problems";
    $keyWords = "mobile phone, business atmospere";
   include ("includes/head.php") ?>
</head>
<body>
    <div class="wrapper">
        <!-- Navigation -->
       <?php 
       
       include ("includes/navbar.php") ?>
        <!-- Top container -->
       
       
        <!-- Boxes Section -->
        <section class="bo">
           <h1>Who we are:</h1>
           <p>We are web base solution for all property businesses.
           Irespective of where your property is located, we help you showcase it to the world</p>
            <p>We give your property a place in the business atmosphere.
            by helping you reach the highest target audience possible,</p>
            <p>you can shop for a property from the confort of your mobile phone.</p>
        </section>

        <!-- Info Section -->


       
      <?php include("includes/footer.php") ?>
    </div>
    <!-- Wrapper ends -->

   

    <script src="mycss/js/popper.min.js"></script>
    <script src="mycss/js/jquery.js"></script>
    <script src="mycss/js/mainnavbarjs.js"></script>
    <script src="mycss/js/main.js"></script>
 
</body>
</html>