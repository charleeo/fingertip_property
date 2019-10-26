    <section class="portfolio">  
         <!-- Search form -->
     <!--Details  -->
        <?php
        $records = new DisplaySingleAd();
        $results = $records->publishSimilarAds($propertyId, $catId);
        if($results){
            foreach($results as $ad){
                $adsImages = explode(',', $ad['images']);
         
        ?>

        <div>
            <a href="singleproduct/<?php echo $ad['id'] ?>/<?php echo $ad['category_id'] ?>/<?php echo $ad['user_id']; ?>">
                <img src="<?php echo $adsImages[0] ?>" class="adjust-image" alt="Portfolio logos" title="<?php echo $ad['title'] ?>">
            </a>   
            <p class="product-view"><?php echo nl2br($ad['title']) ?></p> 
            <span class="product-view">For:<b class="product-view-purpose">
            <?php echo $ad['purpose'] ?></b></span>  <br>
            <span class="product-view">Location: <?php echo $ad['region_name'] ?></span>, 
            <span class="product-view"><?php echo $ad['state_name'] ?> State </span> <br>
            <span class="product-view">Price:  &#8358 <b class="product-view-price"> 
            <?php echo number_format($ad['price'] )?></b></span> <br>
            <span class="product-view">
                <a href="singleproduct/<?php echo $ad['id'] ?>/<?php echo $ad['category_id'] ?>/<?php echo $ad['user_id'] ?>">View details</a>
            </span> 
        </div>
   <?php
   }
}else{
    echo "No record found";
}
   ?>
</section>
<!-- for the pagination -->
