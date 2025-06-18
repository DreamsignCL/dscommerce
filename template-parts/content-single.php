<article id="post-<?php the_ID(); ?>">
    <div class="row">
        <div class="column">
            <?php if (has_post_thumbnail()) : ?>
                <div class="single-layout__thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="column">
            <div class="single-layout__header">
                <h1 class="single-layout__title"><?php the_title(); ?></h1>

                <div class="single-layout__info">
                    <time class="single-layout__post-date" datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
                    <?php
                        // Mostrar términos de tipo_proyecto
                        $terms = get_the_terms(get_the_ID(), 'tipo_proyecto');
                        if ($terms && !is_wp_error($terms)) :
                            echo '<div class="single-layout__taxonomies">';
                            foreach ($terms as $term) {
                                echo '<a class="btn btn--outline-primary btn--sm" href="' . get_term_link($term) . '">' . esc_html($term->name) . '</a> ';
                            }
                            echo '</div>';
                        endif;
                    ?>
                </div>
            </div>
            <div class="single-layout__body">
                <?php the_content(); ?>
            </div>

            <hr aria-hidden="true">
            <a href="javascript:history.back()" class="btn btn--outline-secondary">← Volver</a>
        </div>
    </div>

    <div class="single-layout__footer">
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links"><span>Páginas:</span>',
            'after'  => '</div>',
        ));
        ?>
    </div>
</article>