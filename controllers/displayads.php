<?php
class DisplayAds{
    public $dbObj;
    public function __construct(){
     
     $this->dbObj =  new Database;
    }
    public function publishAds(){
        $ads = "SELECT *  FROM property WHERE publish_status = 1  ";
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
    public function display_page($start_rocord, $records_per_page){
        $sql = "SELECT property.*, states.*, regions.*, users.* FROM property 
        INNER JOIN states ON states.state_id = property.state_id
        INNER JOIN users ON users.user_id = property.user_id
        INNER JOIN regions ON regions.region_id = property.region_id WHERE publish_status =1 ORDER BY refresh_status DESC
        LIMIT $start_rocord,$records_per_page";
        if($queryResult = $this->dbObj->dbconnector->query($sql)){
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

