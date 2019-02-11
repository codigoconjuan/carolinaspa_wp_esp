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
            
            
            <div id="servicios" role="tablist" aria-multiselectable="true">
                                <div class="card">
                                        <div class="card-header py-2" role="tab" id="servicio_1">
                                            <h3 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#servicios" href="#servicio_1desc" aria-expanded="true" aria-controls="#servicio_1desc"><?php the_field('titulo_servicio_1'); ?></a>
                                            </h3>
                                        </div> <!--.card-header-->
                                        
                                        <div id="servicio_1desc" class="collapse show" role="tabpanel" aria-labelledby="servicio_1">
                                            <div class="card-block">
                                                <p><?php the_field('descripcion_servicio_1'); ?></p>
                                            </div>
                                        </div>
                                </div> <!--.card-->
                                
                                
                                <div class="card">
                                        <div class="card-header py-2" role="tab" id="servicio_2">
                                            <h3 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#servicios" href="#servicio_2desc" aria-expanded="false" aria-controls="#servicio_2desc" ><?php the_field('titulo_servicio_2'); ?></a>
                                            </h3>
                                        </div> <!--.card-header-->
                                        
                                        <div id="servicio_2desc" class="collapse" role="tabpanel" aria-labelledby="servicio_2">
                                            <div class="card-block">
                                                <p><?php the_field('descripcion_servicio_2'); ?></p>
                                            </div>
                                        </div>
                                </div> <!--.card-->
                                
                                <div class="card">
                                        <div class="card-header py-2" role="tab" id="servicio_3">
                                            <h3 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#servicios" href="#servicio_3desc" aria-expanded="false" aria-controls="#servicio_3desc" ><?php the_field('titulo_servicio_3'); ?></a>
                                            </h3>
                                        </div> <!--.card-header-->
                                        
                                        <div id="servicio_3desc" class="collapse" role="tabpanel" aria-labelledby="servicio_3">
                                            <div class="card-block">
                                                <p><?php the_field('descripcion_servicio_3'); ?></p>
                                            </div>
                                        </div>
                                </div> <!--.card-->
                        </div>
        </main>
            
        <?php get_sidebar(); ?>
    </div>
</div>
<?php endwhile; ?>

<?php get_template_part('templates/citas'); ?>
<?php get_footer(); ?>