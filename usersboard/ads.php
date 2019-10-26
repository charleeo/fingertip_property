<?php
   require_once ("../configuration/db_config.php");
   require_once (BASEURL."/controllers/adclass.php"); 
   require_once (BASEURL."/controllers/categoryclass.php"); 
   require_once (BASEURL."/controllers/location.php"); 
   require_once (BASEURL."/controllers/car_make.php"); 
   require_once (BASEURL."/controllers/usersprofilesclass.php");
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   include_once (BASEURL."/PHPMailer/PHPMailer.php");
   include_once (BASEURL."/PHPMailer/Exception.php");
   include_once (BASEURL."/PHPMailer/SMTP.php");


   if(!is_logged_in()){
      $_SESSION['error_flash'] = 
      "<P class='text-warning text-center'>Only registered members can create an ads.
       please login into your  account to create that ads or sign up here if you are new</P>";
       header('refresh:5; errors.php');
      
       echo " <p class='text-success text-center'> You are being redirected</p> ";
      
       exit();
   }
      $region_id='';
      $msg='';
      
      if($_SERVER["REQUEST_METHOD"]=="POST"){ 
         // Collect the seller's E-mail address
         $userId =$_SESSION['user_id'];
         $user = new User();
         $userInfo = $user->getUserInfo($userId);
         $useremail = $userInfo['email'];
         // 

         // Mail settings
         $mail = new PHPMailer();
         $message ="<p>Thank you for using Fingertip platform for your business.</p>
               <p>Your Advert will be published any time soon when the admin has gone through it.
               We appreciate you alot, thanks</p> ";
         $subject ="<h1>Advert Created Alert</h1>";      
         $mail->addAddress($useremail);
         $mail->setFrom("charles@fingertip.com.ng","Admin");
         $mail->Subject= $subject;
         $mail->isHTML(true);
         $mail->Body = $message;
         $error = array();
         // general data
         $price = Property::checkInput(formatNumber($_POST['price']));
         $desc = Property::checkInput($_POST['description']);
         $title = Property::checkInput($_POST['title']);
         $duration = Property::checkInput($_POST['duration']);
         $negotiate = Property::checkInput(((isset($_POST['negotiate']))? $_POST['negotiate']:""));
      
      
         $purpose = checkInput($_POST['purpose']);
         // category 1
         $furnishing = checkInput($_POST['furnishing']);
         $rooms = (int)$_POST['rooms'];
         $bath = (int)$_POST['bathrooms'];
         $room_type = checkInput($_POST['room_type']);        
         $land = Property::checkInput($_POST['land']);
         // category 2
         $make = Property::checkInput($_POST['make']);
         $body_color = Property::checkInput($_POST['body_color']);
         $transmit = Property::checkInput($_POST['transmission']);
         $model = ((isset($_POST['model']))?Property::checkInput($_POST['model']):"");
         $makeyear = Property::checkInput($_POST['makeyear']);
         $mileage = Property::checkInput($_POST['mileage']);
         $status= Property::checkInput($_POST['status']);
         // category 3
        
         $landtype = Property::checkInput($_POST['landtype']);
         $measurement = Property::checkInput($_POST['measurement']);
         $document = Property::checkInput($_POST['document']);

         // category 4
         $type = Property::checkInput($_POST['type']);
         $allowed='';
         if(isset($_POST['allowed'])){
            $allows = $_POST['allowed'];
         $allowed = implode(",", $allows);
         }
         $facility='';
         if(isset($_POST['facility'])){
            $facilities = $_POST['facility'];
         $facility = implode(",", $facilities);
         }
         // contact information
         $phone = Property::checkInput($_POST['phone']);
         $street = Property::checkInput($_POST['street']);
         $site = Property::checkInput($_POST['site']);     
         $state_id = (int)$_POST['states'];    
         $region_id = ((isset($_POST['region_id'])
          && !empty($_POST['region_id']))?Property::checkInput($_POST['region_id']):'');
         // categorie errors check
         $cat_id = (int) $_POST['category_id'];
         $cat_id_er = '';
         
         if($cat_id == ''){
            $cat_id_er ="Please select an option";
         }
         if($cat_id==1){
            $room_er =''; $room_type_er=''; $furnishing_er =''; $bath_er = ''; $purpose_er='';
            $required = ['rooms', 'room_type', 'bathrooms',  'furnishing', 'purpose'];
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
            if(empty($room_type)){
               $room_type_er = "This field is required";
            }
            
            if(empty($furnishing)){
               $furnishing_er = "This field is required";
            }
            if(empty($bath)){
               $bath_er = "This field is required";
            }
            if(empty($purpose)){
               $purpose_er = "select an option";
            }
         }
            
        elseif($cat_id==2){
            $make_er =''; $model_er='';$mileage_er = ''; $status_er=''; $transmit_er='';$makeyear_er='';
            $required = ['model', 'make', 'mileage', 'status','transmission','makeyear'];
            foreach($required as $require){
               if(empty($_POST[$require])){
                  $error[] = "the <label class ='errorcat'>cars</label> category has an empty field, 
                  check that category and fill out every required field";
                  break;
               }
            }
            if(empty($model)){
               $model_er = "The model field is required";
            }
            if(empty($make)){
               $make_er = "The make field is required";
            }
            if(empty($makeyear)){
               $makeyear_er = "The make field is required";
            }
            if(empty($mileage)){
               $mileage_er = "The mile age is required";
            }
            if(empty($status)){
               $status_er = "The  status is required";
            }
            if(empty($transmit)){
               $transmit_er = "Transmission is required";
            }
         }

         elseif($cat_id==3){
            $landtype_er =''; $measurement_er='';$document_er = ''; $purpose_er='';
            $required = ['document', 'landtype', 'measurement','purpose'];
            foreach($required as $require){
               if(empty($_POST[$require])){
                  $error[] = "the <label class ='errorcat'>lands</label> category has an empty field, 
                  check that category and fill out every required field";
                  break;
               }
            }
            if(empty($landtype)){
               $landtype_er = "This field is required";
            }
            if(empty($measurement)){
               $measurement_er = "This field is required";
            }
            if(empty($document)){
               $document_er = "This field is required";
            }
            if(empty($purpose)){
               $purpose_er = "Please select an option";
            }
         }

         elseif($cat_id==4){
            $type_er =''; $purpose_er='';
            if(empty($type)){
               $type_er = "This field is required";
            }
            if(empty($purpose)){
               $purpose_er = "Please select an option";
            }
         }
      // // general errors check

         $price_er=''; $title_er ='';  $desc_er = ''; $purpose_er = ''; $state_er='';
         $generalReq=['price','title','description','states','region_id','street', 'category_id'];
         foreach($generalReq as $gen){
            if(isset($_POST[$gen]) && $_POST[$gen] ==''){
               $error[]="Please check the form and fill all required fields";
               break;
            }
         }
         if($price ==''){
            $price_er = "The price  is required";
         }
         if($title =='' || strlen($title) < 7){
            $title_er = "The title  is required";
         }elseif(strlen($title > 70)){
          $title_er =  "This max character for this field is 70";
         }
         if($desc =='' || strlen($desc)< 15){
            $desc_er = "The min character is 15";
         }
     
           $phone_er =''; $street_er ='';  $region_id_er ='';
        
         if($phone =='' ){
            $phone_er = "The phone field is required";
         }
         if(strlen($street) < 4 || strlen($street)> 250){
            $street_er = "The character range should be between 4 and 250";
         }
         
         if($region_id ==''){
            $region_id_er = "The region field is required";
         }

         if(!empty($error)){
            // echo displayErrors($error);
         
         }else{
         $property = new Property();
         
      
         $property->insertProperty($title, $desc, $price,  $purpose,  $cat_id , $region_id,$state_id, $duration,$negotiate);
         
         $property->createContact( $phone, $street, $site);
         

         // category 1
         if($cat_id==1){
           
           $catOne = $property->categoryOne($rooms, $room_type,  $bath, $land, $furnishing,  $allowed);
          if($catOne){
            if($mail->send()){
               $msg = "Email snet";
            }else{
               $msg= "We could not find the email specified";
            } 

          }
         // category 2
         }elseif($cat_id == 2){
         $property->categoryTwo($make, $model, $status,$mileage, $makeyear,$transmit,$body_color);
        
         // category 3
      }elseif($cat_id ==3){
         $property->categoryThree($measurement, $landtype, $document);
         // category 4
      }elseif($cat_id ==4){
         $property->categoryFour($facility, $type);   
      }
   }
}
?>

<?php
   $page_title ="Advertisement Creation Page";
   include ('usershead.php')
 ?>

<div class="wrapper">
    <span id="top"></span>
    <?php include ('topnav.php') ?>
   
  <div class="body-wrapper">
        <?php include ('usersnavigation.php') ?>  
   
    <form action="ads" method ="post" enctype= "multipart/form-data">
        
        <p class="text-center">
           <?php 
            if(!empty($error)){
               echo displayErrors($error);
            
            }
           ?>
        </p>
      <div class="rigthside"> 
      <h5><b>NOTE</b>: All fields with <em>*</em> are required</h5>
            <!-- Specific Information -->
            <?php include ("ads_details/specifics.php"); ?>

         <!-- General Information -->
            <?php include ("ads_details/general.php"); ?>
        
         <!-- Contact Information -->
               <?php include ("ads_details/contactinfo.php"); ?>
      <section>
         <div class="form-group">
            <button class="form-control bg-success text-light"id="ad-btn" >Post Ad</button> 
         </div>
      </section>
      </div>
     </form>
  </div>
<?php include (BASEURL."/includes/footer.php") ?>
<script src="js/jquery.js"></script>
<script src="js/navbarjs.js"></script>
<script src="js/dashboard.js"></script>

<script>
  
jQuery('document').ready(function() {
	getState('<?= $region_id; ?>');
	$('select[name="states"]').change(function() {
		getState('<?= $region_id; ?>');
	});
});

jQuery('document').ready(function() {
	getModel('<?= $model; ?>');
	$('select[name="make"]').change(function() {
		getModel('<?= $model; ?>');
	});
});

</script>