<section class="top-container">
        <header class="showcase" style="--image-url:url(../../assets/images/shoppers3.png)">
        <h3 id="welcome-text">buy, rent, sell from your room comfort</h3>
        <h3 id="sell-tip">your online shop for all property</h3>
        </header>
        <div class="search-box">
            
            <div class="top-box-b">
            <?php if($_SERVER["REQUEST_METHOD"]=="POST"){
                $searchKeywords = checkInput($_POST['location_search']);
                $location2 = checkInput((int)$_POST['location']);
                $locationSearch = new SearchCategory();
                $locationSearch->postSearchByLocation($searchKeywords,$location2);
            } ?>
           
                <form method ="post" action ="" >
                   &nbsp; &nbsp; <input type="text" name="location_search" id="search-key-words"
                    placeholder="Enter a key word. eg Honda, Flats, I-phone"> &nbsp; &nbsp;
                    <input  list='dlist' id="selected_element" 
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
                    <input type="hidden" name="location" id="locate"> 
                    <span id="output"></span>
                    <button id="submit" > Search </button>
                </form>
            </div> 
            <!-- <div class="top-box-a">
                    <input type="text" name ="searchtext" id="search" class="search-boxes"  auto-complete ="off"
                    placeholder ="type a key word to search eg: five bed room duplex">
                   <span id="results"></span>
            </div> -->
        </div>
        <span id="timer" style="display:none"></span>
    </section>