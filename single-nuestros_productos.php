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

        <div class="container py-4">
            <div class="row">
                <main class="col-lg-8 contenido-principal">
                    <h2 class="d-block d-md-none text-uppercase text-center"><?php the_title(); ?></h2>
                    <p><?php the_content(); ?></p>
                </main>
                
                <aside class="col-lg-4 pt-4 pt-lg-0 descripcion_producto">
                    <h3 class="text-uppercase text-center mt-5">Descripción</h3>
                    <p class="text-center lead p-3"><?php the_field('descripcion_corta'); ?></p>
                    
                    <h3 class="text-uppercase text-center mt-2">Precio</h3>
                    <p class="display-4 text-center p-3">$ <?php the_field('precio'); ?></p>
                </aside>
            </div>
        </div>
<?php endwhile; ?>

<?php get_footer(); ?>