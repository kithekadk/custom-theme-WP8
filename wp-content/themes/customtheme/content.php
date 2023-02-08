<?php //get_header(); ?>

<?php the_title(sprintf('<h3 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h3>'); ?>
<small><?php the_time(); ?></small>
<div class="thumbnail-img"><?php the_post_thumbnail('thumbnail') ?></div>
<?php the_content(); ?>
<?php get_the_term_list($post->ID, 'profession','<li>', ', ', '</li>'); ?>
<hr>

<?php //get_footer(); ?>