<?php
// Agregar metabox solo a la página de inicio
function dscommerce_slider_home_metabox() {
    add_meta_box(
        'slider_images_box',
        'Imágenes del Slider',
        'dscommerce_slider_home_images_callback',
        'page', // solo para páginas
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'dscommerce_slider_home_metabox');

// Renderizar campos
function dscommerce_slider_home_images_callback($post) {
    // Verifica si esta página es la de inicio
    $is_front = get_option('page_on_front') == $post->ID;
    if (!$is_front) {
        echo 'Este bloque solo está disponible para la Página de Inicio.';
        return;
    }

    wp_nonce_field('slider_images_nonce_action', 'slider_images_nonce_name');

    for ($i = 1; $i <= 5; $i++) {
        $image = get_post_meta($post->ID, 'slider_image_' . $i, true);
        echo '<div style="margin-bottom: 20px;">';
        echo '<label>Imagen ' . $i . ': </label><br>';
        echo '<input type="text" name="slider_image_' . $i . '" value="' . esc_attr($image) . '" style="width:70%;" />';
        echo '<input type="button" class="upload_image_button button" value="Subir Imagen" />';
        if ($image) {
            echo '<br><img src="' . esc_url($image) . '" style="max-width:200px; margin-top:10px;" />';
        }
        echo '</div>';
    }
}

// Guardar campos
function dscommerce_slider_home_save_metabox($post_id) {
    if (!isset($_POST['slider_images_nonce_name']) ||
        !wp_verify_nonce($_POST['slider_images_nonce_name'], 'slider_images_nonce_action')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    for ($i = 1; $i <= 3; $i++) {
        if (isset($_POST['slider_image_' . $i])) {
            update_post_meta($post_id, 'slider_image_' . $i, esc_url_raw($_POST['slider_image_' . $i]));
        }
    }
}
add_action('save_post', 'dscommerce_slider_home_save_metabox');