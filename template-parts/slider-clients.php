<?php
/**
 * Template part for the clients slider
 */
?>
<div class="slider slider--clients">
    <div class="slider__slides">
        <?php
        $clientes = new WP_Query([
            'post_type' => 'cliente',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ]);

        if ($clientes->have_posts()) :
            while ($clientes->have_posts()) : $clientes->the_post();
                $url = get_post_meta(get_the_ID(), '_cliente_url', true);
                $img = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                $alt = get_the_title();

                if ($img) :
                    if ($url) :
                        echo '
                            <div class="slider__slide">
                                <a href="' . esc_url($url) . '" target="_blank" rel="noopener" title="Ir al sitio web">
                                    <img src="' . esc_url($img) . '" alt="' . esc_attr($alt) . '">
                                </a>
                            </div>
                        ';
                    else:
                        echo '
                            <div class="slider__slide">
                                <img src="' . esc_url($img) . '" alt="' . esc_attr($alt) . '">
                            </div>
                        ';
                    endif;
                endif;
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>