<?php get_header(); ?>

<?php if(have_posts()):
    while (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <small><?php the_time('F j, Y'); ?></small>
    <?php the_content(); ?>
<?php
endwhile;
endif;
?>

<?php get_footer(); ?>