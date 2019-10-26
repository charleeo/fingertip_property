<?php
 class EditUser{
     public $dbObj;
     public function __construct(){
        $this->dbObj =  new Database;
     }
     public function editUsers($firstName, $lastName,  $company, $gender, $designation, $user_id){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->company = $company;
        $this->gender = $gender;
        $this->designation =$designation;
        date_default_timezone_set('Africa/Lagos');
        $time = date('Y-m-d H:i:s', time());
         
        $sql = "UPDATE users SET firstname ='$firstName', lastname = '$lastName', dateupdated = '$time',
        company = '$company', gender = '$gender' ,designation ='$designation' WHERE user_id ='$user_id' ";
         $queryRes = $this->dbObj->dbconnector->query($sql);
         if($queryRes === true){
            $_SESSION['success_flash']='<p class="text-center text-primary">Acount Updated successfully</P>';
             header("Location: ../dashboard/".$user_id);
         }else{
             echo "Error ".$this->dbObj->dbconnector->error;
            }
        }
    }
?>