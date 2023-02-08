<?php get_header(); ?>

<?php
// $arguments= array(
//     'type'=>'post',
//     'posts_per_page'=>2,
//     'offset'=>1
// );
// $lastblog= new WP_Query($arguments);
// $lastblog = new WP_Query('type=post&posts_per_page=-1&cat=11');
?>

<?php if(have_posts()):
    while (have_posts()): the_post(); ?>
    <?php get_template_part('content', get_post_format()); ?> 
<?php
endwhile;
endif;
wp_reset_postdata();
?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>