<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>

    <style><?php require "assets/main.css";?></style>
    
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="flex 
             flex__flow_column
             flex__jc_space-between
             font__main
             bg-color__gradient_rt-azure">

    
    <!-- Header block -->
        <header class="block__header 
                       flex
                       flex__jc_space-evenly">
            
            <!-- LOGO block -->
                <a class="block__logo
                          flex 
                          flex__jc_center
                          bg-color__gradient_lb-light-green
                          bg-shadow__s"
                   href="/">
                    <p class="flex-item__align-self_center">Logo Placeholder</p>
                </a>
            <!-- LOGO block end -->  

            <!-- Main nav block -->
                <nav class="block__main-nav
                            flex
                            flex__jc_space-evenly">
                            
                            
                    <!-- Buttons block -->
                        <?php 
                            // Declare buttons e.g.: ['url' => 'button name to display'] 
                            if ($_SESSION['user_group'] == 'autorized') {
                                $buttons = [
                                    '/logout' => 'logout',
                                    'post_feedback' => 'feedback',
                                ];
                            } else {
                                $buttons = [
                                    '/register' => 'register',
                                    '/login' => 'login',
                                    '/post_feedback' => 'feedback',
                                ];
                            }
                        ?>
                        <?php 
                            $i = 0; // iteration
                            foreach($buttons as $url => $btn_name) {?>
                            <a class="btn__size-m 
                                      flex 
                                      flex__jc_center
                                      bg-color__gradient_lb-light-green
                                      bg-shadow__s
                                      
                                      <?php 
                                          if (($i % 2) == 0) {
                                              echo 'rotate__right_12deg anim__swing-left';
                                          } else {
                                              echo 'rotate__left_12deg anim__swing-right';
                                          } 
                                      ?>"
                                      
                               href="<?php echo $url; ?>">
                               
                                <p class="flex-item__align-self_center
                                          <?php 
                                              if (($i % 2) == 0) {
                                                echo 'rotate__left_12deg';
                                              } else {
                                                echo 'rotate__right_12deg';
                                              }
                                          ?>">
                                    <?php echo $btn_name; ?>
                                </p>
                            </a>
                            <?php $i++; ?>
                        <?php } ?>
                    <!-- End of buttons definition -->
                </nav>
            <!-- Main nav block end -->
        </header>
    <!-- Header block end -->
 
    <!-- Main block start -->
    <div class="block__main
                flex 
                flex__flow_row-wrap
                flex__jc_space-around">
        
        <!-- Content block -->    
            <div class="block__content
                        flex
                        flex__jc_center
                        rotate__right_12deg
                        bg-color__gradient_rb-light-green
                        bg-shadow__m">
                <?php echo $content; ?> 
            </div>
        <!-- Content block end --> 
        
        <!-- Feedbacks block -->
            <?php if ($_SESSION['user_group'] == 'autorized') {?>
                <aside class="block__feedback
                              flex
                              flex__jc_center
                              rotate__left_12deg
                              bg-color__gradient_lb-light-green
                              bg-shadow__m">
                    <?php require 'weather_app/views/main/showFeedbacks.php'?>
                </aside>
            <?php } ?>
        <!-- Feedbacks block end -->
    </div>
    <!-- Main block end -->


    <footer class="block__footer
                   flex
                   flex__jc_space-evenly">
        
        <!-- Autor block -->
            <div class="block__author
                        flex
                        flex__jc_center
                        bg-color__gradient_lb-light-green
                        bg-shadow__s
                        rotate__left_12deg">
                        
                <p class="p 
                          rotate__right_12deg 
                          flex-item__align-self_center">Created by: Vachelsav Uslistyj</p>
            </div>
        <!-- Autor block end -->
        
        <!-- Contacts block -->
            <div class="block__contacts                     
                        flex
                        flex__jc_center
                        bg-color__gradient_rb-light-green
                        bg-shadow__s
                        rotate__right_12deg">
                        
                <p class="p 
                          rotate__left_12deg 
                          flex-item__align-self_center">vacheslavuslistyj@gmail.com</p>
            </div>
        <!-- Contacts block end -->
        
        <!-- Copyright block -->
            <div class="block__copyright
                        flex
                        flex__jc_center
                        bg-color__gradient_lb-light-green
                        bg-shadow__s
                        rotate__left_12deg">
                        
                <p class="p 
                          rotate__right_12deg 
                          flex-item__align-self_center">&copy;Uslistyj V. V. 2019</p>
            </div>
        <!-- Copyright block end -->        
    </footer>
    
    <!-- Slick settings for feedback block -->
        <?php if ($_SESSION['user_group'] == 'autorized') {?>
            <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
            <script src="slick-1.8.1/slick/slick.js"></script>
            
            <!-- Slick settings for feedback block -->
            <script>
              $(document).on('ready', function() {
                $('.feedback').slick();
              });
            </script>
        <?php } ?>
    <!-- Slick settings end -->   
    
</body>
</html>
