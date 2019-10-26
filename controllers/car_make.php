<?php
class Car{
    public $dbObj;
    public function __construct(){
        $this->dbObj = new Database();
    }
    public function getCarMakers(){
        $sql = "SELECT * FROM car_make ORDER BY maker";
        if($result = $this->dbObj->dbconnector->query($sql)){
            
        $rows =$result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
        return $rows;

    }
   
    public function getCarModel($make_id){
        #write a query to get all local government base on state_id
        $sql = " SELECT car_model.*, car_make.make_id FROM car_model 
        left join car_make on car_model.make_id = car_make.make_id 
         WHERE car_model.make_id='$make_id'";

        if ($result = $this->dbObj->dbconnector->query($sql)) {

         $row =$result->fetch_all(MYSQLI_ASSOC);
        }else{
        return false;
        }
        return $row;
        }
    // public function getRegionForSearch(){
    //     #write a query to get all local government base on state_id
    //     $sql = " SELECT regions.*, states.state_id FROM regions 
    //     left join states on regions.state_id = states.state_id ORDER BY regions.region_name  ";
    //     if($result = $this->dbObj->dbconnector->query($sql)){
        
    //     $rows =$result->fetch_all(MYSQLI_ASSOC);
    //     }else{
    //         return false;
    //     }
    //     return $rows;
    // }
}
