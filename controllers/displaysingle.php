<?php
class DisplaySingleAd{
    public $dbObj;
    public function __construct(){
     
     $this->dbObj =  new Database;
    }
    public function publishSingleAd($PropertyId){
        // global $PropertyId;
        $ads = "SELECT property.*, states.*, regions.*,contact.*, users.* FROM property 
        INNER JOIN states ON states.state_id = property.state_id
        INNER JOIN users ON users.user_id = property.user_id
        INNER JOIN regions ON regions.region_id = property.region_id
        RIGHT JOIN contact ON property.id = contact.property_id
         WHERE property.id ='$PropertyId' AND publish_status = 1 ";
        if($queryResult = $this->dbObj->dbconnector->query($ads)){
            $rowsResults = $queryResult->fetch_assoc();
            // var_dump ($rowsResults);
            return $rowsResults; 
        }else{
            echo "Error".$this->dbObj->dbconnector->error;
        }
    }

    public function getCategoryOne($PropertyId){
        $catQuery = "SELECT property.id, houses.* FROM houses
         INNER JOIN property ON property.id = houses.property_id 
         WHERE property.id = '$PropertyId' ";
        if($result = $this->dbObj->dbconnector->query($catQuery)){
            $resultPerRow = $result->fetch_assoc();
            // print_r($resultPerRow);
            return $resultPerRow;
        }else{
            echo "Error ".$this->dbObj->dbconnector->error;
        }
    }

    public function getCategoryTwo($PropertyId){
        $catQuery = "SELECT property.id, car_make.*, car_model.*, cars.* FROM cars 
        INNER JOIN property ON property.id = cars.property_id
        INNER JOIN car_make ON car_make.make_id = cars.make_id
        INNER JOIN car_model ON car_model.model_id = cars.model_id
         WHERE property.id = '$PropertyId' ";
        if($result = $this->dbObj->dbconnector->query($catQuery)){
            $resultPerRow = $result->fetch_assoc();
            // print_r($resultPerRow);
            return $resultPerRow;
        }else{
            echo "Error ".$this->dbObj->dbconnector->error;
        }
    }

    public function getCategoryThree($PropertyId){
        $catQuery = "SELECT property.id, lands.* FROM lands 
        INNER JOIN property ON property.id = lands.property_id
        WHERE property.id = '$PropertyId' ";
        if($result = $this->dbObj->dbconnector->query($catQuery)){
            $resultPerRow = $result->fetch_assoc();
            // print_r($resultPerRow);
            return $resultPerRow;
        }else{
            echo "Error ".$this->dbObj->dbconnector->error;
        }
    }

    public function getCategoryFour($PropertyId){
        $catQuery = "SELECT property.id, centers.* FROM centers 
        INNER JOIN property ON property.id = centers.property_id
        WHERE property.id = '$PropertyId' ";
        if($result = $this->dbObj->dbconnector->query($catQuery)){
            $resultPerRow = $result->fetch_assoc();
            // print_r($resultPerRow);
            return $resultPerRow;
        }else{
            echo "Error ".$this->dbObj->dbconnector->error;
        }
    }

    // get similar property
    public function publishSimilarAds($PropertyId, $categoryId){
        $ads = "SELECT property.*, states.*, regions.*,contact.*, users.* FROM property 
        INNER JOIN states ON states.state_id = property.state_id
        INNER JOIN users ON users.user_id = property.user_id
        INNER JOIN regions ON regions.region_id = property.region_id
        RIGHT JOIN contact ON property.id = contact.property_id
         WHERE property.id != $PropertyId AND  property.category_id = $categoryId AND  publish_status = 1 ORDER BY RAND() limit 5  ";
        $queryResult = $this->dbObj->dbconnector->query($ads);
        $total= $queryResult->num_rows;
        if($total > 0){
           while($rowsResults = $queryResult->fetch_assoc()){
            $rowArray[] = $rowsResults;
           } 
           return $rowArray;
        }else{
            echo "Error".$this->dbObj->dbconnector->error;
        }
    }
// send message
    public function sendMessage($name, $email,  $message, $propertyId, $categoryId,  $user_id){
        $this->name = $name;
        $this->email = $email;
        $this->user_id = $user_id;
        $this->message = $message;
        $errors = [];
 
        $sql = "INSERT INTO messages(sender, sender_email, message,  user_id)
         VALUES('$name',  '$email', '$message',  '$user_id') ";
         $queryRes = $this->dbObj->dbconnector->query($sql);
         if($queryRes === true){
             echo "success";
            $_SESSION['success_flash']='<p class="text-center text-light">Message sent successfully</p>';
             header("Location: singleproduct/".$propertyId."/".$categoryId."/".$user_id);
         }else{
             echo "Error ".$this->dbObj->dbconnector->error;
         }
        }
}

