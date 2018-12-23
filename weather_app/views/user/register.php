<h2>I am register page</h2>

<form method="POST">
    <p>Firstname*</p>
        <?php $model->post_handler->display_errors_if_have('firstname'); ?>
        <input type="text" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>" required>
        
    <p>Lastname*</p>
        <?php $model->post_handler->display_errors_if_have('lastname'); ?>
        <input type="text" name="lastname" value="<?php echo isset($_POST['lastname']) ?  $_POST['lastname'] : ''; ?>" required>
        
    <p>Email*</p>
        <?php $model->post_handler->display_errors_if_have('email'); ?>
        <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required> 
        
    <p>Password*</p>
        <?php $model->post_handler->display_errors_if_have('password'); ?>
        <input type="password" name="password" required>
        
    <p>Repeat password*</p>
        <input type="password" name="password_2" required>  
        
    <p>Gender</p>
        <?php $model->post_handler->display_errors_if_have('gender'); ?>
        <p><input type="radio" name="gender" value="m">male</p>
        <p><input type="radio" name="gender" value="f">female</p> 
        
    <p>Birthday</p>
    <?php $model->post_handler->display_errors_if_have('birthday'); ?>
        <input type="date" name="birthday" value="<?php echo isset($_POST['birthday']) ? $_POST['birthday']->Format("Y-m-d") : '';?>">    
    <p></p>
    <input type="submit" value="Submit">
</form>
