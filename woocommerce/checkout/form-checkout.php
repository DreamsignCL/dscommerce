<?php
defined('ABSPATH') || exit;

// Mostrar errores del checkout si los hubiera
do_action('woocommerce_before_checkout_form', $checkout);

// Si el carrito requiere iniciar sesión y el usuario no está logueado, se muestra un aviso
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', 'Debes iniciar sesión para finalizar tu compra.'));
    return;
}
?>

<div class="container my-5">
    <h1 class="h3 mb-4"><?php esc_html_e('Finalizar compra', 'woocommerce'); ?></h1>

    <form name="checkout" method="post" class="checkout woocommerce-checkout row g-5"
          action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

        <?php if ($checkout->get_checkout_fields()) : ?>
            <div class="col-md-7">
                <h2 class="h5 mb-3"><?php esc_html_e('Datos de facturación', 'woocommerce'); ?></h2>

                <?php
                // Genera los campos de facturación (nombre, email, dirección, etc.)
                do_action('woocommerce_checkout_billing');
                ?>

                <h2 class="h5 mt-4 mb-3"><?php esc_html_e('Información de envío', 'woocommerce'); ?></h2>

                <?php
                // Genera los campos de envío (puede ser la misma dirección u otra)
                do_action('woocommerce_checkout_shipping');
                ?>
            </div>
        <?php endif; ?>

        <div class="col-md-5">
            <h2 class="h5 mb-3"><?php esc_html_e('Tu pedido', 'woocommerce'); ?></h2>

            <?php
            // Muestra el resumen del pedido (productos, totales, envíos, etc.)
            do_action('woocommerce_checkout_before_order_review_heading');
            ?>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php
                // Genera la tabla del pedido con resumen y métodos de pago
                do_action('woocommerce_checkout_order_review');
                ?>
            </div>
        </div>
    </form>
</div>

<?php
// Hook final después del formulario de checkout
do_action('woocommerce_after_checkout_form', $checkout);
