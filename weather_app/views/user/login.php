<form class="form__common
             flex-item__align-self_center 
             rotate__left_12deg
             bg-color__gradient_lb-sky
             bg-shadow__xs" 
      method="POST">    
      
    <fieldset>
        <legend class="legend__on-top-left">Log In</legend>
        
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
                   value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" 
                   maxlength="50"
                   placeholder="example@domain.com"
                   class="input__common input__beh-or_common"
                   required>
        </div>
        

        <div class="input-box 
                    flex 
                    flex__jc_space-between">
                    
            <label for="password" class="label__common">Password*</label>
            <input type="password" 
                   name="password" 
                   id="password" 
                   maxlength="128"
                   class="input__common input__beh-or_common"
                   required>
        </div>

        <div class="input-box 
                    flex 
                    flex__jc_flex-end">
            <input type="submit" value="Submit" class="btn__sub_size-m">
        </div>   
    </fieldset>
    
    <aside>
        <p>You dont have an account yet? <a href="/register">register</a></p>
    </aside>
</form>
