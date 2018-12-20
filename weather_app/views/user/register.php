<h2>I am register page</h2>

<?php 

if (!empty($_POST)){
    /* 
   ~~~~~~~~~~ In progress ~~~~~~~~~
 
    $model->handle_input('POST');
    var_dump($model->post_handler->validation_errors) . '<br>';
    var_dump($_POST);
    */
}
?>

<!-- 
    Demo form for my test 
-->
<form method="POST">
    <p>Firstname:</p>
    <input type="text" name="firstname" value="<?php echo @$_POST['firstname']?>" required>
    <p>Lastname:</p>
    <input type="text" name="lastname" value="<?php echo @$_POST['lastname']?>" required>
    <p>Email</p>
    <input type="email" name="email" value="<?php echo @$_POST['email']?>" required> 
    <p>Password</p>
    <input type="password" name="password" required>
    <p>Repeat password</p>
    <input type="password" name="password_2" required>   
<!--    
    <p>Gender</p>
        <p><input type="radio" name="gender" value="m">male</p>
        <p><input type="radio" name="gender" value="f">female</p>
    <p>Birthday</p>
    <input type="date" name="birthday" value="<?php echo @$_POST['birthday']?>">    
-->
    <p></p>
    <input type="submit" value="Submit">
</form>

