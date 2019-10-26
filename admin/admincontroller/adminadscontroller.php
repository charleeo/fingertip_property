<?php
class DisplayAds{
    public $dbObj;
    public function __construct(){
     $this->dbObj =  new Database;
    }
    
    public function displayAds(){
        $ads = "SELECT property.*, users.* FROM property 
        INNER JOIN users ON users.user_id = property.user_id
        WHERE publish_status = 0 ORDER BY id ";
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
    
    public function publishAds($publish_id){
        date_default_timezone_set('Africa/Lagos');
        $time = date('Y-m-d H:i:s', time());
        $sql = "UPDATE property SET publish_status = 1,  published_date ='$time',  refresh_status ='$time' WHERE id = $publish_id ";
        $queryRes = $this->dbObj->dbconnector->query($sql);
        if($queryRes === true){
            $_SESSION['success_flash']='<p class="text-center text-primary">Property published successfully</P>';
             header("Location: ../unpublished_ads");
        }else{
             echo "Error ".$this->dbObj->dbconnector->error;
            }
    }

    public function displayPublishedAds(){
        $ads = "SELECT property.*, users.* FROM property 
        INNER JOIN users ON users.user_id = property.user_id
        WHERE publish_status = 1 ORDER BY refresh_status ASC ";
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

    public function rePublishhAds($publish_id){
        date_default_timezone_set('Africa/Lagos');
        $time = date('Y-m-d H:i:s', time());
        $sql = "UPDATE property SET refresh_status ='$time' WHERE id = $publish_id ";
        $queryRes = $this->dbObj->dbconnector->query($sql);
        if($queryRes === true){
            $_SESSION['success_flash']='<p class="text-center text-primary">Property refreshed successfully</P>';
             header("Location: ../published_ads");
        }else{
             echo "Error ".$this->dbObj->dbconnector->error;
            }
    }
}


