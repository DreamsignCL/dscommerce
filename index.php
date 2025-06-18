<?php get_header(); ?>

<main class="container my-5" role="main">
    <section class="text-center mb-4">
        <h2 class="h4">Bienvenido a <?php bloginfo('name'); ?></h2>
        <p class="lead">Este es el template base de tu tema <strong>dscommerce</strong>.</p>
    </section>

    <?php if (have_posts()) : ?>
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', 'post'); ?>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p class="text-muted">No hay contenido para mostrar.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
