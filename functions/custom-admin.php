<?php

function dscommerce_my_login_logo() {
    //Dreamsign logo
    $dreamsign_logo_url = get_template_directory_uri() . '/assets/img/dreamsign.svg';

    // Obtener ID del logo personalizado
    $custom_logo_id = get_theme_mod('custom_logo');
    
    // Obtener la URL del logo
    $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');

    // Usar una imagen por defecto si no hay logo personalizado
    if (!$logo_url) {
        $logo_url = $dreamsign_logo_url;
    }

    echo '<style type="text/css">
            body {background: #fafafa !important;}
            h1 a {
                background-image: url(' . esc_url($logo_url) . ') !important;
                background-position: center bottom !important;
                background-size: 200px !important;
                width:100% !important;
            }

            .wp-core-ui .button-primary {
                background: #144988 !important;
                border-color: #144988 #144988 #144988 !important;
                box-shadow: 0 1px 0 #144988 !important;
                text-shadow: 0 -1px 1px #144988, 1px 0 1px #144988, 0 1px 1px #144988, -1px 0 1px #144988 !important;
            }

            p#nav a, p#backtoblog a{color: #fff !important;}
        </style>';
}

add_action( 'login_enqueue_scripts', 'dscommerce_my_login_logo' );


function dscommerce_my_admin_logo() {
    //Dreamsign logo
    $dreamsign_logo_url = get_template_directory_uri() . '/assets/img/dreamsign.svg';

    echo '<style type="text/css">
            #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon {
                width: 120px;
                float: left !important;
            }
            #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
                background: url(' . esc_url($dreamsign_logo_url) . ') top no-repeat !important; 
                background-size: 100% !important;
                background-position: 0 0; 
                color: rgba(0, 0, 0, 0); 
                width: 120px; 
                float: left;
            }
            #wpadminbar #wp-admin-bar-wp-logo:hover > .ab-item{
                background-color: #712170;
            }
            #wpadminbar {
                background: #932771;
                background: linear-gradient(41deg, #932771, #662d91);
            }
            #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, 
            #adminmenu .wp-menu-arrow, 
            #adminmenu .wp-menu-arrow div, 
            #adminmenu li.current a.menu-top, 
            #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, 
            .folded #adminmenu li.current.menu-top, 
            .folded #adminmenu li.wp-has-current-submenu { 
                background: #662d91; 
            }
            #adminmenu li.menu-top:hover, #adminmenu li.opensub>a.menu-top, #adminmenu li>a.menu-top:focus { color: #ffffff; }
            #adminmenu .wp-submenu a:focus, #adminmenu .wp-submenu a:hover, #adminmenu a:hover, #adminmenu li.menu-top>a:focus { color: #ffffff; }
            #adminmenu li a:focus div.wp-menu-image:before, #adminmenu li.opensub div.wp-menu-image:before, #adminmenu li:hover div.wp-menu-image:before { color: #ffffff; }
            #ubicacionesdiv { display: none; }
            #adminmenu .wp-submenu a:focus, #adminmenu .wp-submenu a:hover, #adminmenu a:hover, #adminmenu li.menu-top>a:focus { color: white; }

            #collapse-button {
                display:none !important;
                visibility: hidden;
            }
        </style>';
}

add_action('wp_before_admin_bar_render', 'dscommerce_my_admin_logo');

?>