<?php
class Login{
    public $dbObj;
    public function __construct(){
       $this->dbObj =  new Database;
    }
    public function login($email, $password){
      
        $sql = " SELECT * FROM users WHERE email ='$email'   LIMIT 1 ";
        $users = $this->dbObj->dbconnector->query($sql);
        $result = $users->fetch_assoc();
        if(!$result){
          $errors[]= "<p class ='text-center'> We could not find this record with us. 
            Please be sure you're entering the right inputs</p>";
        }
        // check if password match 
        elseif(!password_verify($password, $result['password'])){
          $errors[]= "<p class= 'text-center'>Incorrect password or email </p>";
        }
        if(!empty($errors)){
          echo displayErrors($errors);
        }
        else{
          $user_id = $result['user_id'];
          $_SESSION['user_id'] = $user_id;
            $_SESSION['success_flash']=' <p class ="text-center text-primary">Welcome back '
            .$result['firstname']. ' '. $result['lastname']."</p>";
            header('Location: dashboard/'.$user_id);
            
        }
        return $result;
    }

    public function uploadProfileImage($user_id){

        $allowed = array('png', 'jpg', 'jpeg');
        $tmpLoc ='';
        $errors =[];
        $uploadPath = '';
        $dbpath='';
      if($_FILES['profilephoto']['error']===0)
          {
           
            $files = $_FILES['profilephoto'];
            $name = $files['name'];
            $nameArray = explode('.',$name);
            $fileName = $nameArray[0];
            $fileExt = $nameArray[1];
            $mime = explode('/', $files['type']);
            $mimeType = $mime[0];
            $mimeExt = $mime[1];
            $tmpLoc = $files['tmp_name'];
            $fileSize = $files['size'];
            $uploadName = time().'.'.$fileExt;
            $uploadPath = BASEURL.'assets/profilephoto/'.$uploadName;
            
            $dbpath= 'assets/profilephoto/'.$uploadName;
           
          if($mimeType != 'image'){
            $errors[] = "The file must be an image.";
          }
          if(!in_array($fileExt, $allowed))
          {
                          $errors[] = 'The file extension must be a png, jpg, jpeg, or gif';
          }
          if($fileSize > 3000000)
          {
                          $errors[] = 'The file size must be under 3MB';
          }
          if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg'))
          {
                          $errors[] = 'File extension does not match the file.';
          
           }
          
        
          if(!empty($errors))
          {
          echo displayErrors($errors); 
          }
          else
          {
            move_uploaded_file($tmpLoc, $uploadPath);
              $user_id = $_SESSION['user_id'];
        $sql ="UPDATE  users SET profile_photo = '$dbpath' WHERE user_id = '$user_id' ";
        if($this->dbObj->dbconnector->query($sql)===true){
            $_SESSION['success_flash']='<p class="text-primary text-center">Profile photo uploaded successfull</p>';
            header('Location: ../../dashboard/'.$user_id);
        }else{
          echo $this->dbObj->dbconnector->error;
        }
      }
    }else{
      echo "<span class ='errors'>Please select a file</span>";
    }    

    }
    // change password
    public function changePassword($userId, $password){
      $sql = "UPDATE users SET password = '$password' WHERE user_id = '$userId' ";
      $queryRes = $this->dbObj->dbconnector->query($sql);
   if($queryRes === true){
      $_SESSION['success_flash']='<pstyle="color:#fff; text-align:center; ">Password Changed successfully</P>';
      header('Location: ../dashboard/'.$userId);
   }else{
       echo "Error ".$this->dbObj->dbconnector->error;
      }
  }
    
  // Get users info to change password

  public function getUserInfoForPasswordChange($userId){
      
    $sql = " SELECT * FROM users WHERE user_id ='$userId' ";
    $users = $this->dbObj->dbconnector->query($sql);
    $result = $users->fetch_assoc();
    if($result){
      return $result;
    }
    // check if password match 
    
    else{
      echo $this->dbObj->dbconnector->error;
      }
      
  }
}
