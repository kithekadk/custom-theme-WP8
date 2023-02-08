<?php get_header() ?>

<?php 
    if (have_posts()):
        while (have_posts()):the_post();?>
        <p><?php the_title(sprintf('<h3 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h3>'); ?></p>
        <?php if (has_post_thumbnail()):?>
            <div><?php the_post_thumbnail('thumbnail') ?></div>
        <?php endif ?>
        <p><?php the_content();?></p>
        <p><?php the_category();?></p>

    <?php
        endwhile;
    endif;
?>

<?php get_footer() ?>