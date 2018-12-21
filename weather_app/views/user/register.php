<h2>I am register page</h2>

<form method="POST">
    <p>Firstname:</p>
        <?php $model->post_handler->display_errors_if_have('firstname'); ?>
        <input type="text" name="firstname" value="<?php echo @$_POST['firstname']?>" required>
        
    <p>Lastname:</p>
        <?php $model->post_handler->display_errors_if_have('lastname'); ?>
        <input type="text" name="lastname" value="<?php echo @$_POST['lastname']?>" required>
        
    <p>Email</p>
        <?php $model->post_handler->display_errors_if_have('email'); ?>
        <input type="text" name="email" value="<?php echo @$_POST['email']?>" required> 
        
    <p>Password</p>
        <?php $model->post_handler->display_errors_if_have('password'); ?>
        <input type="password" name="password" required>
        
    <p>Repeat password</p>
        <input type="password" name="password_2" required>  
        
    <p>Gender</p>
        <p><input type="radio" name="gender" value="m">male</p>
        <p><input type="radio" name="gender" value="f">female</p>      
    <p>Birthday</p>
        <input type="date" name="birthday">    
    <p></p>
    <input type="submit" value="Submit">
</form>

