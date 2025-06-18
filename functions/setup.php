<?php
function dscommerce_setup() {
    // Add WooCommerce support
    add_theme_support( 'woocommerce' );

    // Add custom logo
    add_theme_support( 'custom-logo' );

    // Title tag
    add_theme_support( 'title-tag' );

    // Featured images
    add_theme_support( 'post-thumbnails' );

    // HTML5 markup
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    // Nav menus
    register_nav_menus([
        'main-menu' => __( 'Main Menu', 'dscommerce' ),
        'second-menu' => __( 'Secondary Menu', 'dscommerce' ),
        'footer-menu'  => __( 'Footer Menu', 'dscommerce' )
    ]);
}
add_action( 'after_setup_theme', 'dscommerce_setup' );
/*
---------------------------------------------------------------
------------------NAV WALKER PARA EL MENU----------------------
---------------------------------------------------------------
*/

class dscommerce_walker_menu extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"main-nav__sublist\">\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $classes = ['main-nav__item'];

        // Si el ítem está activo (en la página actual)
        if (in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes)) {
            $classes[] = 'active';
        }

        // Si tiene hijos
        if (in_array('menu-item-has-children', $item->classes)) {
            $classes[] = 'main-nav__item--has-children';
        }

        $class_names = implode(' ', array_map('esc_attr', array_filter($classes)));

        $output .= '<li class="' . $class_names . '">';

        // Enlace
        $attributes  = ' class="main-nav__link"';
        $attributes .= !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';

        $title = apply_filters('the_title', $item->title, $item->ID);
        $output .= '<a' . $attributes . '>' . $title . '</a>';
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "</ul>\n";
    }
}


/*
------------INSERTAR VARIABLES EN EL FRONTEND--------------------
Aqui capturamos las variables creadas en el "customizer.php", para
luego insertarlas en el front end o donde las necesitemos.
-----------------------------------------------------------------
*/

//Inservión de variables en el :root
function dscommerce_customize_css() {
    echo "<style>
    :root {
        --font-family-site: '" . get_theme_mod('ds_general_font', 'Roboto') . "';
        --background-color-site: " . get_theme_mod('ds_general_color_background_color_site', '#ffffff') . ";
        --title-color-site: " . get_theme_mod('ds_general_color_title_color_site', '#212529') . ";
        --subtitle-color-site: " . get_theme_mod('ds_general_color_subtitle_color_site', '#212529') . ";
        --text-color-site: " . get_theme_mod('ds_general_color_text_color_site', '#212529') . ";
        --color-primary: " . get_theme_mod('ds_color_primary', '#0d6efd') . ";
        --color-primary-hover: " . get_theme_mod('ds_color_primary_hover', '#0b5ed7') . ";
        --color-secondary: " . get_theme_mod('ds_color_secondary', '#6c757d') . ";
        --color-secondary-hover: " . get_theme_mod('ds_color_secondary_hover', '#5c636a') . ";
        --color-success: " . get_theme_mod('ds_color_success', '#198754') . ";
        --color-success-hover: " . get_theme_mod('ds_color_success_hover', '#157347') . ";
        --color-danger: " . get_theme_mod('ds_color_danger', '#db0d30') . ";
        --color-danger-hover: " . get_theme_mod('ds_color_danger_hover', '#b00925') . ";
        --color-warning: " . get_theme_mod('ds_color_warning', '#ffc107') . ";
        --color-warning-hover: " . get_theme_mod('ds_color_warning_hover', '#ffc720') . ";
        --color-info: " . get_theme_mod('ds_color_info', '#3dd5f3') . ";
        --color-info-hover: " . get_theme_mod('ds_color_info_hover', '#25cff2') . ";        
        --background-color-header: " . get_theme_mod('ds_header_color_background', '#ffffff') . ";
        --text-color-header: " . get_theme_mod('ds_header_color_texts', '#000000') . ";
        --link-color-header: " . get_theme_mod('ds_header_color_links', '#000000') . ";
        --link-hover-color-header: " . get_theme_mod('ds_header_color_links_hover', '#000000') . ";
        --background-color-footer: " . get_theme_mod('ds_footer_color_background', '#ffffff') . ";
        --text-color-footer: " . get_theme_mod('ds_footer_color_texts', '#000000') . ";
        --link-color-footer: " . get_theme_mod('ds_footer_color_links', '#000000') . ";
        --link-hover-color-footer: " . get_theme_mod('ds_footer_color_links_hover', '#000000') . ";
    }
    </style>";
}
add_action('wp_head', 'dscommerce_customize_css');

/*
---------------------------------------------------------------
------------FUNCIÓN PARA LAS REDES SOCIALES--------------------
---------------------------------------------------------------
*/

function dscommerce_get_social_networks() {
    return [
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'twitter'   => 'Twitter',
        'whatsapp'  => 'WhatsApp',
        'youtube'   => 'YouTube',
        'linkedin'  => 'LinkedIn',
        'pinterest' => 'Pinterest',
        'tiktok'    => 'TikTok'
    ];
}

if (!function_exists('get_icon')) {
    function get_icon($slug) {
        return "<i class='fab fa-{$slug} social-nav__icon' aria-hidden='true'></i>";
    }
}

function dscommerce_social_nav($location = 'top') {
    $social = dscommerce_get_social_networks();

    // Si al menos uno existe, renderizamos
    $any_social = false;
    foreach ($social as $slug => $label) {
        if (get_theme_mod("ds_contact_$slug")) {
            $any_social = true;
            break;
        }
    }

    ?>
    <nav class="social-nav social-nav--<?php echo esc_attr($location); ?>" aria-label="Redes sociales">
        <ul class="social-nav__list">
            <?php foreach ($social as $slug => $label):
                $url = esc_url(get_theme_mod("ds_contact_$slug"));
                if (!$url) continue;
                ?>
                <li class="social-nav__item">
                    <a 
                        class="social-nav__link" 
                        href="<?php echo $url; ?>" 
                        target="_blank"
                        title="Abrir enlace a <?php echo esc_html($label); ?>" 
                        rel="noopener noreferrer">
                        <span class="sr-only"><?php echo esc_html($label); ?></span>
                        <?php echo get_icon($slug); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php
}

// Desactivar editor de bloques
add_filter('use_block_editor_for_post', '__return_false', 10);

// Desactivar estilos base de wordpress
function dscommerce_remove_block_library_css() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles'); // Opcional: quita los estilos globales del theme.json
}
add_action('wp_enqueue_scripts', 'dscommerce_remove_block_library_css', 100);

// Remover el width y height de la etiqueta de imagen en los thumbnails
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );


