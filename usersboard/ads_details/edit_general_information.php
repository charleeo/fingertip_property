<h1>General Information</h1> 
<form action="" method ="post">
    <div class="form-group >
            <label for="tile">Title <em>*</em></label>
            <input type="text" name ="title" value ="<?php 
            if(isset($title)){echo $title;}
            if(isset($viewResult['title'])){echo $viewResult['title'];} ?>" 
            placeholder="eg : A Three bedrooms duplex "
            id ="title" class="form-control">
            <span class="errors"><?php if(isset($title_er) ){echo $title_er;} ?></span>
    </div>
    <div class="form-group">
        <label for="description">Description <em>*</em> </label>
        <textarea name="description" id="description" 
        placeholder="plase give clear and detailed description to your ads" 
        cols="30" rows="10" class="form-control"><?php 
        if(isset($viewResult['description'])){echo $viewResult['description'];}
        echo ((isset($desc))?$desc: "");
             ?>
        </textarea>
        <span class="errors"><?php if(isset($desc_er) ){echo $desc_er;} ?></span>
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        &#8358 <em>*</em>  Don't add comma, it will be added automaticaly.
        <input type="text" min="0" class="number form-control" name="price"
        value="<?php 
        if(isset($viewResult['price'])){echo $viewResult['price'];}    
            echo ((isset($price))?$price : "");
        ?>"
        placeholder ="enter the price in multiple of 10 don't include comma">
        <span class="errors"><?php if(isset($price_er) ){echo $price_er;} ?></span>
    </div> 
    <div class="form-group >
        <label for="purpose">Ads Purpose <em>*</em> </label>
        <select name="purpose" id="purpose" class="form-control">
        <option value="" readonly>Select</option>
            <option value="sale"
            <?php echo ((isset($purpose) && $purpose == 'sale')? "selected" : "");
            if(isset($viewResult['purpose']) && $viewResult['purpose']==='sale'){echo "selected";} ?>>
            Sales</option>
            <option value="rent" 
            <?php echo ((isset($purpose) && $purpose == 'rent')? "selected" : "");
            if(isset($viewResult['purpose']) && $viewResult['purpose']==='rent'){echo "selected";} ?>>
            Rent</option>
        </select>
        <span class="errors"><?php if(isset($purpose_er) ){echo $purpose_er;} ?></span>
    </div> 
    <div class="form-group">
        <button name ="general" class="form-control bg-success text-primary ">Update Information</button>
    </div>
</form>
    <div class="form-group">
            <h5><a href="#top" style="color:#097979">Go <i class="fas fa-arrow-up"></i></a></h5>
    </div> 
               
       