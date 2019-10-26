<?php
 $uri = $_SERVER['REQUEST_URI'];
  $baseUrl =basename($_SERVER["PHP_SELF"]);
  ?>
<nav class="main-nav">
        <ul class="home">
              
               <li>
                  <a class='<?php echo (($baseUrl== "index.php")?"active-page": "") ?>' href="index">
                    Home
                  </a>
               </li>     
        </ul>
            
        <ul class="navbartoggler">
               <li>
                  <a class='<?php echo (($baseUrl== "about.php")?"active-page": "") ?>'
                   href="about">About</a>
               </li>
               <li>
                  <a href="contactus.php">Contact</a>
               </li>
               <?php if(!empty($_SESSION['user_id'])){
                  ?>
               <li class="showChild">Profiles 
                     <span class="hideChild">
                      <a href="dashboard/<?php echo $_SESSION['user_id']; ?>">Dash Board</a>
                     </span>
                   <span class ="hideChild">
                      <a href="logout">Log Out</a>
                  </span>
              </li>
               <?php }else{ ?>
              <li id="login-link">
                 <a class='<?php  if($baseUrl== "login_register.php"  &&
                  $uri ==  BASEURL."/login_register.php?log=login"){echo "active-page";} ?>'
                   href="login_register.php?log=login">Log in</a>
            </li>
              <li id="signup-link">
                 <a  class='<?php  if($baseUrl== "login_register.php" && 
                $uri== BASEURL."/login_register.php?sign=signup"){echo "active-page";} ?>' 
                  href="login_register.php?sign=signup" >Sign Up</a>
            </li>
            <?php } ?>
            <li>
               <a href="ads" >Create Ads</a>
            </li>
         </ul>
         <ul  class="hidetoggler">
            <li>
               <span id ="navbardisplacer">+</span>
               <span id="hidetoggler" > <i class="fas fa-bars"></i></span>
               
            </li>  
        </ul>
      </nav>