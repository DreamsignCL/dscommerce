<?php
function dscommerce_url_clients_metabox() {
    add_meta_box(
        'cliente_info', 
        'Información del Cliente', 
        'dscommerce_url_clients_callback', 
        'cliente', 
        'normal', 
        'high'
    );
}
add_action('add_meta_boxes', 'dscommerce_url_clients_metabox');

function dscommerce_url_clients_callback($post) {
    $url = get_post_meta($post->ID, '_url_client', true);
    wp_nonce_field('client_nonce_action', 'client_nonce_name');
    echo '<label for="url_client">URL del cliente:</label><br>';
    echo '<input type="text" name="url_client" value="' . esc_attr($url) . '" style="width:100%;" />';
}

function cliente_save_meta_box($post_id) {
    if (!isset($_POST['client_nonce_name']) || !wp_verify_nonce($_POST['client_nonce_name'], 'client_nonce_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['url_client'])) {
        update_post_meta($post_id, '_url_client', esc_url_raw($_POST['url_client']));
    }
}
add_action('save_post', 'cliente_save_meta_box');
