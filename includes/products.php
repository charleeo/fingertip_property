<section class="portfolio">
    <?php
        
        $records = new DisplayAds;
        $result = $records->publishAds();
        $row_count = count($result);
        require_once ('pagination/pagination2.php');
        $data['total_records'] =$row_count;
        $data['records_per_page'] = 10;
        $data['pagination_url']= "index.php";
        $page = new pagination;
        // $page->pagination_display($data);
        $start_rocord = $page->start_record($data);
        $records_per_page = $data['records_per_page'];
        $ads= $records->display_page($start_rocord, $records_per_page);
        //  $page->pagination_display($data); 
        if($ads){
            foreach($ads as $ad){
                $adsImages = explode(',', $ad['images']);
    ?>

    <div> 
    <a href="singleproduct/<?php echo $ad['id'] ?>/<?php
     echo $ad['category_id'] ?>/<?php echo $ad['user_id'] ?>">
    <img src="<?php echo $adsImages[0] ?>" class="adjust-image" alt="Port folio logos"></a>
        <div class="product-view-bg">
        <hr>
        <span class="product-view"><?php echo $ad['title'] ?></span> <br>
        <span class="product-view">For:<b class="product-view-purpose">
         <?php echo $ad['purpose'] ?></b></span>  <br>
        <span class="product-view">Location: <?php echo $ad['region_name'] ?></span>, 
        <span class="product-view"><?php echo $ad['state_name'] ?> State </span> <br>
        <span class="product-view">Price:  &#8358 <b class="product-view-price"> 
        <?php echo number_format($ad['price']); ?></b></span> <br>
        <span class="product-view"> <a href="singleproduct/<?php
         echo $ad['id'] ?>/<?php 
         echo $ad['category_id'] ?>/<?php echo $ad['user_id'] ?>">View details</a>
        </span> 
        </div>
    </div>
    
       <?php
        }
    }else{
            echo "No record found";
        }
    
    ?>
</section>
<section class="pagination">
    <?php $page->pagination_display($data); ?>
</section>