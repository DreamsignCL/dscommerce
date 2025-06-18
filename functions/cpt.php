<?php 

function dscommerce_clients_cpt() {
    register_post_type('cliente', [
        'labels' => [
            'name' => 'Clientes',
            'singular_name' => 'Cliente',
            'add_new_item' => 'Agregar nuevo cliente',
            'edit_item' => 'Editar cliente'
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-businessman',
        'supports' => ['title', 'thumbnail'],
        'show_in_rest' => false, // estás usando editor clásico
    ]);
}
add_action('init', 'dscommerce_clients_cpt');
