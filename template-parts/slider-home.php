<?php
/**
 * Template part for the homepage slider
 */
?>
<div class="slider slider--home">
    <div class="slider__slides">
        <?php
        for ($i = 1; $i <= 3; $i++) {
            $image = get_post_meta(get_the_ID(), 'slider_image_' . $i, true);
            if ($image) {
                echo '
                    <div class="slider__slide">
                        <img src="' . esc_url($image) . '" alt="Slide ' . $i . '">
                    </div>
                ';
            }
        }
        ?>
    </div>
    <button class="slider__button slider__button--prev-slide">&#10094;</button>
    <button class="slider__button slider__button--next-slide">&#10095;</button>
</div>