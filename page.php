<?php get_header(); ?>


<?php while(have_posts()): the_post(); ?>
<div class="container pt-4">
    <div class="row no-gutters">
        <div class="col-12 hero">
            <?php the_post_thumbnail('full', array('class' => 'img-fluid') ); ?>
            <h2 class="text-uppercase d-none d-md-block"><?php the_title(); ?></h2>
        </div>
    </div>
</div>


<div class="container pt-4">
    <div class="row">
        <main class="col-lg-8 contenido-principal">
            <h2 class="d-block d-md-none text-uppercase text-center"><?php the_title(); ?></h2>
            <?php the_content(); ?>
            
            <?php if( is_page('nosotros')):
                    get_template_part('templates/galeria');
                endif;
            ?>
        </main>
            
        <?php get_sidebar(); ?>
    </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>