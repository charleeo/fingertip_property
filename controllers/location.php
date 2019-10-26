<?php
class Location{
    public $dbObj;
    public function __construct(){
        $this->dbObj = new Database();
    }
    public function getState(){
        $sql = "SELECT * FROM states";
        if($result = $this->dbObj->dbconnector->query($sql)){
            
        $rows =$result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
        return $rows;

    }
    public function getRegion($state_id){
        #write a query to get all local government base on state_id
        $sql = " SELECT regions.*, states.state_id FROM regions 
        left join states on regions.state_id = states.state_id 
         WHERE regions.state_id='$state_id'";

        if ($result = $this->dbObj->dbconnector->query($sql)) {

         $row =$result->fetch_all(MYSQLI_ASSOC);
        }else{
        return false;
        }
        return $row;
        }
    public function getRegionForSearch(){
        #write a query to get all local government base on state_id
        $sql = " SELECT regions.*, states.state_id FROM regions 
        left join states on regions.state_id = states.state_id ORDER BY regions.region_name  ";
        if($result = $this->dbObj->dbconnector->query($sql)){
        
        $rows =$result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
        return $rows;
    }
}
