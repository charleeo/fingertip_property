    <section id="general-details">
        <h3 class="text-success">General Details</h3>
       <div class="form-group >
                <label for="tile">Title <em>*</em> Character must be between 7 and 70 in length</label>
                <input type="text" name ="title" value ="<?php if(isset($title)){echo $title;}
                if(isset($viewResult['title'])){echo $viewResult['title'];} ?>" 
                placeholder="eg : A Three bedrooms duplex "
                 id ="title" class="form-control">
                 <span class="errors" id="title-error"><?php if(isset($title_er) ){echo $title_er;} ?></span>
        </div>
        <div class="form-group">
            <label for="description">Description <em>*</em> 
            character must be between 15 and above </label> <br/>
            <textarea name="description" id="description" 
            placeholder="plase give clear and detailed description to your ads" 
            cols="40" rows="10" ><?php echo ((isset($desc))?$desc: "");
              if(isset($viewResult['description'])){echo $viewResult['description'];} ?></textarea>
            <span class="errors" id="description-error"><?php if(isset($desc_er) ){echo $desc_er;} ?></span>
        </div>
       
        <div class="form-group">
            <label for="price">price</label>
            &#8358 <em>*</em>
             <input type="text"  class="number form-control" name="price" id="price"
            value="<?php echo ((isset($price))?$price : "");
            if(isset($viewResult['price'])){echo $viewResult['price'];} ?>"
            placeholder ="enter the price in multiple of 10 don't include comma">
            <span class="errors" id="price-error"><?php if(isset($price_er) ){echo $price_er;} ?></span>
            Negotiable? <input type="checkbox" name ="negotiate" value="yes" <?php echo ((isset($negotiate) && $negotiate == 'yes')?"checked":"") ?>>
        </div> 
        
        <div id="add_more">
            <div class="form-group">
                <p id="file-info">Use the add more button to create more files input <br/> if your device does
                     not support multiple files selection . <br> Or if your device supports
                 multiple file selection <br/> you can select multiple files using the files input below</p>
            </div>
            <div class="form-group">
                <button id="add" type ="button">Add More</button>
                <button id="removebtn" type ="button">Remove</button>
            </div>
            <div class="form-group"> 
                <label for="files1">Image 1 <em>*</em> supply at least three images</label> <br/>
                <input type="file" name="images[]"  multiple id="image"
                value ="<?php echo ((isset($_POST['images']['name']))? $_FILES['images']['name']:"" ) ?>">
                <span class="errors" id="image-error"><?php if(isset($file_errors) ){echo $file_errors;} ?></span>
            </div>
        </div>
            <div class="form-group">
        </div> 
</section>     
