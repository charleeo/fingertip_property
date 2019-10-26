<?php
class Recoverpassword{

    public $email, $token, $expire, $selector,  $dbObj;

    public function __construct(){
        $this->dbObj =  new Database;
     }
    public function checkemail($email){
        $this->email = $email;
        $sql = "SELECT email FROM users WHERE email = '$email' ";
       $user= $this->dbObj->dbconnector->query($sql);
       $result = $user->fetch_assoc();
    //    var_dump($result);
       if($result){
        return $result;
       }else{
           echo  $this->dbObj->dbconnector->error;
        //    exit();
       }
    }

    // Send the email and insert the token and the email into the database
    public function sendPasswordEmail($token, $email, $expire, $selector){
        $this->email = $email;
        $this->token = $token;
        $this->expire = $expire;
        $this->selector = $selector;
        $sql = "INSERT INTO password_recovery (reset_email, token, token_expire, selector)
        VALUES ('$email', '$token', '$expire', '$selector')";
        $result = $this->dbObj->dbconnector->query($sql);
        if($result === true){
            return true;
        }else{
            echo  $this->dbObj->dbconnector->error;
        }
    }

    // Delete any already existing token from the database
    public function deleteToken($email){
        $sql = " DELETE FROM password_recovery WHERE reset_email = '$email' ";
        $result = $this->dbObj->dbconnector->query($sql);
        if($result === true){
            return true;
        }else{
            echo  $this->dbObj->dbconnector->error;
        }
    }

    // Reset the password
    public function resetNewPassword($selector, $expire){
        $this->selector = $selector;
        $this->expire = $expire;
        $sql = "SELECT * FROM password_recovery WHERE selector = '$selector' AND token_expire >= '$expire' ";
       $user= $this->dbObj->dbconnector->query($sql);
       $result = $user->fetch_assoc();
       var_dump($result);
       if($result){
        return $result;
       }else{
           echo  $this->dbObj->dbconnector->error;
        //    exit();
       }
    }

    // Update the users table
    public function updateUserPassword($email, $password){
        $this->email = $email;
        $sql = " UPDATE users SET password = '$password' WHERE email = '$email' ";
        $result = $this->dbObj->dbconnector->query($sql);
        if($result == true){
            $_SESSION["success_flash"] = "Your password has be updated, you can now login";
            header("Location: login_register.php?log=login");
        }else{
            echo  $this->dbObj->dbconnector->error;
        }
    }


    // Get the users information fromthe users table and update it

    public function getTheUserInfo($email){
        $this->email = $email;
        $sql = "SELECT * FROM users WHERE email = '$email'  ";
       $user= $this->dbObj->dbconnector->query($sql);
       $result = $user->fetch_assoc();
    //    var_dump($result);
       if($result){
        return $result;
       }else{
           echo  $this->dbObj->dbconnector->error;
        //    exit();
       }
    }
}