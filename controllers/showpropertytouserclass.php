<?php
class DisplayAds{
    public $dbObj;
    public function __construct(){
     $this->dbObj =  new Database;
    }
    
    public function publishAds($user_id){
        $ads = "SELECT property.*, users.* FROM property 
        INNER JOIN users ON users.user_id = property.user_id
        WHERE property.user_id = '$user_id' AND publish_status =1 ";
        if($queryResult = $this->dbObj->dbconnector->query($ads)){
            $totalOutput = $queryResult->num_rows;
            if($totalOutput > 0 ){
                while($rowsResults = $queryResult->fetch_assoc()){
                    $rowArray[] = $rowsResults;
                }
                return $rowArray;
            }
        }else{
            echo "Error".$this->dbObj->dbconnector->error;
        }
    }
}

