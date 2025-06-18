<?php

function dscommerce_customize_header_colors($wp_customize) {
    // Nueva sección de colores
    $wp_customize->add_section('ds_header_colors_section', [
        'title'    => 'Cabecera',
        'priority' => 50,
    ]);

    // Lista de colores a definir
    $header_colors = [
        'background'         => 'Color de fondo',
        'texts'   => 'Color de textos',
        'links'       => 'Color de enlaces',
        'links_hover' => 'Color de enlaces sobre',
    ];

    foreach ($header_colors as $slug => $label) {
        $wp_customize->add_setting("ds_header_color_$slug", [
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "ds_header_color_{$slug}_control", [
            'label'    => $label,
            'section'  => 'ds_header_colors_section',
            'settings' => "ds_header_color_$slug",
        ]));
    }
}
add_action('customize_register', 'dscommerce_customize_header_colors');
