<h2>I am login page</h2>

<form method="POST">      
    <p>Email*</p>
        <?php $handler->display_errors_if_have('email'); ?>
        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required> 
        
    <p>Password*</p>
        <input type="password" name="password" required>
    <p></p>
        <input type="submit" value="Submit">
</form>
