<?php
 class AdminRegister{
     public $dbObj;
     public function __construct(){
        $this->dbObj =  new Database;
     }
     public function adminRegister($name,  $email, $password, $role){
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $errors = [];
        // check if email already exist
        $emailQuery = "SELECT * FROM admin WHERE admin_email = '$email' ";
        $result = $this->dbObj->dbconnector->query($emailQuery);
            $resultPerRow = $result->num_rows;
            if($resultPerRow > 0){
                $errors[] = '<span class="errors"> User already exist </span>';
            }if(!empty($errors)){
                echo displayErrors($errors);
            }else{
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);   
        $sql = "INSERT INTO admin(admin_name, admin_email, password, admin_role)
         VALUES('$name', '$email', '$hashpassword', '$role') ";
         $queryRes = $this->dbObj->dbconnector->query($sql);
         if($queryRes === true){
            $_SESSION['success_flash']='Acount created successfully';
             header("Location: admin_register.php");
         }else{
             echo "Error ".$this->dbObj->dbconnector->error;
         }
        }
     }
    }
?>