<?php
// Eliminar estilos por defecto de WooCommerce si quieres más control
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Personalizar número de productos por página
add_filter( 'loop_shop_per_page', function() {
    return 12;
}, 20 );
