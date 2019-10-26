<?php
   require_once ("../configuration/db_config.php");
   require_once ("../controllers/displaysingle.php");
   require_once ("../controllers/updateads.php"); 
   require_once ("../controllers/categoryclass.php"); 
   require_once ("../controllers/location.php"); 
   if(!is_logged_in()){
      $_SESSION['error_flash']= 
      "<P class='text-warning text-center'>Only real people can create an ads.
       please login into your  account to create that ads or sign up here if you are new</P>";
      header('Location: ../errors.php');
   }
        // to return the old values from database
      if($_SERVER['REQUEST_METHOD']==='GET'){
        $category = checkInput($_GET['category']);
        $propertyId = checkInput($_GET['ads']);
        $editView = new DisplaySingleAd();
        $viewResult= $editView->publishSingleAd($propertyId);
        // Get category one
        $catone = $editView->getCategoryOne($propertyId);
        $cattwo = $editView->getCategoryTwo($propertyId);
        $catthree = $editView->getCategoryThree($propertyId);
      }
      $propertyId = checkInput($_GET['ads']);
      $category = checkInput($_GET['category']);
        $error = array();
        $updateInfo = new UpdateAds();       
      if(isset($_POST['general'])){ 
         
         // general data
         $price = checkInput(formatNumber($_POST['price']));
         $desc = checkInput($_POST['description']);
         $title = checkInput($_POST['title']);
         $purpose = checkInput($_POST['purpose']);
         $generalRequired =['title', 'price', 'purpose', 'description'];
               $price_er=''; $title_er ='';  $desc_er = ''; $purpose_er = '';
               if($price ==''){
                  $price_er = "The price  is required";
               }
               if($title ==''){
                  $title_er = "The title  is required";
               }
               if($desc ==''){
                  $desc_er = "The description is required";
               }
               if($purpose ==''){
                  $purpose_er = "This field is required";
               }
            foreach($generalRequired as $require){
               if($_POST[$require]==''){
                  $error[]="The <label class = 'errorcat'>General information</label> 
                           section has an empty required filed please fill it out ";
                  break;
                  }
               }
               if(!empty($error)){
                  echo displayErrors($error);
               }else{
         $updateInfo->updateGeneralInformation($title, $desc, $purpose, $price, $propertyId);
         $_SESSION['success_flash'] = '<p class="text-primary text-center bg-success">Updated successfull</p>';
         header('Location: editads.php?ads='.$propertyId.'&category='.$category);
         }
      }
      // contact information
      if(isset($_POST['contact'])){
         var_dump($_POST); 
         
         // general data
         $site = ((isset($_POST['site']) && $_POST['site'] !='')?checkInput($_POST['site']):"");
         $city = checkInput($_POST['city']);
         $street = checkInput($_POST['street']);
         $phone = checkInput($_POST['phone']);
         $region_id = '';
         if(isset($_POST['region_id'])){$region_id= checkInput($_POST['region_id']);}
         $state_id = checkInput($_POST['states']);
         $requireContact = ['phone',  'city', 'street', 'states', 'region_id'];
            foreach($requireContact as $contact){
               if(!isset($_POST[$contact]) || $_POST[$contact] == ''){
                  $error[] = "The <label class = 'errorcat'>Contact information</label> 
                  section has an empty required filed please fill it out ";
                  break;
               }
            }
           
              $phone_er =''; $street_er =''; $city_er = ''; $region_id_er ='';
               if($phone ==''){
                  $phone_er = "The phone field is required";
               }
               if($street ==''){
                  $street_er = "The street field is required";
               }
               if($city ==''){
                  $city_er = "The city field is required";
               }
               if($region_id ==''){
                  $region_id_er = "The region field is required";
               }
      
               if(!empty($error)){
                  echo displayErrors($error);
               }else{
               $updateInfo->updateContactInformation($phone, $site, $city, $street, $region_id, $state_id, $propertyId);
               $_SESSION['success_flash'] = '<p class="text-primary text-center bg-success">Updated successfull</p>';
               header('Location: editads.php?ads='.$propertyId.'&category='.$category);
         }
      }
      if(isset($_POST['category'])){
         // Category 1
         if($category ==1){
            $age =$_POST['age'];
            $rooms = (int)$_POST['rooms'];
            $bath = (int)$_POST['bathrooms'];
            $toilets = (int)$_POST['toilets'];        
            $land = checkInput($_POST['land']);
            $facility='';
            if(isset($_POST['facility'])){
               $facilities = $_POST['facility'];
            $facility = implode(",", $facilities);
            }
            if($category==1){
               $room_er =''; $toilets_er=''; $age_er =''; $bath_er = ''; $land_er='';
               $required = ['rooms', 'toilets', 'bathrooms',  'age'];
               foreach($required as $require){
                  if(empty($_POST[$require])){
                     $error[] = "the <label class ='errorcat'>houses</label> category has an empty field, 
                     check that category and fill out every required field";
                     break;
                  }
               }
               
               if(empty($rooms)){
                  $room_er = "The room field is required";
               }
               if(empty($toilets)){
                  $toilets_er = "The toilet field is required";
               }
               
               if(empty($age)){
                  $age_er = "This field is required";
               }
               if(empty($bath)){
                  $bath_er = "This field is required";
               }
               // /^[1-9][0-9]{0,15}$/
               // $expr = '/^[1-9][0-9]*$/';
               // if (preg_match($expr, $id) && filter_var($id, FILTER_VALIDATE_INT)) {
               //     echo 'ok';
               // } else {
               //     echo 'nok';
               // }
               if(!preg_match('/^[0-9,]*$/', $land)){
                  $land_er ="Please enter the specified parameters as stated above";
                  $error[] ="The land field in the category section has an error. Please fill appropraitely";
               }
            }
            
            if(!empty($error) || !empty($land_er)){
               echo displayErrors($error);
            }else{
            $updateInfo->updateCategoryOneC($rooms,$bath, $toilets,$land, $age, $facility, $propertyId);
            $_SESSION['success_flash'] = '<p class="text-primary text-center bg-success">Updated successfull</p>';
            header('Location: editads.php?ads='.$propertyId.'&category='.$category);
         }
      }
      
      // Beginning of category 3
   }
         // category 1
   //       $age =$_POST['age'];
   //       $rooms = (int)$_POST['rooms'];
   //       $bath = (int)$_POST['bathrooms'];
   //       $toilets = (int)$_POST['toilets'];        
   //       $land = checkInput($_POST['land']);
   //       // category 2
   //       $make = checkInput($_POST['make']);
   //       $model = checkInput($_POST['model']);
   //       $mileage = checkInput($_POST['mileage']);
   //       $status= checkInput($_POST['status']);
   //       $engine = checkInput($_POST['engine']);
   //       // category 3
        
   //       $landtype = checkInput($_POST['landtype']);
   //       $measurement = checkInput($_POST['measurement']);
   //       $document = checkInput($_POST['document']);

   //       // category 4
   //       $type = checkInput($_POST['type']);
   //       $facility='';
   //       if(isset($_POST['facility'])){
   //          $facilities = $_POST['facility'];
   //       $facility = implode(",", $facilities);
   //       }
   //       // categorie errors check
   //       $cat_id = (int) $_POST['category_id'];
   //       $cat_id_er = '';
   //       if($cat_id == ''){
   //          $error[] = "Please choose a category from the <label class = 'errorcat'>Category section</label>";
   //       }
   //       if($cat_id==1){
   //          $room_er =''; $toilets_er=''; $age_er =''; $bath_er = '';
   //          $required = ['rooms', 'toilets', 'bathrooms',  'age'];
   //          foreach($required as $require){
   //             if(empty($_POST[$require])){
   //                $error[] = "the <label class ='errorcat'>houses</label> category has an empty field, 
   //                check that category and fill out every required field";
   //                break;
   //             }
   //          }
   //          if(empty($rooms)){
   //             $room_er = "The room field is required";
   //          }
   //          if(empty($toilets)){
   //             $toilets_er = "The toilet field is required";
   //          }
            
   //          if(empty($age)){
   //             $age_er = "This field is required";
   //          }
   //          if(empty($bath)){
   //             $bath_er = "This field is required";
   //          }
   //       }
            
   //      elseif($cat_id==2){
   //          $make_er =''; $model_er='';$mileage_er = ''; $status_er='';
   //          $required = ['model', 'make', 'mileage', 'status'];
   //          foreach($required as $require){
   //             if(empty($_POST[$require])){
   //                $error[] = "the <label class ='errorcat'>cars</label> category has an empty field, 
   //                check that category and fill out every required field";
   //                break;
   //             }
   //          }
   //          if(empty($model)){
   //             $model_er = "The model field is required";
   //          }
   //          if(empty($make)){
   //             $make_er = "The make field is required";
   //          }
   //          if(empty($mileage)){
   //             $mileage_er = "The mile age is required";
   //          }
   //          if(empty($status)){
   //             $status_er = "The  status is required";
   //          }
   //       }

   //       elseif($cat_id==3){
   //          $landtype_er =''; $measurement_er='';$document_er = '';
   //          $required = ['document', 'landtype', 'measurement',];
   //          foreach($required as $require){
   //             if(empty($_POST[$require])){
   //                $error[] = "the <label class ='errorcat'>lands</label> category has an empty field, 
   //                check that category and fill out every required field";
   //                break;
   //             }
   //          }
   //          if(empty($landtype)){
   //             $landtype_er = "This field is required";
   //          }
   //          if(empty($measurement)){
   //             $measurement_er = "This field is required";
   //          }
   //          if(empty($document)){
   //             $document_er = "This field is required";
   //          }
   //       }

   //       elseif($cat_id==4){
   //          $type_er ='';
   //          $required = ['type'];
   //          foreach($required as $require){
   //             if(empty($_POST[$require])){
   //                $error[] = "the <label class ='errorcat'>Event and Centers </label> category has an empty field, 
   //                check that category and fill out every required field";
   //                break;
   //             }
   //          }
   //          if(empty($type)){
   //             $type_er = "This field is required";
   //          }
   //       }
   //    // // general errors check

   //       $generalRequired =['title', 'price', 'purpose', 'description'];
   //       $price_er=''; $title_er ='';  $desc_er = ''; $purpose_er = '';
   //       if($price ==''){
   //          $price_er = "The price  is required";
   //       }
   //       if($title ==''){
   //          $title_er = "The title  is required";
   //       }
   //       if($desc ==''){
   //          $desc_er = "The description is required";
   //       }
   //       if($purpose ==''){
   //          $purpose_er = "This field is required";
   //       }
   //    foreach($generalRequired as $require){
   //       if($_POST[$require]==''){
   //          $error[]="The <label class = 'errorcat'>General information</label> 
   //                   section has an empty required filed please fill it out ";
   //          break;
   //          }
   //       }
   //    // contact adress error check
   //    $requireContact = ['phone', 'email', 'city', 'street', 'states', 'region_id'];
   //    foreach($requireContact as $contact){
   //       if($_POST[$contact] == ''){
   //          $error[] = "The <label class = 'errorcat'>Contact information</label> 
   //          section has an empty required filed please fill it out ";
   //          break;
   //       }
   //    }
     
   //       $email_er = '';  $phone_er =''; $street_er =''; $city_er = ''; $region_id_er ='';
   //       if($email ==''){
   //          $email_er = "The email field is required";
   //       }
   //       if($phone ==''){
   //          $phone_er = "The phone field is required";
   //       }
   //       if($street ==''){
   //          $street_er = "The street field is required";
   //       }
   //       if($city ==''){
   //          $city_er = "The city field is required";
   //       }
   //       if($region_id ==''){
   //          $region_id_er = "The region field is required";
   //       }

   //       if(!empty($error)){
   //          echo displayErrors($error);
         
   //       }else{
   //       $property = new Property();
         
      
   //       $property->insertProperty($title, $desc, $price,  $purpose,  $cat_id , $region_id,$state_id);
   //       $property->createContact($email, $phone, $street, $site, $city);
         

   //       // category 1
   //       if($cat_id==1){
           
   //          $property->categoryOne($rooms, $toilets,  $bath, $land, $age,  $facility);          
              
   //       // category 2
   //       }elseif($cat_id == 2){
   //       $property->categoryTwo($make, $model, $status,$mileage, $engine);
        
   //       // category 3
   //    }elseif($cat_id ==3){
   //       $property->categoryThree($measurement, $landtype, $document);
        
   //       // category 4
   //    }elseif($cat_id ==4){
   //       $property->categoryFour($facility, $type);
         
   //    }
   // }

?>


<?php
$page_title ="Edit ads page";
 include ('usershead.php')
?>
</head>

<div class="wrapper">
    <span id="top"></span>
    <?php include ('topnav.php') ?>
   
  <div class="body-wrapper">
        <?php include ('usersnavigation.php') ?>  
       <div>
       <?php
       if(isset($_SESSION['success_flash'])){
         echo '<div class = "bg-success">'
         .$_SESSION['success_flash'].'</div>';
         unset($_SESSION['success_flash']);
     }
       ?>
        <div class="content-info">
                <button type="button" class=" side-bar" id="gen"> <i class="fas fa-edit"></i> Eidt General Info</button>
                <button type="button" class=" side-bar" id="spec"> <i class="fas fa-edit"></i> Edit Categories</button>
                <button type="button" class=" side-bar" id="cont"> <i class="fas fa-edit"></i> Edit Contact Info</button>
                <button type="button" class=" side-bar " id="prev"> <i class="fas fa-edit"></i> Edit Images</button>
        </div>
        <h5><b>NOTE</b>: All fields with <em>*</em> are required</h5>
        <span class="text-warning bg-success">
        <?php             
            if(isset($_SESSION['success_flash'])){
                echo '<div class = "bg-success"><p 
                class ="text-success text-center">'
                .$_SESSION['success_flash'].'</p></div>';
                unset($_SESSION['success_flash']);
            }
        ?>
    </span>
        <div class="rigthside"> 
        <div id="step0">
                <h1>Advertisement update form</h1>
                <p>Use the grey buttons at the to navigate to the various sections of 
                    the form and update your  ads in a moment </p>
                <p>It is quite easy and fun to do </p>
         </div>
         
         <div id="prev_contents" style="display:none">
         <form action="editads" method ="post" enctype ="multipart/form-data"></form>
         <section id="add_more">
            <div class="form-group">
                <p id="file-info">Use the add more button to create more files input if your device does
                     not support multiple files selection . <br> Or if your device supports
                 multiple file selection you can select multiple files using the files input below</p>
            </div>
            <div class="form-group">
                <button id="add" type ="button">Add More</button>
                <button id="removebtn" type ="button">Remove</button>
            </div>
            <div class="form-group"> 
                <label for="files1">Image 1 <em>*</em>.</label>
                <input type="file" name="images[]" class="form-control" multiple
                value ="<?php echo ((isset($_POST['images']['name']))? $_FILES['images']['name']:"" ) ?>">
                <span class="errors"><?php if(isset($image_er) ){echo $image_er;} ?></span>
            </div>
            <div class="form-group">
                <button class="form-control bg-success text-primary">Update Information</button>
            </div>
        </section>
        </form>
         </div>
         <!-- Contact Information -->
        
         <div id="step3">
               <?php include ("ads_details/edit_contact.php");?>
         </div>

         <!-- General Information -->
         <div id="step1">
            <?php include ("ads_details/edit_general_information.php"); ?>
         </div>

         <!-- Specific Information -->
         <div id="step2">
            <?php include ("ads_details/edit_category.php"); ?>
         </div>
         
        
        
        </div> 
  </div>

<script src="js/jquery.js"></script>
<script src="js/navbarjs.js"></script>
<script src="js/dashboard.js"></script>

<script>
  
jQuery().ready(function() {
	$('select[name="states"]').change(function() {
      getState("<?= $viewResult['region_id']; ?>");
   });
   $("#spec").click(function(){
      document.getElementById("step2").style.display= "grid";
      document.getElementById("step1").style.display= "none";
      document.getElementById("step3").style.display= "none";
      document.getElementById("spec").classList.add("active");
      document.getElementById("gen").classList.remove("active");
      document.getElementById("cont").classList.remove("active");
   })
   $("#gen").click(function(){
      document.getElementById("step2").style.display= "none";
      document.getElementById("step1").style.display= "grid";
      document.getElementById("step3").style.display= "none";
      document.getElementById("spec").classList.remove("active");
      document.getElementById("gen").classList.add("active");
      document.getElementById("cont").classList.remove("active");
   })
   $("#cont").click(function(){
      document.getElementById("step3").style.display= "grid";
      document.getElementById("step1").style.display= "none";
      document.getElementById("step2").style.display= "none";
      document.getElementById("spec").classList.remove("active");
      document.getElementById("gen").classList.remove("active");
      document.getElementById("cont").classList.add("active");
   })
});
</script>

</html>