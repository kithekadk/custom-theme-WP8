<?php get_header(); ?>

<div class="row">
    <?php
    
    if(have_posts()):
        while (have_posts()):the_post(); ?>
        <?php the_title(sprintf('<h3 class="entry-title"><a href="%s">', esc_url(get_permalink())),'</a></h3>'); ?>
        <article id="post-<?php the_ID() ?>" <?php post_class(); ?>>
        <?php if(has_post_thumbnail()): ?>
            <div class="pull-right"><?php the_post_thumbnail('thumbnail'); ?></div>
        <?php endif ?>
        <!-- <small>Tags: <?php the_tags(); ?> || <?php edit_post_link(); ?></small><br>
        <small>Category: <?php the_category(); ?> || <?php edit_post_link(); ?></small> -->
        <p><?php the_content();?></p>
        

        

        <?php 
            if(comments_open()){
                comments_template();
            }else{
                echo '<h5 class="text-center"> Sorry, Comments are closed </h5>';
            }
        ?>
         <hr>   
         <hr>   
        </article>
        <?php endwhile;?>
        <?php endif;?>
        <div class="row">
            <div><?php previous_post_link();?></div>
            <div><?php next_post_link();?></div>
        </div>
        <div>
            <?php get_sidebar(); ?>
        </div>
</div>
<?php get_footer(); ?>