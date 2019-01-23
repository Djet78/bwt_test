<form class="form__common
             flex-item__align-self_center 
             rotate__left_12deg
             bg-color__gradient_lb-sky
             bg-shadow__xs" 
      method="POST">
    
    <fieldset>
        <legend class="legend__on-top-left">Leave a feedback</legend>
        
        <!-- Name --> 
            <div class="error
                        flex
                        flex__jc_center">   
                <?php $handler->displayErrorsIfErrors('name'); ?>
            </div>
            
            <div class="input-box
                        flex 
                        flex__jc_space-between">
                        
                <label for="name" class="label__common">Name*</label>
                <input type="text" 
                       name="name"
                       id="name"
                       class="input__common input__beh-or_common"
                       value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" 
                       required>
            </div>
        <!-- Name end --> 
        
        <!-- Feedback -->
            <div class="error
                        flex
                        flex__jc_center">   
                <?php $handler->displayErrorsIfErrors('body'); ?>
            </div>
            
            <div class="input-box
                        flex 
                        flex__jc_space-between">
                        
                <label for="body" class="label__common">Leave a feedback*</label>
                <textarea rows="10" 
                          cols="45" 
                          name="body"
                          id="body"
                          class="input__texar_common input__beh-or_common"
                          required><?php echo isset($_POST['body']) ?  $_POST['body'] : ''; ?></textarea>
            </div>
        <!-- Feedback end -->     
        
        <!-- Email -->
            <div class="error
                        flex
                        flex__jc_center">   
                <?php $handler->displayErrorsIfErrors('email'); ?>
            </div>
            
            <div class="input-box
                        flex 
                        flex__jc_space-between">
                <label for="email" class="label__common">Email*</label>
                <input type="email" 
                       name="email"
                       id="email"
                       class="input__common input__beh-or_common"
                       value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" 
                       required> 
            </div>
        <!-- Email end -->
        
        <div class="input-box 
                    flex 
                    flex__jc_flex-end">
            <input type="submit" value="Submit" class="btn__sub_size-m">
        </div>
        
    </fieldset>
</form>
