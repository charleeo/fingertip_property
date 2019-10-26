<section id="contact-details">
    <h3 class="text-success">Contact Details <em><i class="fas fa-phone"></i></em></h3>
        <div class="form-group">
            <label for="categories">State <em>*</em></label>
            <select name="states" id="state" class="form-control " >
                <option value="">Select</option>
                <?php
                $stateobj = new Location();
                $states = $stateobj->getState();
                foreach($states as $state){
                ?>
                <option value="<?= $state['state_id'] ?>"
                <?php echo (( isset($state_id)  && $state_id  == $state["state_id"])?"selected":"");
                echo (( isset($viewResult['state_id'])  && $viewResult['state_id']  == $state["state_id"])?"selected":""); ?>>
                <?= $state['state_name'] ?></option>
                <?php } ?>
            </select>
            <span class="errors" id="state_error"></span>
        </div>
        <div class="form-group">
            <label for="region_id">City <em>*</em></label>
            <select name="region_id" id="region" class="form-control"></select>
            <span class="errors" id="region_error"><?php if(isset($region_id_er) ){echo $region_id_er;} ?></span>
        </div>
        

        <div class="form-group">
            <label for="street">Street Address  <em>*</em></label>
            <input type="text" name ="street" id ="street" class="form-control"
            value ="<?php echo ((isset($street))? $street : "");
            echo ((isset($viewResult['address']))? $viewResult['address'] : ""); ?>">
            <span class="errors" id="street_error"><?php if(isset($street_er) ){echo $street_er;} ?></span>
        </div>



        <div class="form-group">
            <label for="phone">Phone <em>*</em></label>
            <input type="number" min="0" name ="phone" id ="phone" class="form-control"
            value ="<?php echo ((isset($phone))? $phone : ""); 
            echo ((isset($viewResult['phone']))? $viewResult['phone'] : "");?>">
            <span class="errors" id="phone_error"><?php if(isset($phone_er) ){echo $phone_er;} ?></span>
        </div>
        
        <div class="form-group">
            <label for="url">Web site (optional)</label>
            <input type="url" name ="site" id ="url" class="form-control"
            value ="<?php echo ((isset($site))? $site : "");
            echo ((isset($viewResult['site']))? $viewResult['site'] : ""); ?>" > 
        </div>
</section>
    