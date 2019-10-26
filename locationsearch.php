<?php
ob_start();
    require_once ("configuration/db_config.php");
    require_once ("controllers/categoryclass.php");
    require_once ("controllers/searchcategories.php");
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
            $searchKeywords = checkInput($_GET['search']);
            $location2 = checkInput((int)$_GET['region']);
            $locationSearch = new SearchCategory();
            require_once ('pagination/pagination.php');
            $adsNotPaginated = $locationSearch->searchByLocation($searchKeywords,$location2);
            $row_count = count($adsNotPaginated);
            $data['total_records'] =$row_count;
            $data['records_per_page'] = 3;
            $data['pagination_url']= "locationsearch.php?search=".$searchKeywords."&region=".$location2;
            $page = new pagination;
            // $page->pagination_display($data);
            $start_rocord = $page->start_record($data);
            $records_per_page = $data['records_per_page'];
            $ads = $locationSearch->paginateSearchByLocation($searchKeywords,$location2, $start_rocord,$records_per_page);
            if($ads){
                    
        ?>
        <h6> <?php echo $row_count ?>   found  &nbsp; 
         <span id="advanced-search">click to simplify the search</span> </h6>
   
<section class="product-display">  
         <!-- Search form -->
     <div class="search-form">
        <p>Filter By:</p>
        <form action="filteredresult.php" method ="post">
            <input type="hidden" name ="region" value ="<?php echo $location2?>">
            <input type="hidden" name = "price_sort" value ="0">
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
            <label for="cat" class="form-control">Category</label> 
                <select name="cat" id="cat" >
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
                </select> <br/> <br/>
               <span>Apply Search</span> <button> <i class="fas fa-search fa-lg"></i></button>
            </div>
        </form>
    </div> 
     <!--Details  -->
    <div class="searched-result">
        <?php
         
        foreach($ads as $ad){
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
            echo "<p class='text-center'>No 
            record is found for ('".$searchKeywords."') in '".$location2."'
             Region. Please use a 
            more precise key words or better still change the city</p>";
        }
    }
    ?>
   </div>
</section>
<!-- for the pagination -->
<section class="pagination">    
    <?php $page->pagination_display($data); ?>
</section>
<span id="timer"></span>
    <?php include ("includes/footer.php"); ?>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/mainnavbarjs.js"></script>
    <script src="js/main.js"></script>
    <script src="js/categorysearch.js"></script>