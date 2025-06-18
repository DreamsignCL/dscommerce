<?php

function dscommerce_customize_footer($wp_customize) {
    // Nueva sección de colores
    $wp_customize->add_section('ds_footer_section', [
        'title'    => 'Pie de pagina',
        'priority' => 60,
    ]);

    // Subtítulo
    $wp_customize->add_setting('ds_footer_subtitle1', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ds_footer_subtitle1', [
        'label' => '',
        'section' => 'ds_footer_section',
        'type' => 'hidden',
        'description' => '<h3 style="font-weight: bold;">Logo</h3>',
    ]);

    $wp_customize->add_setting("ds_footer_logo", [
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "ds_footer_logo_control", [
        'label' => "Logo pie de página",
        'section' => 'ds_footer_section',
        'settings' => "ds_footer_logo",
    ]));


    // Subtítulo
    $wp_customize->add_setting('ds_footer_subtitle2', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ds_footer_subtitle2', [
        'label' => '',
        'section' => 'ds_footer_section',
        'type' => 'hidden',
        'description' => '<h3 style="font-weight: bold;">Colores</h3>',
    ]);

    // Lista de colores a definir
    $footer_colors = [
        'background'         => 'Color de fondo',
        'texts'   => 'Color de textos',
        'links'       => 'Color de enlaces',
        'links_hover' => 'Color de enlaces sobre',
    ];

    foreach ($footer_colors as $slug => $label) {
        $wp_customize->add_setting("ds_footer_color_$slug", [
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "ds_footer_color_{$slug}_control", [
            'label'    => $label,
            'section'  => 'ds_footer_section',
            'settings' => "ds_footer_color_$slug",
        ]));
    }

    // Subtítulo
    $wp_customize->add_setting('ds_footer_subtitle3', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ds_footer_subtitle3', [
        'label' => '',
        'section' => 'ds_footer_section',
        'type' => 'hidden',
        'description' => '<h3 style="font-weight: bold;">Método de pago</h3>',
    ]);

    $wp_customize->add_setting("ds_footer_payment", [
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "ds_footer_payment_control", [
        'label' => "Imagen método de pago",
        'section' => 'ds_footer_section',
        'settings' => "ds_footer_payment",
    ]));
}
add_action('customize_register', 'dscommerce_customize_footer');
