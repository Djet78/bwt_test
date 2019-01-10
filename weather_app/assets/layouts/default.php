<!DOCTYPE html>
<html class="occupy-all gradient__rt_azure">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>

    <style>
        <?php require "weather_app/assets/main.css"; ?>
    </style>  

</head>

<body class="flex 
             flex__main-page-def 
             occupy-all">

    <div class="block__main 
                flex 
                flex__main-block-def 
                rotate_right-12deg
                gradient__rb_light-green">
     
        <header class="block__header 
                       flex 
                       flex__header-block-def">
            
            <div class="logo">
                <p>Logo Placeholder</p>
            </div>
            
            <nav class="flex">
                    <?php if ($_SESSION['user_group'] == 'autorized') {?>
                        <a class="btn 
                                  flex 
                                  btn__flex-column 
                                  btn__style_main-nav" 
                           href="/logout">
                            <p class="rotate_left-12deg">logout</p>
                        </a>       
                        
                        <a class="btn 
                                  flex 
                                  btn__flex-column 
                                  btn__style_main-nav" 
                           href="/logout">
                            <p class="rotate_left-12deg">logout2</p>
                        </a>
                        
                    <?php } else { ?>
                        <a class="btn 
                                  flex 
                                  btn__flex-column 
                                  btn__style_main-nav" 
                            href="/register">
                            <p class="rotate_left-12deg">register</p>
                        </a>
                        
                        <a class="btn 
                                  flex 
                                  btn__flex-column 
                                  btn__style_main-nav" 
                           href="/login">
                            <p class="rotate_left-12deg">login</p>
                        </a>
                    <?php } ?>
            </nav>

        </header>
        <?php echo $content; ?>
        <footer class="block__footer
                       flex
                       flex__footer-block-def">
            <div class="author">
            </div>
            <div class="contacts">
            </div>
            <div class="copyright">
            </div>
            
        </footer>
       
    </div>

    <aside class="block__feedback 
                  gradient__lb_light-green 
                  rotate_left-12deg">
    </aside>

</body>
</html>
