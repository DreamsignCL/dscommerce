<?php get_header(); ?>

<main role="main">
    <div class="container">
        <div class="page-layout">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', 'page'); ?>
            <?php endwhile; else : ?>
                <p class="text-muted">No se encontró el contenido solicitado.</p>
                <hr aria-hidden="true">
                <a href="javascript:history.back()" class="btn btn--outline-secondary">← Volver</a>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
