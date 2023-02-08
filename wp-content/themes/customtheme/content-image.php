<h3>This is an Image post</h3>
<h2><?php the_title(sprintf('<h3 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h3>'); ?></h2>
<div class="thumbnail-img"><?php the_post_thumbnail('thumbnail') ?></div>
<?php the_content(); ?>
<hr>