<?php get_header(); ?>

<?php if(have_posts()):
    while (have_posts()): the_post(); ?>
    <h2><?php the_title(); ?></h2>
    <p><b><i><?php the_content(); ?></i></b></p>
    <hr>
    
<?php
endwhile;
endif;
?>



<?php get_footer(); ?>