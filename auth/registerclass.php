<?php
 class Register{
     public $dbObj;
     public function __construct(){
        $this->dbObj =  new Database;
     }
     public function register($firstName, $lastName, $email, $password, $company, $gender, $designation, $token){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->company = $company;
        $this->gender = $gender;
        $this->designation =$designation;
        $this->token =$token;
        $errors = [];
        // check if email already exist
        $emailQuery = "SELECT * FROM users WHERE email = '$email' ";
        $result = $this->dbObj->dbconnector->query($emailQuery);
            $resultPerRow = $result->num_rows;
            if($resultPerRow > 0){
                $errors[] = '<span class="errors"> User already exist </span>';
            }if(!empty($errors)){
                echo displayErrors($errors);
            }else{
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);   
        $sql = "INSERT INTO users(firstname, lastname, email, password, company, gender,designation, token)
         VALUES('$firstName', '$lastName', '$email', '$hashpassword', '$company', '$gender', '$designation', '$token') ";
         $queryRes = $this->dbObj->dbconnector->query($sql);
         if($queryRes === true){
            $_SESSION['success_flash']='Acount created successfully. Please visit your email, you will see a link to confirm email';
             header("Location: confirmemail.php");
         }else{
             echo "Error ".$this->dbObj->dbconnector->error;
         }
        }
     }
    }
?>