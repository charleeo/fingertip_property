<?php
  class Property{
    public function __construct(){
     
    $this->dbObj =  new Database;
    }    
       public static function checkInput($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = addslashes($data);
            return	$data;
    }
   
     
    public function insertProperty($title, $desc, $price, $purpose, $cat_id,
     $region_id, $state_id, $duration, $negotiate)
      {
        $this->title= $title;
        $this->desccription = $desc;
        $this->price  =$price;
        $this->purpose =$purpose;
        $this->cat_id = $cat_id;
        $this->region_id =$region_id;
        $this->state_id =$state_id;
        $this->negotiate = $negotiate;
        $this->duration =$duration;
       $userID = $_SESSION['user_id'] ;
        $errors= array()   ;
       $lastInsertId='';
        $photoCount = count($_FILES['images']['name']);
        $allowed = array('png', 'jpg', 'jpeg', 'gif');
        $tmpLoc = array();
        $errors =[];
        $uploadPath =array();
        $dbpath='';
      if( $photoCount >= 3)
          {
            for($i =0; $i < $photoCount; $i++){
             
            $files = $_FILES['images'];
            $name = $files['name'][$i];
            $nameArray = explode('.',$name);
            $fileName = $nameArray[0];
            $fileExt = $nameArray[1];
            $mime = explode('/', $files['type'][$i]);
            $mimeType = $mime[0];
            $mimeExt = $mime[1];
            $tmpLoc[] = $files['tmp_name'][$i];
            $fileSize = $files['size'][$i];
            $uploadName = time().$i.'.'.$fileExt;
            $uploadPath[] = BASEURL.'assets/ads_images/'.$uploadName;
            if($i !=0)
              {
                $dbpath.=',';
              }
            $dbpath.= 'assets/ads_images/'.$uploadName;
           
          if($mimeType != 'image'){
            $errors[] = "The file must be an image.";
          }
          if(!in_array($fileExt, $allowed))
          {
                          $errors[] = 'The file extension must be a png, jpg, jpeg, or gif';
          }
          if($fileSize > 3000000)
          {
                          $errors[] = 'The file size must be under 3MB';
          }
          if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg'))
          {
                          $errors[] = 'File extension does not match the file.';
          
           }
          }
        
          if(!empty($errors))
          {
          echo displayErrors($errors); 
          }
          else
          {
            if($photoCount > 0)
            {
              for($i = 0; $i < $photoCount; $i++){
              move_uploaded_file($tmpLoc[$i], $uploadPath[$i]);
              
              } 
        }
        
        $sql ="INSERT INTO property (images, title, category_id, description, price, purpose, region_id, state_id, rent_duration, negotiable, user_id)
         VALUES('$dbpath', '$title','$cat_id','$desc','$price','$purpose','$region_id', '$state_id','$duration','$negotiate','$userID')";
        if($this->dbObj->dbconnector->query($sql)===true){
          global $lastInsertId;
          $lastInsertId = $this->dbObj->dbconnector->insert_id;
        }else{
          echo $this->dbObj->dbconnector->error;
        }
      }
    }else{
      echo "<span class ='errors'>Please check the 
      <label class ='errorcat'>General Information 
      </label> section and select at least three files</span>";
    }    
}

  public function categoryOne($rooms, $room_type,  $bath, $land, $furnishing,  $allowed){
   global $lastInsertId;
    $this->rooms =$rooms;
    $this->room_type =$room_type;
    $this->bathrooms =$bath;
    $this->land =$land;
    $this->furnishing =$furnishing;
    $this->allowed = $allowed;
    if($lastInsertId !== null){
      $sql2 ="INSERT INTO houses(rooms, room_type,  bathrooms, land, furnishing, allowed, property_id)
         VALUES('$rooms', '$room_type', '$bath', '$land', '$furnishing',  '$allowed', '$lastInsertId')";
        if($this->dbObj->dbconnector->query($sql2)==true){
          $_SESSION['success_flash']='<p  class="bg-success text-center text-light">Advertisement created successfully.
          <br> Please note that your ad will be moderated by the admin before it will be published. <br>
           Thanks once again for stopping by</p>';
           redirectpage();
        }else{
          echo $this->dbObj->dbconnector->error;
        }
      }
  } 

  public function categoryTwo($make, $model, $status,$mileage, $makeyear, $transmit,$body_color){
     global $lastInsertId;
     $this->make =$make;
     $this->body_color = $body_color;
     $this->transmit = $transmit;
     $this->model =$model;
     $this->mileage =$mileage;
     $this->status =$status;
     $this->makeyear =$makeyear;
    if($lastInsertId !==null){
         $sql3 ="INSERT INTO cars(make, model, mileage, `status`, makeyear, transmission, color,  property_id)
          VALUES('$make', '$model','$mileage', '$status', '$makeyear', '$transmit', '$body_color', '$lastInsertId')";
         if($this->dbObj->dbconnector->query($sql3)==true){
          $_SESSION['success_flash']='<p  class="bg-success text-center text-light">Advertisement created successfully.
          <br> Please note that your ad will be moderated by the admin before it will be published. <br>
          Thanks once again for stopping by</p>';
          redirectpage();
         }else{
           echo $this->dbObj->dbconnector->error;
         }
      }
   }

   public function categoryThree($measurement, $landtype, $document){
    global $lastInsertId;
    $this->document = $document;
    $this->measurement =$measurement;
    $this->landtype =$landtype;
    if($lastInsertId !==null){
        $sql4 ="INSERT INTO lands(measurement, land_type, documents, property_id)
          VALUES('$measurement', '$landtype', '$document', '$lastInsertId')";
          if($this->dbObj->dbconnector->query($sql4)==true){
            $_SESSION['success_flash']='<p  class="bg-success text-center text-light">Advertisement created successfully.
            <br> Please note that your ad will be moderated by the admin before it will be published. <br>
            Thanks once again for stopping by</p>';
            redirectpage();
        }else{
          echo $this->dbObj->dbconnector->error;
        }
      }
  }

  public function categoryFour($facility, $type){
    global $lastInsertId;
    $this->facility = $facility;
    $this->type =$type;
    if($lastInsertId !==null){
        $sql5 ="INSERT INTO centers(facility, type,  property_id)
          VALUES('$facility', '$type', '$lastInsertId')";
          if($this->dbObj->dbconnector->query($sql5)==true){
            $_SESSION['success_flash']='<p  class="bg-success text-center text-light">Advertisement created successfully.
            <br> Please note that your ad will be moderated by the admin before it will be published. <br>
             Thanks once again for stopping by</p>';
             redirectpage();
        }else{
          echo $this->dbObj->dbconnector->error;
        }
      }
  }

   public function createContact( $phone, $street,$site){
    global $lastInsertId;
     $this->phone =$phone;
     $this->street =$street;
     $this->site =$site;
     if($lastInsertId !== null){
     $contactQuery ="INSERT INTO contact(phone, address, site,  property_id)
          VALUES('$phone','$street', '$site',  '$lastInsertId')";
         if($this->dbObj->dbconnector->query($contactQuery)===TRUE){
           return true;
         }else{
           echo $this->dbObj->dbconnector->error;
         }
      }
   } 
}
?>
