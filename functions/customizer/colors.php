<?php

function dscommerce_customize_colors($wp_customize) {
    // Nueva sección de colores
    $wp_customize->add_section('ds_colors_section', [
        'title'    => 'Variantes de colores',
        'priority' => 30,
    ]);

    // Lista de colores a definir
    $colors = [
        'primary'         => 'Primary',
        'primary_hover'   => 'Primary hover',
        'secondary'       => 'Secondary',
        'secondary_hover' => 'Secondary hover',
        'success'         => 'Success',
        'success_hover'   => 'Success hover',
        'danger'          => 'Danger',
        'danger_hover'    => 'Danger hover',
        'warning'         => 'Warning',
        'warning_hover'   => 'Warning hover',
        'info'            => 'Info',
        'info_hover'      => 'Info hover',
    ];

    foreach ($colors as $slug => $label) {
        $wp_customize->add_setting("ds_color_$slug", [
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "ds_color_{$slug}_control", [
            'label'    => $label,
            'section'  => 'ds_colors_section',
            'settings' => "ds_color_$slug",
        ]));
    }
}
add_action('customize_register', 'dscommerce_customize_colors');
