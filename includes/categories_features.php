<section class= "detailed_info">
                <?php
                   if($catId ==1){
                    $categoryOne = new DisplaySingleAd;
                    $result = $categoryOne->getCategoryOne($propertyId); 
                  ?>
                <div class="details">
                  <h3 class ="product-view-price">Features</h3>
                  <hr>
                    <table border ="0" cellpadding ="5" cellspacing = "0" >
                      <tbody>
                        <tr>
                          <td>Type: &nbsp <?php echo $result['room_type'] ?> </i></td> 
                        </tr>
                        <tr>
                          <td>Bed Rooms &nbsp <?php echo $result['rooms'] ?></td>
                        </tr>
                        <tr>
                          <td>Bath Rooms &nbsp <?php echo $result['bathrooms'] ?></td>
                        </tr>
                        <tr>
                          <td>Furnishing: &nbsp; &nbsp;<?php echo $result['furnishing']?></td>
                        </tr>
                        <?php if($result['land']){ ?>
                        <tr>
                          <td>
                            Occupied Land:  &nbsp<?php echo $result['land'] ?>M<sup>2</sup>
                          </td>
                        </tr>
                        <?php }?>

                        <?php if($result['parkingspace']){ ?>
                        <tr>
                          <td>
                            Parking Space:  &nbsp <?php echo $result['parkingspace'] ?>
                          </td>
                        </tr>
                        <?php }?>

                        <?php if($result['allowed']){ ?>
                        <tr>
                          <td>Allowed: &nbsp; &nbsp; <?php $facilities = explode(',', $result['allowed']);
                            foreach($facilities as $facility){
                              echo $facility."<i class='fas fa-check '> &nbsp; &nbsp; &nbsp; " ;
                            } 
                          ?></td>
                      </tr>
                      <?php }?>
                      </tbody>
                    </table>
            </div>
            <?php }
             if($catId ==2){
                    $categorytwo = new DisplaySingleAd;
                    $result = $categorytwo->getCategoryTwo($propertyId); 
                  ?>
                <div class="details">
                    <table border ="0" cellpadding ="5" cellspacing = "0" >
                      <thead>
                        <th class="th-center">Features <hr></th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Made By: &nbsp <?php echo $result['maker'] ?> </i></td> 
                        </tr>
                        
                        <tr>
                          <td>Model: &nbsp <?php echo $result['model_name'] ?></td>
                        </tr>
                        <tr>
                          <td>Make Year:  &nbsp<?php echo $result['makeyear'] ?></td>
                        </tr>
                        <tr>
                          <td>Transmission:  &nbsp<?php echo $result['transmission'] ?></td>
                        </tr>
                        <tr>
                          <td>Mile Age: &nbsp <?php echo $result['mileage'] ?>KM</td>
                        </tr>
                        <tr>
                          <td>Usage: <?php echo $result['status']?></td>
                        </tr>
                       
                      </tbody>
                    </table>
            </div>
            <?php }
             if($catId ==3){
                    $categoryThree = new DisplaySingleAd;
                    $result = $categoryThree->getCategoryThree($propertyId); 
                  ?>
                <div class="details">
                    <table border ="0" cellpadding ="5" cellspacing = "0" >
                      <thead>
                        <th class="th-center">Features <hr></th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Land Type: &nbsp <?php echo $result['land_type'] ?></td> 
                        </tr>
                        
                        <tr>
                          <td>Land Document: &nbsp <?php echo $result['documents'] ?></td>
                        </tr>
                        <tr>
                          <td>Measurement: &nbsp <?php $measurements = explode(',',$result['measurement']);
                          echo $measurements[0].'Ft' .' By '. ' '. $measurements[1].'Ft'; ?><i class="fas fa-check "></td>
                        </tr>
                      </tbody>
                    </table>
            </div>
            <?php  }
             if($catId ==4){
                    $categoryFour = new DisplaySingleAd;
                    $result = $categoryFour->getCategoryFour($propertyId); 
                  ?>
                <div class="details">
                    <table border ="0" cellpadding ="5" cellspacing = "0" >
                      <thead>
                        <th class="th-center">Features <hr></th>
                      </thead>
                      <tbody>
                      <tr>
                          <td>Facilities: <br/> <?php $facilities = explode(',', $result['facility']);
                            foreach($facilities as $facility){
                              echo $facility."<i class='fas fa-check '> &nbsp";
                            } 
                          ?></td>
                      </tr>
                        
                        <tr>
                          <td>Type: &nbsp <?php echo $result['type'] ?><i class="fas fa-check "></td>
                        </tr>
                      </tbody>
                    </table>
            </div>
            <?php }?>
          <div id="warning-div" class="warning-div">
              <h1 class="text-center text-success ">Warning</h1>
                  <p class=" text-warning ">
                    Please make sure your verify the authenticity of the said property before
                    making any payment. Don't pay for a  property you have not verified and
                    please don't go to any secluded environment for any meeting.
                    All meetings with sellers should be at opened places.
                  </p>
                   <span id="seller-phone-hidden"><?php echo $singleAd['phone'];?> </span> &nbsp; &nbsp; &nbsp;
                   <button id="dismiss-warning">Dismiss</button>
          </div>
    </section>