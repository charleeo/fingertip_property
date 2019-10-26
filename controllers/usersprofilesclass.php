<?php
class User{
    public $dbObj;
    public function __construct(){
       $this->dbObj =  new Database;
    }
    public function getUserInfo($userId){
        $sql = "SELECT * FROM users WHERE user_id = '$userId' ";
        $queryResult = $this->dbObj->dbconnector->query($sql);
        if($queryResult->num_rows > 0){
            $result = $queryResult->fetch_assoc();
            return $result;
        }else{
            echo "No result found for this user ".$this->dbObj->dbconnector->error;
            return false;
        }
       
    }
    public function removeImage($userId){
        $sql = "UPDATE users SET profile_photo ='' WHERE user_id = '$userId' ";
        $output = $this->dbObj->dbconnector->query($sql);
        if($output){
           
            $_SESSION['success_flash']='<p class="text-primary text-center">
            Profile photo removed successfull. Please use the upload button below to upload a new picture</p>';
            header('Location: ../../../dashboard/'.$userId);
            
        }else{
            echo "Error ".$this->dbObj->dbconnector->error;
        }
        return $output;
    }
}
?>