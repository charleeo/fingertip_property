<?php ob_start() ?>
<section class="each-categories">
    <div><b>Quick Search:</b></div>
    <div id="category-one">
        <?php
            $categoryObject = new Category();
            $cat1 = $categoryObject->getCategoryOne();
            if(!empty($cat1)){
                $images = explode(",", $cat1['images']);
            ?>
            <div class="category-name">
                <?php echo $cat1['name'];?>
            </div>
           <div  id="category-one-image" >
                <a href="categoriespage.php?cat=<?php echo $cat1['cat_id'] ?>">
                    <img src="<?php echo $images['0'] ?>" alt="fingertip.com.ng" title="Click to view more">
               </a>  
               <a href="categoriespage.php?cat=<?php echo $cat1['cat_id'] ?>">
                    <span>View More</span>
                </a>     
            </div>

        <?php   }?>
    </div>  &nbsp; &nbsp; &nbsp;
    <div id="category-two">
        <?php
           
            $cat2 = $categoryObject->getCategoryTwo();
            if(!empty($cat2)){
                $images = explode(",", $cat2['images']);
            ?>
           <div class="category-name">
                <?php echo $cat2['name'];?>
            </div>

           <div id="category-two-image">
                <a href="categoriespage.php?cat=<?php echo $cat2['cat_id'] ?>">
                    <img src="<?php echo $images['0'] ?>" alt="fingertip.com.ng" title="Click to view more">
                </a> 
                <a href="categoriespage.php?cat=<?php echo $cat2['cat_id'] ?>">
                    <span>View More</span>
                </a>           
            </div>

        <?php  }?>
    </div>  &nbsp; &nbsp; &nbsp;
   
    <div id="category-three">
        <?php
           
            $cat3 = $categoryObject->getCategoryThree();
            if(!empty($cat3)){
                $images = explode(",", $cat3['images']);
        ?>
            <div class="category-name">
                <?php echo $cat3['name'];?>
            </div>
           <div id="category-three-image">
                <a href="categoriespage.php?cat=<?php echo $cat3['cat_id'] ?>">
                    <img src="<?php echo $images['0'] ?>" alt="fingertip.com.ng" title="Click to view more">
                </a>
                <a href="categoriespage.php?cat=<?php echo $cat3['cat_id'] ?>">
                    <span>Veiw More</span>
                </a>
           </div>
    

        <?php  }?>
    </div>  &nbsp; &nbsp; &nbsp;
    <div id="category-four">
        <?php
           
            $cat4 = $categoryObject->getCategoryFour();
            if(!empty($cat4)){
                $images = explode(",", $cat4['images']);
        ?>
            <div class="category-name">
                <?php echo $cat4['name'];?>
            </div>
           <div id="category-four-image">
               <a href="categoriespage.php?cat=<?php echo $cat4['cat_id'] ?>">
                    <img src="<?php echo $images['0'] ?>" alt="fingertip.com.ng" title="Click to view more">
               </a>
               <a href="categoriespage.php?cat=<?php echo $cat4['cat_id'] ?>">
                    <span>Veiw More</span>
                </a>
           </div>            
        <?php  }?>
    </div>

</section>