<article id="page-<?php the_ID(); ?>">
    <div class="page-layout__header">
        <h1 class="mb-1"><?php the_title(); ?></h1>
    </div>

    <div class="page-layout__body">
        <?php the_content(); ?>
    </div>

    <div class="page-layout__footer">
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links"><span>Páginas:</span>',
            'after'  => '</div>',
        ));
        ?>
    </div>
</article>
