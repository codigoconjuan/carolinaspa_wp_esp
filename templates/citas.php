<div class="citas container-fluid py-5 mt-5">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 py-3 text-center">
            <h3 class="text-uppercase">Realiza una cita</h3>
            <p class="mt-5">Maecenas rhoncus, augue sed volutpat suscipit, augue felis laoreet lectus, vel convallis diam est eu lectus. Mauris metus orci, tempus nec bibendum eget, pulvinar at metus. Etiam egestas sodales auctor.</p>
            <?php
                $contacto = get_page_by_title('Contacto');
            ?>
            <a href="<?php echo get_permalink($contacto->ID); ?>" class="text-uppercase btn btn-primary mt-3 btn-lg">leer más</a>
        </div> <!--.col-12-->
    </div><!--.row-->
</div><!--.citas-->