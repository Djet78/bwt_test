<div class="slick-slider 
            feedback
            flex 
            flex__flow_column
            bg-color__gradient_lb-sky
            rotate__right_12deg
            bg-shadow__xs">
    <?php foreach($feedbacks as $feedback) { ?>
        <section class="feedback-container">
            <div class="flex flex__flow_column">
                <h2 class="feedback__user-name"><?php echo $feedback['name']; ?></h2>
                <p class="feedback__body">&laquo;<?php echo $feedback['body']; ?>&raquo;</p>
                <p class="feedback__user-email flex-item__align-self_flex-end"><?php echo $feedback['email']; ?></p>
            </div>
        </section>
    <?php } ?>
</div>
