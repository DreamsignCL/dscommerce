<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<div class="container my-5">
    <h1 class="h3 mb-4"><?php esc_html_e('Carrito de compras', 'woocommerce'); ?></h1>

    <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
        <div class="table-responsive">
            <table class="shop_table shop_table_responsive cart table align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="product-thumbnail"><?php esc_html_e('Producto', 'woocommerce'); ?></th>
                        <th class="product-name"></th>
                        <th class="product-price"><?php esc_html_e('Precio', 'woocommerce'); ?></th>
                        <th class="product-quantity"><?php esc_html_e('Cantidad', 'woocommerce'); ?></th>
                        <th class="product-subtotal"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
                        <th class="product-remove"><?php esc_html_e('Eliminar', 'woocommerce'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php do_action('woocommerce_before_cart_contents'); ?>

                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                        $_product   = $cart_item['data'];
                        $product_id = $cart_item['product_id'];

                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
                            ?>
                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                                <td class="product-thumbnail">
                                    <?php
                                    $thumbnail = $_product->get_image('woocommerce_thumbnail');
                                    if (!$_product->is_visible()) {
                                        echo $thumbnail;
                                    } else {
                                        printf('<a href="%s">%s</a>', esc_url($_product->get_permalink($cart_item)), $thumbnail);
                                    }
                                    ?>
                                </td>

                                <td class="product-name">
                                    <?php
                                    if (!$_product->is_visible()) {
                                        echo wp_kses_post($_product->get_name());
                                    } else {
                                        echo wp_kses_post(sprintf('<a href="%s">%s</a>', esc_url($_product->get_permalink($cart_item)), $_product->get_name()));
                                    }

                                    // Meta data y backorder
                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
                                    ?>
                                </td>

                                <td class="product-price">
                                    <?php echo wc_price($_product->get_price()); ?>
                                </td>

                                <td class="product-quantity">
                                    <?php
                                    if ($_product->is_sold_individually()) {
                                        echo '1';
                                    } else {
                                        woocommerce_quantity_input([
                                            'input_name'  => "cart[{$cart_item_key}][qty]",
                                            'input_value' => $cart_item['quantity'],
                                            'min_value'   => '0',
                                            'max_value'   => $_product->get_max_purchase_quantity(),
                                        ], $_product, true);
                                    }
                                    ?>
                                </td>

                                <td class="product-subtotal">
                                    <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                </td>

                                <td class="product-remove">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="btn btn-sm btn-outline-danger" aria-label="%s">&times;</a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            esc_html__('Eliminar este producto', 'woocommerce')
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </td>
                            </tr>
                            <?php
                        endif;
                    endforeach;
                    ?>

                    <?php do_action('woocommerce_cart_contents'); ?>
                </tbody>
            </table>
        </div>

        <div class="cart-actions d-flex justify-content-between mt-4">
            <?php if (wc_coupons_enabled()) : ?>
                <div class="coupon">
                    <label for="coupon_code" class="form-label"><?php esc_html_e('Cupón:', 'woocommerce'); ?></label>
                    <div class="input-group">
                        <input type="text" name="coupon_code" class="form-control" placeholder="<?php esc_attr_e('Código de cupón', 'woocommerce'); ?>" id="coupon_code" value="" />
                        <button type="submit" class="btn btn-primary" name="apply_coupon"><?php esc_html_e('Aplicar cupón', 'woocommerce'); ?></button>
                    </div>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-secondary align-self-end" name="update_cart"><?php esc_html_e('Actualizar carrito', 'woocommerce'); ?></button>

            <?php do_action('woocommerce_cart_actions'); ?>
        </div>

        <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
    </form>

    <div class="cart-collaterals mt-5">
        <?php do_action('woocommerce_cart_collaterals'); ?>
    </div>
</div>

<?php do_action('woocommerce_after_cart'); ?>
