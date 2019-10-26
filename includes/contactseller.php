  
    <section id='contactSection'>   
            <form id="contact-form" action ="contact_seller_action.php" method="POST">
                <div class="form-group" >
                    <input type="text" class="form-control" id="sender" name="sender" 
                    placeholder="type your full name here">
                    <div id="name_error"></div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name ="email" id="email"
                    placeholder ="enter your correct email address herre">
                    <div id="email_error"></div>
                </div>
                <input type="hidden" name="user_email" value="<?php echo $singleAd['email'] ;?>">
                <input type="hidden" name="user_id" value="<?php echo $singleAd['user_id'] ;?>">
                <input type="hidden" name="category_id" value="<?php echo $singleAd['category_id'] ;?>">
                <input type="hidden" name="property_id" value="<?php echo $singleAd['id'] ;?>">
                <div class="form-group"> 
                    <textarea  name="message" id="body-message" 
                    placeholder="enter your message"
                    cols="40" rows="10"></textarea>
                    <div id="result_message"></div>
                    <input type="submit" class="btn-success" value="Send" name="submit_button" id="submit">
                    <span  id="closecontact">Cancel</span>
                </div>
            </form>
    </section>