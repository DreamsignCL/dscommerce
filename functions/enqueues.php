<?php
function dscommerce_enqueue_scripts() {
    $theme_version = wp_get_theme()->get('Version');

    $font = get_theme_mod('ds_general_font', 'Roboto');

    // Google Fonts
    wp_enqueue_style('dscommerce-google-fonts', 'https://fonts.googleapis.com/css2?family='.$font.'&display=swap', false, null);

    //Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', [], '6.4.0');

    // CSS compilado
    wp_enqueue_style('dscommerce-style', get_template_directory_uri() . '/assets/css/style.css', [], filemtime(get_template_directory() . '/assets/css/style.css'));

    // Tu propio JS
    wp_enqueue_script('dscommerce-main', get_template_directory_uri() . '/assets/js/main.js', [], filemtime(get_template_directory() . '/assets/js/main.js'), true);
}
add_action('wp_enqueue_scripts', 'dscommerce_enqueue_scripts');

function dscommerce_resource_hints($hints, $relation_type) {
    if ('preconnect' === $relation_type) {
        $hints[] = [
            'href' => 'https://fonts.googleapis.com',
        ];
        $hints[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }
    return $hints;
}
add_filter('wp_resource_hints', 'dscommerce_resource_hints', 10, 2);

/*
--------------------------------
El siguiente Enqueue es para llamar a slider-metabox.js quien hace funcionar
los type=file ubicados en el editor de la página de inicio, y está separado del resto
para que solo se cargue cuando estamos en el admin de wordpress
-----------------------------------------------------------------
*/

function dscommerce_enqueue_admin_assets($hook) {
    global $post;

    // Solo cargar en el editor de páginas
    if (($hook === 'post.php' || $hook === 'post-new.php') && $post && $post->post_type === 'page') {

        // Solo para la página de inicio
        if (get_option('page_on_front') == $post->ID) {
            wp_enqueue_media();
            wp_enqueue_script(
                'slider-metabox-script',
                get_template_directory_uri() . '/assets/js/slider-metabox.js',
                ['jquery'],
                null,
                true
            );
        }
    }
}
add_action('admin_enqueue_scripts', 'dscommerce_enqueue_admin_assets');