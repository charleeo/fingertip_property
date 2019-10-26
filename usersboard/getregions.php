<?php
    require_once ("../configuration/db_config.php");
    require_once ("../controllers/location.php");
 ?>
     
     <?php
     $region =  checkInput($_POST['states']);
     $selected = checkInput($_POST['selected']);
     $regionobj = new Location();
     $regions = $regionobj->getRegion($region);
     
     ob_start();
     ?>
     
     <option value="">---Select ads city---</option>
     <?php
     foreach ($regions as $region):
     ?>
     <option value="<?php echo $region['region_id'];?>"
     <?php 
     echo (($selected == $region['region_id'])?' selected' : '');?>>
     <?php echo $region['region_name']; ?></option>
     <?php endforeach; 
     echo ob_get_clean();
     ?>
    
     
