<form class="form__common
             flex-item__align-self_center 
             rotate__left_12deg
             bg-color__gradient_lb-sky
             bg-shadow__xs" 
      method="POST">
    
    <fieldset>
        <legend class="legend__on-top-left">Register</legend>
        
        <!-- Firstname -->
            <div class="error
                        flex
                        flex__jc_center"> 
                <?php $handler->displayErrorsIfErrors('firstname'); ?>        
            </div>
            
            <div class="input-box
                        flex 
                        flex__jc_space-between">
                           
                <label for="firstname" class="label__common">Firstname*</label>
                <input type="text"
                       name="firstname"
                       id="firstname"
                       value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>"
                       minlength="2"
                       maxlength="50"
                       class="input__common input__beh-or_common"
                       required>
            </div>
        <!-- Firstname end -->
        
        <!-- Lastname -->
            <div class="error
                        flex
                        flex__jc_center"> 
                <?php $handler->displayErrorsIfErrors('lastname'); ?>        
            </div>
            
            <div class="input-box
                        flex 
                        flex__jc_space-between">
                        
                <label for="lastname" class="label__common">Lastname*</label>
                <input type="text" 
                       name="lastname" 
                       id="lastname"
                       value="<?php echo isset($_POST['lastname']) ?  $_POST['lastname'] : ''; ?>"
                       minlength="2"
                       maxlength="50"
                       class="input__common input__beh-or_common"
                       required>
            </div>
        <!-- Lastname end -->
        
        <!-- Email -->
            <div class="error
                        flex
                        flex__jc_center"> 
                <?php $handler->displayErrorsIfErrors('email'); ?>        
            </div>
            
            <div class="input-box
                        flex 
                        flex__jc_space-between">
                        
                <label for="emal" class="label__common">Email*</label>
                <input type="email" 
                       name="email"
                       id="email"
                       class="input__common input__beh-or_common"
                       value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"
                       minlength="5"
                       maxlength="50"
                       placeholder="example@domain.com"
                       required> 
            </div>
        <!-- Email end -->
        
        <!-- Password 1 -->
            <div class="error
                        flex
                        flex__jc_center"> 
                <?php $handler->displayErrorsIfErrors('password'); ?>        
            </div>
            
            <div class="input-box
                        flex 
                        flex__jc_space-between">
                        
                <label for="password" class="label__common">Password*</label>
                <input type="password" 
                       name="password"
                       id="password"
                       minlength="6"
                       maxlength="128"
                       class="input__common input__beh-or_common"                   
                       required>
            </div>
        <!-- Password 1 end -->
        
        <!-- Password 2 -->
            <div class="input-box
                        flex 
                        flex__jc_space-between">
                        
                <label for="password_2" class="label__common">Repeat password*</label>
                <input type="password" 
                       name="password_2" 
                       id="password_2"
                       minlength="6"
                       maxlength="128"
                       class="input__common input__beh-or_common"                    
                       required>  
            </div>
        <!-- Password 2 end -->
        
        <!-- Gender -->
            <div class="error
                        flex
                        flex__jc_center"> 
                <?php $handler->displayErrorsIfErrors('gender'); ?>        
            </div>
            
            <div class="input-box
                        flex 
                        flex__jc_space-between">
                        
                <?php $handler->displayErrorsIfErrors('gender'); ?>
                <label for="gender" class="label__common">Gender</label>
                <p><input type="radio" name="gender" id="gender" value="m">male</p>
                <p><input type="radio" name="gender" id="gender" value="f">female</p> 
            </div>
        <!-- Gender end -->
        
        <!-- Birthday -->
            <div class="error
                        flex
                        flex__jc_center"> 
                <?php $handler->displayErrorsIfErrors('birthday'); ?>        
            </div>
            
            <div class="input-box
                        flex 
                        flex__jc_space-between">
                        
                <?php $handler->displayErrorsIfErrors('birthday'); ?>
                <label for="birthday" class="label__common">Birthday</label>
                <input type="date" 
                       name="birthday" 
                       id="birthday" 
                       class="input__common"
                       value="<?php echo (!$handler->isEmptyField('birthday')) ? $_POST['birthday']->Format('Y-m-d') : ''; ?>"
                       min="<?php echo (date('Y') - 120).'-01-01' ?>"
                       max="<?php echo date('Y-m-d')?>">  
            </div>
        <!-- Birthday end-->
        
        <div class="input-box 
                    flex 
                    flex__jc_flex-end">
            <input type="submit" value="Submit">
        </div>
        
        <aside>
            <p>Already have an account? <a href="/login">Log In</a></p>
        </aside>
    </fieldset>
</form>
