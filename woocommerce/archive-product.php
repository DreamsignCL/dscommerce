<?php
defined('ABSPATH') || exit;

get_header(); // Usa header.php o crea un header-shop.php si necesitas algo distinto

?>

<main class="container my-5" role="main">
    <header class="woocommerce-products-header mb-4">
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <h1 class="h3 mb-3"><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>

        <?php do_action('woocommerce_archive_description'); ?>
    </header>

    <?php if (woocommerce_product_loop()) : ?>
        <?php do_action('woocommerce_before_shop_loop'); ?>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col">
                    <?php wc_get_template_part('content', 'product'); ?>
                </div>
            <?php endwhile; ?>
        </div>

        <?php do_action('woocommerce_after_shop_loop'); ?>
    <?php else : ?>
        <?php do_action('woocommerce_no_products_found'); ?>
    <?php endif; ?>
</main>

<?php
get_footer(); // O usa get_footer() si no tienes uno especial
?>
