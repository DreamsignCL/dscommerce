<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 mb-4'); ?>>
    <div class="card h-100">
        <div class="card-body">
            <h3 class="card-title h5">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                    <?php the_title(); ?>
                </a>
            </h3>
            <div class="card-text">
                <?php the_excerpt(); ?>
            </div>
        </div>
        <div class="card-footer text-muted small">
            Publicado el <?php echo get_the_date(); ?> por <?php the_author(); ?>
        </div>
    </div>
</article>
