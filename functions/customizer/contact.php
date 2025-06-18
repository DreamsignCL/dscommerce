<?php
function dscommerce_customize_contacts($wp_customize) {
    // Sección
    $wp_customize->add_section('ds_contact_section', [
        'title' => 'Contactos',
        'priority' => 40,
    ]);

    // Subtítulo
    $wp_customize->add_setting('ds_contact_subtitle1', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ds_contact_subtitle1', [
        'label' => '',
        'section' => 'ds_contact_section',
        'type' => 'hidden',
        'description' => '<h3 style="font-weight: bold;">Teléfonos</h3>',
    ]);

    // Función para eliminar todo lo que no sea número, espacio, paréntesis, guion o +
    function sanitize_phone_number_custom($phone) {
        return preg_replace('/[^0-9\+\-\(\)\s]/', '', sanitize_text_field($phone));
    }

    // Lista de telefonos
    $phones = [
        'phone1' => 'teléfono #1',
        'phone2' => 'teléfono #2',
        'phone3' => 'teléfono #3',
    ];

    foreach ($phones as $slug => $label) {
        $wp_customize->add_setting("ds_contact_$slug", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_phone_number_custom',
            'type'              => 'theme_mod',
        ]);

        // Control (input del admin)
        $wp_customize->add_control("ds_contact_{$slug}_control", [
            'label'    => "Número de $label",
            'section'  => 'ds_contact_section',
            'settings' => "ds_contact_$slug",
            'type'     => 'text',
        ]);
    }

    // Subtítulo
    $wp_customize->add_setting('ds_contact_subtitle2', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ds_contact_subtitle2', [
        'label' => '',
        'section' => 'ds_contact_section',
        'type' => 'hidden',
        'description' => '<h3 style="font-weight: bold;">Emails</h3>',
    ]);

    // Lista de telefonos
    $emails = [
        'email1' => 'Email #1',
        'email2' => 'Email #2',
        'email3' => 'Email #3',
    ];

    foreach ($emails as $slug => $label) {
        $wp_customize->add_setting("ds_contact_$slug", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_email',
            'type'              => 'theme_mod',
        ]);

        // Control (input del admin)
        $wp_customize->add_control("ds_contact_{$slug}_control", [
            'label'    => $label,
            'section'  => 'ds_contact_section',
            'settings' => "ds_contact_$slug",
            'type'     => 'email',
        ]);
    }

    // Subtítulo
    $wp_customize->add_setting('ds_contact_subtitle3', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ds_contact_subtitle3', [
        'label' => '',
        'section' => 'ds_contact_section',
        'type' => 'hidden',
        'description' => '<h3 style="font-weight: bold;">Ubicación</h3>',
    ]);

    $wp_customize->add_setting('ds_contact_map', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field', // Sanitizar el texto del área
    ]);
    $wp_customize->add_control('ds_contact_map_control', [
        'label' => 'URL Google Maps',
        'section' => 'ds_contact_section',
        'type' => 'url', // Área de texto para que el usuario ingrese comentarios
        'settings' => 'ds_contact_map',
    ]);

    $wp_customize->add_setting('ds_contact_address', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field', // Sanitizar el texto del área
    ]);
    $wp_customize->add_control('ds_contact_address_control', [
        'label' => 'Dirección',
        'section' => 'ds_contact_section',
        'type' => 'textarea', // Área de texto para que el usuario ingrese comentarios
        'settings' => 'ds_contact_address',
    ]);

    $wp_customize->add_setting('ds_contact_schedule', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field', // Sanitizar el texto del área
    ]);
    $wp_customize->add_control('ds_contact_schedule_control', [
        'label' => 'Horario',
        'section' => 'ds_contact_section',
        'type' => 'textarea', // Área de texto para que el usuario ingrese comentarios
        'settings' => 'ds_contact_schedule',
    ]);

    // Subtítulo
    $wp_customize->add_setting('ds_contact_subtitle4', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ds_contact_subtitle4', [
        'label' => '',
        'section' => 'ds_contact_section',
        'type' => 'hidden',
        'description' => '<h3 style="font-weight: bold;">Redes sociales</h3>',
    ]);

    // Lista de redes
    $redes = [
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'twitter'   => 'Twitter',
        'whatsapp'  => 'WhatsApp',
        'youtube'   => 'YouTube',
        'linkedin'  => 'LinkedIn',
        'pinterest' => 'Pinterest',
        'tiktok'    => 'TikTok'
    ];

    foreach ($redes as $slug => $label) {
        // Setting (dónde se guarda el dato)
        $wp_customize->add_setting("ds_contact_$slug", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'type'              => 'theme_mod',
        ]);

        // Control (input del admin)
        $wp_customize->add_control("ds_contact_{$slug}_control", [
            'label'    => "URL de $label",
            'section'  => 'ds_contact_section',
            'settings' => "ds_contact_$slug",
            'type'     => 'url',
        ]);
    }
}
add_action('customize_register', 'dscommerce_customize_contacts');