<?php
function dscommerce_general($wp_customize) {
    // Sección
    $wp_customize->add_section('ds_general_section', [
        'title' => 'Aspectos generales',
        'priority' => 20,
    ]);

    // Subtítulo
    $wp_customize->add_setting('ds_general_subtitle1', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ds_general_subtitle1', [
        'label' => '',
        'section' => 'ds_general_section',
        'type' => 'hidden',
        'description' => '<h3 style="font-weight: bold;">Fuente del sitio</h3>',
    ]);

    // Fuente (Selector de Google Fonts)
    $wp_customize->add_setting('ds_general_font', [
        'default' => 'Roboto', // Fuente predeterminada
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ds_general_font_control', [
        'label' => 'Selecciona la fuente',
        'section' => 'ds_general_section',
        'settings' => 'ds_general_font',
        'type' => 'select',
        'choices' => [
            'Roboto' => 'Roboto',
            'Open+Sans' => 'Open Sans',
            'Lato' => 'Lato',
            'Montserrat' => 'Montserrat',
            'Arial' => 'Arial',
            'Georgia' => 'Georgia',
        ],
    ]);

    // Subtítulo
    $wp_customize->add_setting('ds_general_subtitle2', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ds_general_subtitle2', [
        'label' => '',
        'section' => 'ds_general_section',
        'type' => 'hidden',
        'description' => '<h3 style="font-weight: bold;">Colores</h3>',
    ]);

    // Campo de selección de color (para el fondo del slider, por ejemplo)
    // Lista de colores a definir
    $colors = [
        'background_color_site' => 'Background',
        'title_color_site'      => 'Títulos',
        'subtitle_color_site'   => 'Subtitulos',
        'text_color_site'       => 'Textos',
    ];

    foreach ($colors as $slug => $label) {
        $wp_customize->add_setting("ds_general_color_$slug", [
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "ds_general_color_{$slug}_control", [
            'label'    => $label,
            'section'  => 'ds_general_section',
            'settings' => "ds_general_color_$slug",
        ]));
    }
}
add_action('customize_register', 'dscommerce_general');
