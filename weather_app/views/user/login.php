<h2>I am login page</h2>

<form method="POST">      
    <p>Email*</p>
        <?php $model->post_handler->display_errors_if_have('email'); ?>
        <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required> 
        
    <p>Password*</p>
        <?php $model->post_handler->display_errors_if_have('password'); ?>
        <input type="password" name="password" required>
</form>
