<?php
 require_once ("controllers/searchcategories.php");
    if(isset($_POST['query'])){
    $search = checkInput($_POST['query']);
    $searchResult = new SearchCategory();
    $result = $searchResult->categorySearch($search);
    $decodeResult = json_decode($result, true);
    if(isset($decodeResult) && $decodeResult != null){
    foreach($decodeResult as $decoded){
     ?>
     <a href="categoriespage.php?cat=<?php echo $decoded['category_id'] ?>
     &title=<?php echo $decoded['title']?> &name=<?php echo $decoded['name'] ?>&id=<?php echo $decoded['id']?> ">
     
            <span class="searchspan">
                <?php 
                $images = explode(',', $decoded['images']);
                ?>
                <img src="<?php echo $images[0] ?>" alt="">
            </span> <br>
            
            <span class="searchspan">
                <?php 
                    echo $decoded['title'];
                ?>
            </span>
            
    </a>
  <?php  
  }
}else{echo "No result matches your search";}
 }
?>