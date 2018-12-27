<?php 
    foreach($feedbacks as $feedback){
        echo "Name: {$feedback['name']} <br>";
        echo "Body: {$feedback['body']} <br>";
        echo "Email: {$feedback['email']} <br>";
        echo '<hr>';
    }
