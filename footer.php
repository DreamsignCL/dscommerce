        <footer role="contentinfo">
            <div class="container">
                <div class="footer row">
                    <div class="column company-identity">
                        <a href="<?php bloginfo('url'); ?>" title="Ir a la página de  inicio">
                            <img src="<?php echo get_theme_mod('ds_footer_logo'); ?>" alt="<?php bloginfo('name'); ?> - Logo del sitio" />
                        </a>
                    </div>
                    <div class="column">
                        <h4>Información</h4>
                        <?php 

                        $address = get_theme_mod('ds_contact_adress');
                        $map_url = get_theme_mod('ds_contact_map');
                        $schedule = get_theme_mod('ds_contact_schedule');
                        $email1 = get_theme_mod('ds_contact_email1');
                        $email2 = get_theme_mod('ds_contact_email2');
                        $email3 = get_theme_mod('ds_contact_email3');
                        
                        if ($address): ?>
                            <a href="<?php echo esc_url($map_url); ?>" title="Abrir enlace de Google Maps">
                                <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                                <?php echo esc_html($address); ?>
                            </a>
                        <?php endif; ?>

                        
                        <?php if ($schedule): ?>
                            <p><?php echo esc_html($schedule); ?></p>
                        <?php endif; ?>

                        <hr>

                        <ul>
                            <?php if ($email1): ?>
                                <li><a href="mailto:<?php echo esc_attr($email1); ?>"><?php echo esc_html($email1); ?></a></li>
                            <?php endif; ?>
                            <?php if ($email2): ?>
                                <li><a href="mailto:<?php echo esc_attr($email2); ?>"><?php echo esc_html($email2); ?></a></li>
                            <?php endif; ?>
                            <?php if ($email3): ?>
                                <li><a href="mailto:<?php echo esc_attr($email3); ?>"><?php echo esc_html($email3); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="column">
                        <h4>Políticas</h4>
                        <?php if (has_nav_menu('footer-menu')) : ?>
                            <nav class="footer-nav" aria-label="<?php esc_attr_e('Menú del pie de página', 'dscommerce'); ?>">
                                <?php
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer-menu',
                                        'container'      => false,
                                        'depth'          => 1,
                                    ));
                                ?>
                            </nav>
                        <?php endif; ?>
                    </div>
                    <div class="column">
                        <h4>Contactos</h4>

                        <?php dscommerce_social_nav('bottom'); ?>

                        <img class="pay-methods-image" src="<?php echo get_theme_mod('ds_footer_payment'); ?>" alt="Métodos de pago asociados a transbank" />
                    </div>
                </div>
            </div>
        </footer>
        <div id="ds-signature"></div>

        <?php wp_footer(); ?>
    </body>
</html>
