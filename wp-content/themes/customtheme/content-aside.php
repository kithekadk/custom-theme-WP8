
<h3>This is an aside post</h3>
<?php the_title(sprintf('<h3 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h3>'); ?>
<small><?php the_time(); ?></small>
<div class="thumbnail-img"><?php the_post_thumbnail('thumbnail') ?></div>
<?php the_content(); ?>
<?php  the_category(); ?>
<hr>