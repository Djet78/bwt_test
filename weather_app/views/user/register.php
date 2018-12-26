<h2>I am register page</h2>

<form method="POST">
    <p>Firstname*</p>
        <?php $handler->displayErrorsIfErrors('firstname'); ?>
        <input type="text" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>" required>
        
    <p>Lastname*</p>
        <?php $handler->displayErrorsIfErrors('lastname'); ?>
        <input type="text" name="lastname" value="<?php echo isset($_POST['lastname']) ?  $_POST['lastname'] : ''; ?>" required>
        
    <p>Email*</p>
        <?php $handler->displayErrorsIfErrors('email'); ?>
        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required> 
        
    <p>Password*</p>
        <?php $handler->displayErrorsIfErrors('password'); ?>
        <input type="password" name="password" required>
        
    <p>Repeat password*</p>
        <input type="password" name="password_2" required>  
        
    <p>Gender</p>
        <?php $handler->displayErrorsIfErrors('gender'); ?>
        <p><input type="radio" name="gender" value="m">male</p>
        <p><input type="radio" name="gender" value="f">female</p> 
        
    <p>Birthday</p>
    <?php $handler->displayErrorsIfErrors('birthday'); ?>
        <input type="date" name="birthday" value="<?php echo (!$handler->isEmptyField('birthday')) ? $_POST['birthday']->Format('Y-m-d') : ''; ?>">    
    <p></p>
    <input type="submit" value="Submit">
</form>
