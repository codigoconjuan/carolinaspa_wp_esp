<footer class="footer-sitio pt-3 mt-5">
    <div class="container">
            <div class="row">
                    <div class="col-md-4">

                        <?php
                            if(is_active_sidebar('footer_widget_1')) {
                                dynamic_sidebar('footer_widget_1');
                            }
                        ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <?php
                            if(is_active_sidebar('footer_widget_2')) {
                                dynamic_sidebar('footer_widget_2');
                            }
                        ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <?php
                            if(is_active_sidebar('footer_widget_3')) {
                                dynamic_sidebar('footer_widget_3');
                            }
                        ?>
                        
                        <?php
                          $args = array(
                              'container' => 'nav',
                              'container_class' => 'sociales text-center text-md-right pt-3',
                              'link_before' => '<span class="sr-only">',
                              'link_after' => '</span>',
                              'theme_location' => 'social_menu'
                          );
                          wp_nav_menu($args);
                        ?>
                    </div>
                    
                    <div class="w-100"></div>
                    <hr class="w-100">
                    <p class="text-center copyright w-100"><?php echo get_bloginfo('name') . " " . date('Y'); ?></p>
            </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>