<?php
   require_once ("configuration/db_config.php");
    require_once ("controllers/categoryclass.php");
    require_once ("controllers/searchcategories.php");
    require_once ("controllers/location.php"); 
    $title ="Categories and Location"; 
    $description ='';
    $keyWords ='';
    include ("includes/head.php") 
?>

<div class="wrapper">
    <?php include ("includes/navbar.php");
        $price_sort = ((isset($_REQUEST['price_sort']))?checkInput($_REQUEST['price_sort']):"");
        $min_price = ((isset($_REQUEST['min_price']))?checkInput($_REQUEST['min_price']):"");
        $max_price = ((isset($_REQUEST['max_price']))?checkInput($_REQUEST['max_price']):"");
        $purpose = ((isset($_REQUEST['purpose']))?checkInput($_REQUEST['purpose']):"");
        $region = ((isset($_REQUEST['region']))?checkInput($_REQUEST['region']):"");
        $category = ((isset($_REQUEST['cat']))?checkInput($_REQUEST['cat']):"");
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            $categoryId = checkInput((int)$_GET['cat']);
            $newad = new Category();
            $ads= $newad->displayCategories($categoryId);
            require_once ('pagination/pagination.php');
            $row_count = count($ads);
            $data['total_records'] =$row_count;
            $data['records_per_page'] = 3;
            $data['pagination_url']= "categoriespage.php?cat=".$categoryId;
            $page = new pagination;
            // $page->pagination_display($data);
            $start_record = $page->start_record($data);
            $records_per_page = $data['records_per_page'];
            $paginatedAds = $newad->paginateDisplayCategories($categoryId, $start_record, $records_per_page);
            if($paginatedAds){      
        ?>
        <h4 class ="text-center"> <?php echo $row_count ?> found  &nbsp;
         <span id="advanced-search">click to simplify the search</span> </h4> 
    <section class="product-display">  
         <!-- Search form -->
     <div class="search-form" id="search-form">
        <p>Filter By:</p>
        <form action="filteredresult.php" method ="post">
            <input type="hidden" name = "price_sort" value ="0">
            <input type="hidden" name ="cat" value="<?php echo $categoryId ?>">
            <div class="form-group">
                <label for="price_sort" class="form-control">Price Level</label> 
                <input type="radio" name ="price_sort"
                value = "low" <?php echo (($price_sort =='low')?"checked":"") ?>> Low To High <br/>
                <input type="radio" name ="price_sort"
                value = "high" <?php echo (($price_sort =='high')?"checked":"") ?>> High To Low 
            </div>
            <div class="form-group">
               <label for="price_sort">Price Range</label> <br/>
                <input type="text" name ="min_price" 
                 value="<?php echo $min_price ?>" placeholder = "enter min &#8358"> <br/>
                To <br/>
                <input type="text" name ="max_price"
                 value="<?php echo $max_price ?>" placeholder = "enter max &#8358">
            </div>
            <div class="form-group">
            <label for="purpose" class="form-control">Purpose</label>
                <select name="purpose" id="">
                    <option value=""> buy or rent? Select an option</option>
                    <option value="sale" <?php echo (($purpose == "sale")?"selected": ""); ?>>Property for Sales</option>
                    <option value="rent" <?php echo (($purpose == "rent")?"selected": ""); ?>>Property for Rent</option>
                </select> 
            </div>
            <div class="form-group">
            <label for="region" class="form-control">Region</label> 
            <input  list='dlist' id="selected-element" 
                     placeholder="select or type a region eg: Ikorodu" />
                    <datalist id ="dlist">
                    
                        <?php 
                        $location  = new Location();
                        $regions = $location->getRegionForSearch();
                        $totalRegions = count($regions);
                        if($totalRegions > 0){
                            foreach($regions as $region){
                        ?>
                        <option data-value="<?php echo $region['region_id'] ?>"
                         value="<?php echo $region['region_name'] ?>">
                        </option>
                        <?php 
                            }
                        }?>
                    </datalist>
                    <input type="hidden" name="region" id="locate"> 
                    <span id="output"></span>
                    <br/> <br/>
               <span>Apply Search</span> <button id="submit2"> <i class="fas fa-search fa-lg"></i></button>
            </div>
        </form>
    </div> 
     <!--Details  -->
    <div class="searched-result">
        <?php
            foreach($paginatedAds as $ad){
                $adsImages = explode(',', $ad['images']);
        ?>
    <div class="info-images"> 
        <div class="image-div">
            <a href="singleproduct/<?php echo $ad['id'] ?>/<?php echo $ad['category_id'] ?>/<?php echo $ad['user_id']; ?>">
                <img src="<?php echo $adsImages[0] ?>" class="adjust-image" alt="Port folio logos">
            </a> 
        </div>
        <div class="info-div">   
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
    </div>

       <?php
            
            }

        }else{
            echo "<p class='text-center'>No  record is found </p>";
        }
    }
    ?>
   </div>
    </section>
    <!-- for the pagination -->
    <section class="pagination">    
        <?php $page->pagination_display($data); ?>
    </section>
    <?php include ("includes/footer.php"); ?>
    <span id="timer"></span>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/mainnavbarjs.js"></script>
    <script src="js/main.js"></script>
    <script src="js/categorysearch.js"></script>
