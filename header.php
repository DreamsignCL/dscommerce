<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
    <div class="container">
        <div class="top-bar">
            <?php dscommerce_social_nav('top'); ?>
        </div>
        
        <div class="header">
            <div class="site-branding d-flex align-items-center">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php endif; ?>
            </div>
    
            <?php if (has_nav_menu('main-menu')) : ?>
                <nav id="main-nav" class="main-nav">
                    <div class="main-nav__header">
                        <button id="menu-close" class="btn btn--menu-close">
                            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                        </button>
                    </div>
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'container' => false,
                            'fallback_cb' => false,
                            'depth' => 2,
                            'menu_class' => 'main-nav__list',
                            'walker' => new dscommerce_walker_menu(),
                        ));
                    ?>
                </nav>
                <button id="menu-toggle" class="btn btn--menu-toggle">
                    <i class="fa-solid fa-bars" aria-hidden="true"></i>
                </button>
            <?php endif; ?>
        </div>
    </div>
</header>
