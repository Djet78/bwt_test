<h2>I am feedback page</h2>

<form method="POST">
    <p>Name*</p>
        <?php $handler->displayErrorsIfErrors('name'); ?>
        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
        
    <p>Leave a feedback*</p>
        <?php $handler->displayErrorsIfErrors('body'); ?>
        <textarea rows="10" cols="45" name="body" required><?php echo isset($_POST['body']) ?  $_POST['body'] : ''; ?></textarea>
        
    <p>Email*</p>
        <?php $handler->displayErrorsIfErrors('email'); ?>
        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required> 

    <p></p>
    <input type="submit" value="Submit">
    
    <hr>
</form>

<?php 
    foreach($feedbacks as $feedback){
        echo "Name: {$feedback['name']} <br>";
        echo "Body: {$feedback['body']} <br>";
        echo "Email: {$feedback['email']} <br>";
        echo '<hr>';
    }
?>