<?php
    require_once ("../configuration/db_config.php");
    require_once ("../controllers/car_make.php");
 ?>
     
     <?php
     $make =  checkInput($_POST['make']);
     $selectedValue = checkInput($_POST['selectedValue']);
     $modelObject = new Car();
     $models = $modelObject->getCarModel($make);
     
     ob_start();
     ?>
     
     <option value="">---Select a model---</option>
     <?php
     foreach ($models as $model):
     ?>
     <option value="<?php echo $model['model_id'];?>"
     <?php 
     echo (($selectedValue == $model['model_id'])?' selected' : '');?>>
     <?php echo $model['model_name']; ?></option>
     <?php endforeach; 
     echo ob_get_clean();
     ?>
    
     
