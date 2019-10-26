<section id = 'cat-section'>
    <div class="form-group" id="cat-info-display">
        <h3 id ="cat-info" class=" text-success"></h3>
    </div>
    
    
   <div class="form-group">
        <label for="categories">Categories <em>*</em></label>
        <select name="category_id" id="cat" class="form-control " >
            <option value="">--Select a category--</option>
            <?php
            $catobj = new Category();
            $categories = $catobj->getCategory();
            foreach($categories as $category){
        ?>
        <option value="<?php echo $category['cat_id'] ?>"
        <?php
        if(isset($cat_id) && $cat_id == $category['cat_id']){
            echo "selected";
        }
        ?>
        >
        
        <?php echo $category['name'] ?></option>
        <?php   }    ?>
        </select>
        <span class="errors" id="cat-error"><?php if(isset($cat_id_er) ){echo $cat_id_er;} ?></span>
    </div>
    <div class="form-group" id="purpose-div" >
        <label for="purpose">Ads Purpose <em>*</em> </label>
        <select name="purpose" id="purpose" class="form-control">
        <option value="" readonly>---Select an option---</option>
            <option value="sale"
                <?php echo ((isset($purpose) && $purpose == 'sale')? "selected" : "");
                if(isset($viewResult['purpose']) && $viewResult['purpose']==='sale'){echo "selected";} ?>>
            Sales</option>
            <option value="rent" 
            <?php echo ((isset($purpose) && $purpose == 'rent')? "selected" : "");
            if(isset($viewResult['purpose']) && $viewResult['purpose']==='rent'){echo "selected";} ?>>
            Rent</option>
        </select>
        <span class="errors" id="purpose-error"><?php if(isset($purpose_er) ){echo $purpose_er;} ?></span>
    </div> 

    <div class="form-group" id="duration">
        <label for="duration">Rent Duration <em>*</em> </label>
        <select name="duration" id="duration-value"  class="form-control">
            <option value="">--select rent duration--</option>
            <?php for($i =1; $i<= 10; $i++){ ?>
                <option value="<?php echo $i ?>" <?php echo ((isset($duration) && $duration == $i)?"selected":"") ?>><?php echo $i ?> Years</option>
            <?php } ?>
        </select>
        <span class="errors" id="duration-error"></span>
    </div>
    <!-- Houses -->
    <div id="category1">

    <div class="form-group">
            <label for="rooms_type">  type <em>*</em></label>
            <select name="room_type" id="rooms_type" class="form-control">
                <option value="">select</option>
                <?php
                $typeArray =['Self-Contain', 'Single-Room Flat','Boys Quarters','Room And Parlor',
                'Block of Flats','Two BedRoom Flat','Three BedRoom Flat', 'Duplex', 'Mansion'];
                    foreach($typeArray as $type){
                ?>
                <option value="<?php echo $type ?>" <?php echo ((isset($room_type) && $room_type == $type)?"selected":""); ?> >
                <?php echo $type ?> </option>
                <?php } ?>
            </select>
            <span class="errors" id="room-type-error"><?php if(isset($room_type_er)){echo $room_type_er;} ?></span>
        </div> 
        <div class="form-group">
                <label for="rooms"> Bed Rooms <em>*</em></label>
                <select name="rooms" id="rooms" class="form-control">
                    <option value="">select</option>
                    <?php
                        for($i =1; $i <= 50; $i++){
                    ?>
                    <option value="<?php echo $i ?>"
                     <?php echo ((isset($rooms) && $rooms == $i)?"selected":""); ?> >
                    <?php echo $i ?> Bed Rooms </option>
                    <?php } ?>
                </select>
                <span class="errors" id="bed-error"><?php if(isset($room_er)){echo $room_er;} ?></span>
        </div> 
        

        <div class="form-group">
                <label for="bathrooms">Bath Rooms <em>*</em></label>
                <select name="bathrooms" id="bathrooms" class="form-control">
                    <option value="">select</option>
                    <?php
                        for($i =1; $i <= 10; $i++){
                    ?>
                    <option value="<?php echo $i ?>" <?php echo ((isset($bath) && $bath == $i)?"selected":""); ?>>
                    <?php echo $i ?> Bathrooms </option>
                    <?php } ?>
                </select>
                <span class="errors" id="bath-error"><?php if(isset($bath_er) ){echo $bath_er;} ?></span>
        </div> 

       
        <div class="form-group">
            <label for="age">Furnished Status <em>*</em> </label> 
            <select name="furnishing" id="furnishing" class="form-control">
                <option value="">select an option</option>
                <option <?php echo ((isset($furnishing) && $furnishing == "furnished")?"selected":""); ?>
                value="furnished">Furnished</option>
                <option <?php echo ((isset($furnishing) && $furnishing == "not furnished")?"selected":""); ?>
                 value="not furnished">Not furnished</option>
           </select>
           <span class="errors" id="furnish-error"><?php if(isset($furnishing_er) ){echo $furnishing_er;} ?></span>
        </div>

        <div class="form-group">
            <label for="land">Land covered  (M <sup>2</sup>) (Optonal)</label>
            <input type="number" min="0" name ="land" id ="landwidth" 
            placeholder="Enter only the number value in Meter Square " 
            value="<?php if(isset($land)){echo $land;} ?>" class="form-control" >
            <span class="errors" id="landwidtherror"></span>
        </div>
        <div class="form-group" id = "allowed">
            <label for="allowed">Allowed:</label> &nbsp &nbsp
            <?php 
            $allows =    ['pets', 'parties'];
            foreach($allows as $value){
            ?>
             <span><?php echo $value?></span> <input type="checkbox"  name="allowed[]" value ="<?php echo $value ?>" 
             <?php echo ((isset($allowed)) && $allowed == $value)?"checked":"" ?>> &nbsp
            <?php   }   ?>
          
        </div>
    </div>

    <!-- Autos -->
   
    <div id="category2">
        <div class="form-group">
            <label for="make">Make  <em>*</em> </label>
            <select name="make" class="form-control" id="make">
                <option value="">--Select make--</option>
                <?php
                    $carObj= new Car();
                    $cars = $carObj->getCarMakers();
                    foreach($cars as $makes){
                ?> 
                    <option value="<?php echo $makes['make_id'] ?>"
                    <?php echo((isset($make) && $make == $makes['make_id'])?"selected":"") ?>><?php echo $makes['maker'] ?></option>
                <?php } ?> 
            </select>
            <span class="errors" id="make-error"><?php if(isset($make_er) ){echo $make_er;} ?></span>
        </div>
        <div class="form-group">
        <label for="model">Model <em>*</em></label>
            <select name="model" id="model" class="form-control"></select>
            <span class="errors" id="model-error"></span>
        </div>

        <div class="form-group">
            <label for="makeyear">Make Year</label> <em>*</em>
            <select name="makeyear" id="make-year" class="form-control">
                <option value="">Select the make year</option>
                <?php 
                $date = date('Y');
                for( $i =$date; $i >=1980; $i--){
                ?>
                    <option <?php echo ((isset($makeyear) && $makeyear == $i)?"selected":""); ?>
                     value="<?php echo $i . " ". "model" ?>">
                   Year <?php echo $i ?> </option>
                <?php } ?>
            </select>
            <span class="errors" id="make-year-error"><?php if(isset($makeyeaar_er) ){echo $makeyear_er;} ?></span>
        </div>

        <div class="form-group">
            <label for="transmission">Transmission  <em>*</em>  </label>
                <select name="transmission"  id="transmit" class="form-control">
                <option value="">--select--</option>
                <?php 
                    $transmissonArray = ['Manual', 'Automatic'];
                    foreach($transmissonArray as $array){
                ?>
                <option value="<?php echo $array ?> "
                <?php echo ((isset($transmit) && $transmit == $array)?"selected":""); ?>
                ><?php echo $array ?></option>
                <?php } ?>
            </select>
            <span class="errors" id="transmission-error"><?php if(isset($transmit_er) ){echo $transmit_er;} ?></span>
        </div>
        <div class="form-group">
            <label for="make">Color  <em>*</em> </label>
            <select name="body_color" class="form-control" id="body-color">
                <option value="">--Select make--</option>
                <?php
                    $colors = ['Red', 'Wine','Orange','Grey','Green','Beige',
                    'White','Black','Purple','Silver','Yellow','Gold','Pink'];
                    foreach($colors as $color){
                ?> 
                    <option value="<?php echo $color ?>"
                    <?php echo((isset($body_color) && $body_color == $color)?"selected":"") ?>><?php echo $color ?></option>
                <?php } ?> 
            </select>
            <span class="errors" id="color-error"><?php if(isset($body_color_er) ){echo $body_color_er;} ?></span>
        </div>

        <div class="form-group">
            <label for="mileage">mileage</label> <em>*</em>
            <input type="text" name ="mileage" id ="mileage" 
            value=  "<?php echo ((isset($mileage))? $mileage : "") ?>"
             class="form-control number " placeholder="example:12345" >
            <span class="errors" id="mileage-error"><?php if(isset($mileage_er) ){echo $mileage_er;} ?></span>
        </div>

        <div class="form-group">
            <label for="status">status  <em>*</em>  </label>
                <select name="status" id="status" class="form-control">
                <option value="">select</option>
                <?php 
                    $statusarray = ['bran new', 'foreign used', 'nigeria used'];
                    foreach($statusarray as $array){
                ?>
                <option value="<?php echo $array ?> "
                <?php echo ((isset($status) && $status == $array)?"selected":""); ?>
                ><?php echo $array ?></option>
                <?php } ?>
            </select>
            <span class="errors" id="status-error"><?php if(isset($status_er) ){echo $status_er;} ?></span>
        </div>
    </div>


    <!-- Lands -->
    <div id="category3">
        <div class="form-group">
            <label for="measurement">measurement (M<sup>2</sup>) <em>*</em></label>
            <input type="text" name ="measurement" id ="measurement" 
            placeholder="Please specify your land measurement"
            value="<?php if(isset($measurement)){echo $measurement;} ?>" class="form-control" > 
            <span class="errors" id="measurement-error">
                <?php if(isset($measurement_er) ){echo $measurement_er;} ?>
            </span>
        </div>

        <div class="form-group">
            <label for="landtype">land type</label>
            <select name="landtype" id="land-type" class="form-control">
            <option value="">select an option</option>
            <?php 
            $landarray = ['industrial land', 'farm land', 'residential land'];
            foreach($landarray as $land){
            ?>
                <option <?php echo ((isset($landtype) && $landtype == $land)? "selected":"") ?>
                 value="<?php echo $land ?>"><?php echo $land ?></option>
            <?php } ?>
            </select>
            <span class="errors" id="land-type-error">
                <?php if(isset($landtype_er) ){echo $landtype_er;} ?>
            </span>
        </div>
       <div class="form-group">
          <label for="document">Land Document</label>
           <select name = "document" id="land-document"
            placeholder ="What document does your land have? Example:R of O"
                class="form-control">
                <option value="">--select an option--</option>
                <option value="Right of Occupacy" 
                    <?php
                    echo ((isset($document) && $document =="Right of Occupacy")?"selected":"")
                    ?>>
                    Right of Occupacy (R Of O) 
                </option>
                <option value="Cirtificate of Ownership"
                    <?php 
                    echo ((isset($document) && $document =="Certificate of Ownership")?"selected":"")
                    ?>>
                    Certificate of Ownership (C of O)</option>
                <option value="None" 
                    <?php 
                    echo ((isset($document) && $document =="None")?"selected":"")
                    ?>>
                 None
                </option>
            </select>
           <span class="errors" id="document-error">
                <?php if(isset($document_er) ){echo $document_er;} ?>
           </span>
       </div>
    </div>
            
    <!-- Parks and gardens -->
    <div id="category4">
        <div class="form-group">
            <label for="type">type <em>*</em> </label>
            <select  name ="type" id ="type" class="form-control">
            <option value="">Select</option>
            <?php 
                $typearray = ['offices', 'plaza', 'venue', 'shops', 'filling station','Wear Houses', 'Mall', 'school'];
                foreach($typearray as $typearr){
            ?>
                <option <?php echo ((isset($type) && $type == $typearr)? "selected":"") ?>
                 value="<?php echo $typearr ?>"><?php echo $typearr ?></option>
                <?php } ?>
               
            </select> 
            <span class="errors"><?php if(isset($type_er) ){echo $type_er;} ?></span>
        </div>

        <div class="form-group">
        <label for="measurement">measurement (M<sup>2</sup>) <em>*</em></label>
            <input type="text" name="measurment" class="form-control" placeholder="enter comma seperated values. eg:100,100">
        </div>

        <div class="form-group">
            <label for="facilities">facilities (Optional)</label><br>
            <?php
            $facilityArray = ['Security', 'Free Internet', 'Parking Space'];
            foreach($facilityArray as $value){
            ?>
           <span><?php echo $value ?></span> <input type="checkbox"
            <?php echo ((isset($facility)) && $facility == $value)?"checked":"" ?> 
           name="facility[]" value ="<?php echo $value ?>"> &nbsp
            <?php } ?>
        </div>
    </div>
</section>
   

   