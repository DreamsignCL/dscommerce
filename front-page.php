<?php
get_header();
?>

<main role="main">
    <!-- 🖼️ SLIDER -->
    <?php get_template_part('template-parts/slider-home'); ?>

    <!-- 🛒 PRODUCTOS DESTACADOS -->
    <section>
        <div class="container">

            <h2 class="mb-4">Nuestros productos</h2>
    
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                <?php
                // Consulta los productos publicados
                $args = [
                    'post_type' => 'product',
                    'posts_per_page' => 6, // cambia si quieres más
                ];
                $loop = new WP_Query($args);
    
                if ($loop->have_posts()) :
                    while ($loop->have_posts()) : $loop->the_post();
                        wc_get_template_part('content', 'product');
                    endwhile;
                else :
                    echo '<p>No hay productos disponibles.</p>';
                endif;
    
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- 🖼️ CLIENTS SLIDER -->
    <?php get_template_part('template-parts/slider-clients'); ?>

</main>

<?php get_footer(); ?>
