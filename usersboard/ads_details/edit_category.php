<form action="" method ="post">
    <!-- Houses -->
    <?php if($category ==1){ ?>
    <div>
        <h3>Houses And Appartments <span class ="fontawsome"><i class="fas fa-home"></i></span> </h3>
        <div class="form-group">
                <label for="rooms"><span class="fontawsome">
                    <i class="fas fa-bed fa-lg"></i></span> Rooms <em>*</em></label>
                <select name="rooms" id="rooms" class="form-control">
                    <option value="">select</option>
                    <?php
                        for($i =1; $i <= 50; $i++){
                    ?>
                    <option value="<?php echo $i ?>" <?php echo ((isset($rooms) && $rooms == $i)?"selected":"");
                     echo ((isset($catone['rooms']) && $catone['rooms'] == $i)?"selected":"");?> >
                    <?php echo $i ?> Rooms </option>
                    <?php } ?>
                </select>
                <span class="errors"><?php if(isset($room_er)){echo $room_er;} ?></span>
        </div> 

        <div class="form-group">
                <label for="bathrooms"> <span class="fontawsome">
                    <i class="fas fa-bath fa-lg"></i></span > Rooms <em>*</em></label>
                <select name="bathrooms" id="bathrooms" class="form-control">
                    <option value="">select</option>
                    <?php
                        for($i =1; $i <= 10; $i++){
                    ?>
                    <option value="<?php echo $i ?>" <?php echo ((isset($bath) && $bath == $i)?"selected":""); 
                   echo ((isset($catone['bathrooms']) && $catone['bathrooms'] == $i)?"selected":"");?>>
                    <?php echo $i ?> Bathrooms </option>
                    <?php } ?>
                </select>
                <span class="errors"><?php if(isset($bath_er) ){echo $bath_er;} ?></span>
        </div> 

        <div class="form-group">
                <label for="toilets">  <span class="fontawsome">
                    <i class="fas fa-toilet fa-lg"></i></span> Toilets <em>*</em> </label>
                <select name="toilets" id="toilets" class="form-control">
                    <option value="">select</option>
                    <?php
                        for($i =1; $i <= 10; $i++){
                    ?>
                    <option value="<?php echo $i ?>" 
                    <?php echo ((isset($toilets) && $toilets == $i)?"selected":"");
                    echo ((isset($catone['toilets']) && $catone['toilets'] == $i)?"selected":""); ?>>
                    <?php echo $i ?> Toilet </option>
                    <?php } ?>
                </select>
                <span class="errors"><?php if(isset($toilets_er) ){echo $toilets_er;} ?></span>
        </div> 

        <div class="form-group">
            <label for="age">Age Condition  <span class="fontawsome">
                <i class="fas fa-question"></i></span> <em>*</em> </label> 
            <select name="age" id="" class="form-control">
                <option value="">select an option</option>
                <option <?php echo ((isset($age) && $age == "new")?"selected":"");
                echo ((isset($catone['age']) && $catone['age'] == 'new')?"selected":""); ?>
                value="new">New</option>
                <option <?php echo ((isset($age) && $age == "old")?"selected":"");
                echo ((isset($catone['age']) && $catone['age'] == 'old')?"selected":""); ?>
                 value="old">Old</option>
           </select>
           <span class="errors"><?php if(isset($age_er) ){echo $age_er;} ?></span>
        </div>

        <div class="form-group">
            <label for="land">Area covered (M <sup>2</sup>) Please enter only comma separated values eg 100, 200</label>
            <input type="text" name ="land" id ="landwidth" placeholder="enter comma separated values eg 400 , 200" 
            value="<?php if(isset($land)){echo $land;}
            if(isset($catone['land'])){echo $catone['land'];} ?>" class="form-control" >
             <span class="errors"><?php if(isset($land_er)){echo $land_er;} ?></span>
        </div>
        <div class="form-group">
            <label for="facilities">facilities:</label><br>
            <?php 
            $fac = $catone['facility'];
            
            $catOneFacilities = explode(',', $fac); 
                  
            ?>
             <span>Security</span> <input type="checkbox" 
             <?php echo ((isset($facility)) && $facility == 'Security')?"checked":"";
            
             foreach($catOneFacilities as $facilities){
             echo ((isset($facilities)) && $facilities == 'Security')?"checked":"";
             
            }
              ?> 
             name="facility[]" value ="Security"> <br>

             <span>Water Supply</span> <input type="checkbox" 
             <?php echo ((isset($facility)) && $facility == 'Water Supply')?"checked":"";
             foreach($catOneFacilities as $facilities){
             echo ((isset($facilities)) && $facilities == 'Water Supply')?"checked":""; 
            }
             ?> 
             name="facility[]" value ="Water Supply"> <br>

             <span>Parking Space and Garage</span> <input type="checkbox" 
             <?php echo ((isset($facility)) && $facility == 'Parking Space and Garage')?"checked":"";
             foreach($catOneFacilities as $facilities){
             echo ((isset($facilities)) && $facilities == 'Parking Space and Garage')?"checked":"";
            }
              ?> 
             name="facility[]" value ="Parking Space and Garage"> <br>

             <span>Swimming Pool</span> <input type="checkbox" 
             <?php echo ((isset($facility)) && $facility == 'Swimming Pool')?"checked":"";
             foreach($catOneFacilities as $facilities){
             echo ((isset($facilities)) && $facilities == 'Swimming Pool')?"checked":""; 
            }
             ?> 
             name="facility[]" value ="Swimming Pool"> <br>
                
             <span>Good Roads Net-Work</span> <input type="checkbox" 
             <?php echo ((isset($facility)) && $facility == 'Good Roads NetWork')?"checked":"";
             foreach($catOneFacilities as $facilities){
             echo ((isset($facilities)) && $facilities == 'Good Roads NetWork')?"checked":""; 
            }
             ?> 
             name="facility[]" value ="Good Roads NetWork"> <br>

             <span>Fenced Compound</span> <input type="checkbox" 
             <?php echo ((isset($facility)) && $facility == 'Fenced Compound')?"checked":"";
             foreach($catOneFacilities as $facilities){
             echo ((isset($facilities)) && $facilities == 'Fenced Compound')?"checked":"";
            } 
             ?> 
             name="facility[]" value ="Fenced Compound"> 
<?php } elseif($category ==2){ ?>
    <!-- Autos -->
    <div>
        <h3>Auto Mobiles <span class="fontawsome"><i class="fas fa-car"></i></span> </h3>
        <div class="form-group">
            <label for="make">Make by <span class="fontawsome"> 
                <i class="fas fa-question"></i></span> <em>*</em> </label>
            <input type="text" name ="make" id ="make" class="form-control"
            value="<?php if(isset($make)){echo $make;}
             echo ((isset($cattwo['status']))? $cattwo['make'] : "" ); ?>" placeholder="example:toyota" > 
            <span class="errors"><?php if(isset($make_er) ){echo $make_er;} ?></span>
        </div>

        <div class="form-group">
            <label for="model">model</label> <em>*</em>
            <select name="model" id="model" class="form-control">
                <option value="">what model are you selling</option>
                <?php 
                $date = date('Y');
                for( $i =$date; $i >=1990; $i--){
                ?>
                    <option <?php echo ((isset($model) && $model == $i)?"selected":"");
                     echo ((isset($cattwo['model']) && $cattwo['model']==$i)?"selected" : ""); ?>
                     value="<?php echo $i ?>">
                    <?php echo $i ?> Model</option>
                <?php } ?>
            </select>
            <span class="errors"><?php if(isset($model_er) ){echo $model_er;} ?></span>
        </div>

        <div class="form-group">
            <label for="mileage">mileage</label> <em>*</em>
            <input type="text" name ="mileage" id ="mileage" 
            value=  "<?php echo ((isset($mileage))? $mileage : "");
            echo ((isset($cattwo['mileage']))? $cattwo['mileage'] : ""); ?>"
             class="form-control" placeholder="example:12345 km" >
            <span class="errors"><?php if(isset($mileage_er) ){echo $mileage_er;} ?></span>
        </div>

        <div class="form-group">
            <label for="status">status <span class="fontawsome">
                <i class="fas fa-question"></i></span> <em>*</em>  </label>
                <select name="status" id="" class="form-control">
                <option value="">select</option>
                <?php 
                    $statusarray = ['bran new', 'foreign used', 'nigeria used'];
                    foreach($statusarray as $array){
                ?>
                <option value="<?php echo $array ?> "
                <?php echo ((isset($status) && $status == $array)?"selected":"");
                 echo ((isset($cattwo['status']) && $cattwo['status']==$array)?"selected" : ""); ?>
                ><?php echo $array ?></option>
                <?php } ?>
            </select>
            <span class="errors"><?php if(isset($status_er) ){echo $status_er;} ?></span>
        </div>
        <div class="form-group">
            <label for="engine">engine type</label>
            <input type="text" name ="engine" id ="engine"
            value ="<?php echo ((isset($engine))? $engine: "");
             echo ((isset($cattwo['engine']))? $cattwo['engine'] : ""); ?>"
             class="form-control"  placeholder="eg V8 or V6">

<?php } elseif($category ==3){ ?>
    <!-- Lands -->
    <div>
        <h3>Lands</h3>
        <div class="form-group">
            <label for="measurement">measurement (M<sup>2</sup>) <em>*</em></label>
            <input type="text" name ="measurement" id ="measurement" 
            value="<?php if(isset($measurement)){echo $measurement;} ?>" class="form-control" > 
            <span class="errors"><?php if(isset($measurement_er) ){echo $measurement_er;} ?></span>
        </div>

        <div class="form-group">
            <label for="landtype">land type</label>
            <select name="landtype" id="" class="form-control">
            <option value="">select an option</option>
            <?php 
            $landarray = ['industrial land', 'farm land', 'residential land'];
            foreach($landarray as $land){
            ?>
                <option <?php echo ((isset($landtype) && $landtype == $land)? "selected":"") ?>
                 value="<?php echo $land ?>"><?php echo $land ?></option>
            <?php } ?>
            </select>
            <span class="errors"><?php if(isset($landtype_er) ){echo $landtype_er;} ?></span>
        </div>
       <div class="form-group">
           <input type="text" name = "document" 
           placeholder ="What document does your land have? Example:R of O"
            class="form-control" <?php echo ((isset($document))?$document:"") ?>
           <span class="errors"><?php if(isset($document_er) ){echo $document_er;} ?></span>
       </div>
    </div>
<?php } elseif($category == 4){ ?>          
    <!-- Parks and gardens -->
    <div>
        <h3>Events Centers And Venues</h3>
        <div class="form-group">
            <label for="type">type</label>
            <select  name ="type" id ="type" class="form-control">
            <option value="">Select</option>
            <?php 
                $typearray = ['offices', 'plaza', 'venues', 'shops'];
                foreach($typearray as $typearr){
            ?>
                <option <?php echo ((isset($type) && $type == $typearr)? "selected":"") ?>
                 value="<?php echo $typearr ?>"><?php echo $typearr ?></option>
                <?php } ?>
               
            </select> 
            <span class="errors"><?php if(isset($type_er) ){echo $type_er;} ?></span>
        </div>

        <div class="form-group">
            <label for="facilities">facilities</label><br>
            <?php
            $facilityArray = ['Air Condition', 'Security', 'Wifi Availale', 'Parking Space', "Tarred Road", "Fenced"];
            foreach($facilityArray as $value){
            ?>
           <span><?php echo $value ?></span> <input type="checkbox"
            <?php echo ((isset($facility)) && $facility == $value)?"checked":"" ?> 
           name="facility[]" value ="<?php echo $value ?>"> <br>
            <?php } ?>
        </div>
    </div>
<?php }?>
    <div class="form-group">
    <button name="category" class="form-control bg-success text-primary">Update Category</button>
    </div>
</form>
    
   

   