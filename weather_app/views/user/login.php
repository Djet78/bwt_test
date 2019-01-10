<form class="flex__main-item" method="POST">      
    <fieldset>
        <legend>Log In</legend>
        <?php $handler->displayErrorsIfErrors('email'); ?>
        <p>
            <label for="email">Email*</label>
            <input type="email" 
                   name="email" 
                   id="email" 
                   value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" 
                   maxlength="50"
                   placeholder="example@domain.com"
                   required>
        </p>
        

        <p>
            <label for="password">Password*</label>
            <input type="password" 
                   name="password" 
                   id="password" 
                   maxlength="128"
                   required>
        </p>

        <p><input type="submit" value="Submit"></p>
    </fieldset>
</form>
