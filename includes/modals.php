<div class="disclaimer">
  <div class="disclaimer-contents">
          <div >            
            <p class= "profile-image"><img src="<?php echo $singleAd['profile_photo'] ?>" alt=""></p>  
            <p class= "profile-image"><?php echo $singleAd['email'] ?></p>
            <p class= "profile-image"><?php echo $singleAd['company'] ?></p>
            <p class="text-center"><?php echo ($singleAd['phone']) ?></p> </h3> 
          </div>
          <div class="close-disclaimer">+</div>
          <div class="disclaimer-div">
          <p>
            This <span class="title"><?php echo $singleAd['title'] ?></span> does not belong to fingertip and it subsidary.
            Fingert Tip is only serving as a window through which this property is been advertised.
          </p>
          
          <p class=" text-warning bg-danger">
            Please make sure your verify the authenticity of the said property before
            making any payment. Don't pay for a  property you have not verified and
            please don't go to any secluded environment for any meeting.
            All meetings with sellers should be at opened places.
          </p>
          <p>
            The owner or the seller is the details seen above.
          </p>
      </div>
  </div>
</div>

      <!-- Gallery pop up modal -->
      <?php
       $images = explode(',', $singleAd['images']);
           
       $imageCount = count($images);
       $imageSlice= array_slice($images,2);
       if($imageCount > 2){            
      ?>
<div class="imagegallery-modal">
  <div class="modal-gallery">
          <div class="second-close-button">+</div>
          <div id="arrow-left" class="arrow"></div>
          <div   class="modal-images">
            <!-- get the images for the gallery -->
            <?php
              foreach($imageSlice as $image){                   
            ?>
              <div class="product-modal-display"><img src="<?php echo $image; ?>" alt = "Product Photo">
              <span class="slidernumber"></span>
              </div>
            <?php
             }
          ?>
          </div>
          <div id="arrow-right" class="arrow"></div>
        </div>
  </div>
</div>
<?php }?>