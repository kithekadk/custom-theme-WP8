<?php
get_header();
?>
<div class="row">
    <?php 
    if (have_posts()):
        while (have_posts()):the_post();?>
        <p><?php the_title(sprintf('<h3 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h3>'); ?></p>
        <?php if (has_post_thumbnail()):?>
            <div><?php the_post_thumbnail('thumbnail') ?></div>
        <?php endif ?>
        <p><?php the_content();?></p>
        
        <p style="background-color:yellow;"><?php //$terms_list = wp_get_post_terms($post->ID, 'profession') ?></p>
        <?php 
        // $i=0;
        // foreach($terms_list as $term){
        //     $i++;
        //     if($i>1){
        //         echo ', ';
        //     }
        //     echo $term->name.' ';
        // }

        ?>
        <!-- || -->
        <p style="background-color:yellow;"><?php //$terms_list = wp_get_post_terms($post->ID, 'tools') ?></p>
        <?php 
        // $i=0;
        // foreach($terms_list as $term){
        //     $i++;
        //     if($i>1){
        //         echo ', ';
        //     }
        //     echo $term->name.' ';
        // }

        ?>

        <p>Profession: </p>
        <b><?php echo custom_get_terms($post->ID, 'profession'); ?> 
        <?php if(current_user_can('manage_options')){
            echo ' || '; edit_post_link();
        } ?>
        </b>
        <p>Tools: </p><b><?php echo custom_get_terms($post->ID, 'tools'); ?></b>

    <?php
        endwhile;
    endif;
    ?> 
    <div>
        <?php previous_post_link(); ?>
        <?php next_post_link() ?>
    </div>
</div>

<?php get_footer(); ?>