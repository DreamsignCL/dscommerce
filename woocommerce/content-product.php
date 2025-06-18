<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>

<div <?php wc_product_class( 'card h-100', $product ); ?>>
    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-reset">
        <?php
        /**
         * Muestra la imagen del producto
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>
    </a>

    <div class="card-body d-flex flex-column">
        <?php
        /**
         * Muestra el título del producto
         */
        do_action( 'woocommerce_shop_loop_item_title' );

        /**
         * Muestra la valoración y el precio
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>
        <div class="mt-auto">
            <?php
            /**
             * Muestra el botón "Añadir al carrito"
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>
        </div>
    </div>
</div>