<?php

// Cargar hojas de estilos y Scripts
function carolinaspa_styles() {
    
    // Hojas de Estilos
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.0.0' );
    wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css?family=Italianno|Lato:400,700,900|Raleway:400,700,900', array(), '1.0');
    wp_enqueue_style('style', get_stylesheet_uri(), array('bootstrap'), '1.0' );
    
    // Scripts
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('tether', get_template_directory_uri() . '/js/tether.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.0', true);
    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts','carolinaspa_styles');

// Setup Theme

function carolinaspa_setup() {
    // Imagenes Destacadas
    add_theme_support('post-thumbnails');
    
    // Actualizar tamaños de imagen
    update_option('thumbnail_size_w', 217);
    update_option('thumbnail_size_h', 143);
    
    // Agregar Imagenes
    add_image_size('productos', 1140, 466, true);
    add_image_size('producto_thumb', 400, 266, true);
    add_image_size('portrait', 350, 409, true);
    
    
    
    // Menus o Navegaciones
    register_nav_menus( array(
        'menu_principal' => esc_html__('Menu Principal', 'carolinaspa'),
        'social_menu' => esc_html__('Menu Social', 'carolinaspa')
    )  );
}
add_action('after_setup_theme', 'carolinaspa_setup');

// Agrega la clase nav-item de bootstrap al <li> del menu_principal
function carolinaspa_li_class($classes, $item, $args) {
    if($args->theme_location == 'menu_principal') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'carolinaspa_li_class', 1, 3);

// Agrega la clase nav-link de bootstrap al <a> del menu_principal
function carolinaspa_a_class($atts, $item, $args) {
    if($args->theme_location == 'menu_principal') {
        $class = 'class';
        $atts['class'] = 'nav-link';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'carolinaspa_a_class', 10, 3);

// Zona de Widgets
function carolinaspa_widgets(){
    register_sidebar(array(
        'name'     => 'Footer Widget 1',
        'id'       => 'footer_widget_1', 
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-uppercase text-center pb-4">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name'     => 'Footer Widget 2',
        'id'       => 'footer_widget_2', 
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-uppercase text-center pb-4">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name'     => 'Footer Widget 3',
        'id'       => 'footer_widget_3', 
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-uppercase text-center pb-4">',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name'     => 'Sidebar Widget 1',
        'id'       => 'sidebar_widget_1', 
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="text-center text-uppercase mt-4">',
        'after_title' => '</h2>'
    ));
}
add_action('widgets_init', 'carolinaspa_widgets');

// Widget Horario
class Widget_Horario extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'widget_horario', // Base ID
			esc_html__( 'Tabla Horario', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Agrega el Horario de trabajo', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		} 
         // Comienzo de Widget desde ACF
        ?>
        
        <?php $nosotros = get_page_by_title('Nosotros'); ?>
        <p class="text-center mt-5 lead"><?php the_field('horarios_texto', $nosotros->ID); ?></p>
        <?php $horario = get_field('horario', $nosotros->ID);
              if($horario):
         ?>
                <table class="table table-hover text-center mt-5">
                     <thead>
                         <tr>
                             <?php foreach($horario['header'] as $th): ?>
                             <th class="text-center"><?php echo $th['c']; ?></th>
                             <?php endforeach; ?>
                         </tr>
                     </thead>
                     <tbody>
                         <?php foreach($horario['body'] as $tr):  ?>     
                         <tr>
                              <?php foreach($tr as $td): ?>
                                  <td><?php echo $td['c']; ?></td>
                              <?php endforeach; ?>
                         </tr>
                         <?php endforeach; ?>
                     </tbody>
                </table>
        <?php 
            endif;
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Widget_Horario

// register Widget_Horario widget
function carolinaspa_horario_widget() {
    register_widget( 'Widget_Horario' );
}
add_action( 'widgets_init', 'carolinaspa_horario_widget' );


// Agregar Post Type de Productos
function carolinaspa_productos() {

	$labels = array(
		'name'                  => _x( 'Productos', 'Post Type General Name', 'carolinaspa' ),
		'singular_name'         => _x( 'Producto', 'Post Type Singular Name', 'carolinaspa' ),
		'menu_name'             => __( 'Productos', 'carolinaspa' ),
		'name_admin_bar'        => __( 'Producto', 'carolinaspa' ),
		'archives'              => __( 'Archivo Producto', 'carolinaspa' ),
		'attributes'            => __( 'Atributos Producto', 'carolinaspa' ),
		'parent_item_colon'     => __( 'Producto Padre', 'carolinaspa' ),
		'all_items'             => __( 'Todos los Productos', 'carolinaspa' ),
		'add_new_item'          => __( 'Agregar Producto', 'carolinaspa' ),
		'add_new'               => __( 'Agregar Producto', 'carolinaspa' ),
		'new_item'              => __( 'Nuevo Producto', 'carolinaspa' ),
		'edit_item'             => __( 'Editar Producto', 'carolinaspa' ),
		'update_item'           => __( 'Actualizar Producto', 'carolinaspa' ),
		'view_item'             => __( 'Ver Producto', 'carolinaspa' ),
		'view_items'            => __( 'Ver Productos', 'carolinaspa' ),
		'search_items'          => __( 'Buscar Productos', 'carolinaspa' ),
		'not_found'             => __( 'No Encontrado', 'carolinaspa' ),
		'not_found_in_trash'    => __( 'No Encontrado en Papelera', 'carolinaspa' ),
		'featured_image'        => __( 'Imagen Destacada', 'carolinaspa' ),
		'set_featured_image'    => __( 'Agregar Imagen destacada', 'carolinaspa' ),
		'remove_featured_image' => __( 'borrar imagen destacada', 'carolinaspa' ),
		'use_featured_image'    => __( 'Usar como imagen destacada', 'carolinaspa' ),
		'insert_into_item'      => __( 'Insertar en Producto', 'carolinaspa' ),
		'uploaded_to_this_item' => __( 'Actualizar Producto', 'carolinaspa' ),
		'items_list'            => __( 'Lista de Productos', 'carolinaspa' ),
		'items_list_navigation' => __( 'Navegacion de Productos', 'carolinaspa' ),
		'filter_items_list'     => __( 'Filtrar Productos', 'carolinaspa' ),
	);
	$args = array(
		'label'                 => __( 'Producto', 'carolinaspa' ),
		'description'           => __( 'Productos Carolina Spa', 'carolinaspa' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'nuestros_productos', $args );

}
add_action( 'init', 'carolinaspa_productos', 0 );

// Shortcode que imprime los productos
// Utilizalo asi: [carolinaspa_productos numero=numero]
function carolinaspa_productos_shortcode($productos) {
    $args = array(
        'posts_per_page' => $productos['numero'],
        'post_type' => 'nuestros_productos',
        'orderby' => 'name',
        'order' => 'ASC'
    );
    $productos = new WP_Query($args); ?>
    
    
    <div class="container productos pt-5">
    <div class="row">
    <?php while($productos->have_posts()): $productos->the_post(); ?>
    
            <div class="col-6 col-md-3 mb-4 mb-md-0">
                  <div class="card">
                      <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('producto_thumb', array('class' => 'card-img-top img-fluid')); ?>
                            <div class="card-block">
                                <h3 class="card-title text-center text-uppercase"><?php the_title(); ?></h3>
                                <p class="card-text text-uppercase"><?php the_field('descripcion_corta'); ?></p>
                                <p class="precio lead text-center mb-0">$ <?php the_field('precio'); ?></p>
                            </div>
                      </a>
                  </div>
            </div> <!--.col-6-->        
    
    <?php endwhile; wp_reset_postdata();
    
    echo "</div>";
    echo "</div>";
}
add_shortcode('carolinaspa_productos', 'carolinaspa_productos_shortcode');

// Shortcode que imprime los productos
// Utilizalo asi: [carolinaspa_contacto]

function carolinaspa_contacto_shortcode() { ?>
        <form id="formulario-contacto" class="p-5 mt-5 formulario-contacto" action="<?php echo get_template_directory_uri(); ?>enviar.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu Nombre" required>
                <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Tu Email">
                <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="6"></textarea>
                <small class="form-text text-muted"></small>
            </div>
            <input type="submit" class="btn btn-primary text-uppercase" name="enviar" value="Enviar">
            <div id="resultado" class="alert alert-success"></div>
        </form>
    
    <?php
}
add_shortcode('carolinaspa_contacto', 'carolinaspa_contacto_shortcode');












