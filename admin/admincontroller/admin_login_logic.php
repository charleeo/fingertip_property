<?php
class AdminLogin{
    public $dbObj;
    public function __construct(){
       $this->dbObj =  new Database;
    }
    public function adminLogin($email, $password){
        $sql = " SELECT * FROM admin WHERE admin_email ='$email' LIMIT 1 ";
        $admin = $this->dbObj->dbconnector->query($sql);
        $result = $admin->fetch_assoc();
        $admin_id = $result['admin_id'];
        $admin_role = $result['admin_role'];
        $_SESSION['admin_role'] = $admin_role;
        $_SESSION['admin_id'] = $admin_id;
        $adminCount = $admin->num_rows;
        if($adminCount < 1){
            $errors[] = "We could not find this record with us. Please be sure you're entering the right inputs";
        }
        // check if password match 
        if(!password_verify($password, $result['password'])){
            $errors[]='password do not match our records please check your input';
        }
        if(!empty($errors)){
            echo displayErrors($errors);
        }else{
           
            $_SESSION['success_flash']=' <p class="text-center text-primary">Welcome back '
            .$result['admin_name']."</p>";
            header('Location: home');
            
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
            header('Location: index.php?information='.$user_id);
        }else{
          echo $this->dbObj->dbconnector->error;
        }
      }
    }else{
      echo "<span class ='errors'>Please select a file</span>";
    }    

    }
    
}
