<?php get_header(); ?>

<main role="main">
    <div class="container">
        <div class="archive-layout">
            <aside class="archive-layout__sidebar">
                <h2>Categorías</h2>
                <ul class="archive-taxonomy">
                    <?php
                    $post_type = get_post_type();
                    $taxonomy = 'type_' . $post_type;

                    if (taxonomy_exists($taxonomy)) {
                        wp_list_categories(array(
                            'taxonomy' => $taxonomy,
                            'title_li' => '',
                            'show_count' => true,
                        ));
                    } else {
                        echo '<li>No hay categorías.</li>';
                    }
                    ?>
                </ul>
            </aside>

            <section class="archive-layout__content">
                <h1 class="archive-layout__title"><?php post_type_archive_title(); ?></h1>

                <?php if (have_posts()) : ?>
                    <div class="archive-layout__grid">
                        <?php 
                            while (have_posts()) : the_post();
                                $permalink = get_permalink();
                                $title = get_the_title();
                                $excerpt = get_the_excerpt();

                                echo'
                                    <article class="archive-item">
                                        <a class="archive-item__link" href="'.esc_url($permalink).'" aria-label="Leer más sobre '.esc_attr($title).'">';
                                            if (has_post_thumbnail()) : 
                                                echo '<div class="archive-item__thumb">'.get_the_post_thumbnail(null, 'medium').'</div>';
                                            endif;
                                        echo'
                                            <h2 class="archive-item__title">'.esc_html($title).'</h2>
                                            <div class="archive-item__excerpt">'.esc_html($excerpt).'</div>
                                        </a>
                                    </article>   
                                ';
                            endwhile; 
                        ?>
                    </div>

                    <div class="pagination">
                        <?php the_posts_pagination(array(
                            'prev_text' => '« Anterior',
                            'next_text' => 'Siguiente »',
                        )); ?>
                    </div>
                <?php else : ?>
                    <p>No se encontraron contenidos.</p>
                <?php endif; ?>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
