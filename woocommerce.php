<?php
get_header();

if ( have_posts() ) : 
    woocommerce_content();
else :
    echo '<p>No hay productos para mostrar.</p>';
endif;

get_footer();
