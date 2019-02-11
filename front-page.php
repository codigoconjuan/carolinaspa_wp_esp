<?php get_header(); ?>

<div class="container">
       <div id="slider-principal" class="carousel slide mt-4" data-ride="carousel">
           <?php $args = array(
               'posts_per_page' => 5,
               'tag' => 'slider'
           ); 
           $slider = new WP_Query($args);
           if($slider->have_posts()):
              $cuenta = $slider->found_posts;
           ?>
             
             <ol class="carousel-indicators">
                 <?php for($i = 0; $i < $cuenta; $i++) { ?>
                     <li data-target="#slider-principal" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? 'active' : '' ?>"></li>
                 <?php } ?>
             </ol>
           
             
             
             <div class="carousel-inner" role="listbox">
                 <?php $i = 0;  while($slider->have_posts()): $slider->the_post(); ?>
                     
                           <div class="carousel-item <?php echo ($i == 0) ? 'active' : '' ?>">
                               <a href="<?php the_permalink() ?>">
                                 <?php the_post_thumbnail('productos', array(
                                                                            'class' => 'd-block img-fluid',
                                                                            'alt' => get_the_title()) ); ?>
                                </a>
                                 <div class="carousel-caption d-none d-md-block">
                                     <h3 class="text-uppercase"><?php the_title(); ?></h3>
                                 </div>
                           </div><!--.carousel-item-->
                   
                <?php $i++; endwhile; ?>
             </div> <!--.carousel-inner-->
             
             <a href="#slider-principal" class="carousel-control-prev" data-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="sr-only">Anterior</span>
             </a>
             
             <a href="#slider-principal" class="carousel-control-next" data-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="sr-only">Siguiente</span>
             </a>
         <?php endif; wp_reset_postdata(); ?>
         
       </div><!--#slider-principal-->
   </div><!--.container-->
   
   
   <section class="nuevo-sitio py-5">
     <h2 class="text-center text-uppercase mt-4"><span class="text-lowercase d-block">bienvenido a nuestro</span> sitio web</h2>
     <p class="text-center mt-4"><?php echo get_bloginfo('description'); ?></p>
 </section>

 <div class="container pb-5">
      <div class="row justify-content-center">
          <?php $args = array(
              'post_type' => 'page', 
              'post_name__in' => array('nosotros', 'productos', 'servicios'),
              'orderby' => 'name', 
              'order' => 'ASC'
          );
          $principales = new WP_Query($args);
          while($principales->have_posts()): $principales->the_post();
           ?>
          <div class="col-12 col-md-4 text-center mb-4 mb-md-0 ">
              <div class="imagen-links">
                  <img src="<?php the_field('imagen_principal'); ?>" class="img-fluid">
                  <div class="row no-gutters">
                      <div class="col-8 offset-2 col-md-10 offset-md-1 imagen-info pt-4">
                          <?php the_field('titulo_principal'); ?>
                          <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block text-uppercase mt-4 py-3">leer más</a>
                      </div>
                  </div>
              </div>
          </div> <!--.col-12-->
         <?php endwhile; wp_reset_postdata(); ?>
          
      </div>
  </div><!--.container-->
  
  
  <div class="horario ">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12 p-4">
                  <?php
                    $args = array(
                        'before_title' => '<h2 class="text-center text-uppercase mt-4">',
                        'after_title' => '</h2>'
                    );
                    the_widget('Widget_Horario', 'title=Horarios', $args);
                   ?>
            </div>
            <div class="col-md-6 col-12 bg-horario ">
              
            </div>
        </div> <!--.row-->
    </div><!--.container-->
</div> <!--.horario-->




   <section class="productos container py-5">
       <h2 class="text-center text-uppercase mt-4"><span class="text-lowercase d-block">nuestros</span> productos</h2>
       
       <div class="row py-5">
                  <?php echo do_shortcode('[carolinaspa_productos numero=4]'); ?>
       </div><!--.row-->
       <a href="<?php echo get_permalink(36); ?>" class="btn btn-success float-right tienda">Ver más</a>
   </section>
   
   
    <?php get_template_part('templates/citas'); ?>


<?php get_footer(); ?>