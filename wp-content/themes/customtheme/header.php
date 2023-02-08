<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Custom Theme</title>
        <?php wp_head(); ?>
    <head>
        <?php
            if(is_front_page()){
                $custom_classes=array('custom-class','main-class', 'my-class');
            }else{
                $custom_classes=array('no-custom-class');
            }
        ?>
    <body <?php body_class($custom_classes); ?>>
        <?php 
        // wp_nav_menu(array(
        //     'theme_location'=>'primary',
        //     'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
        //     'container'       => 'div',
        //     'container_class' => 'collapse navbar-collapse',
        //     'container_id'    => 'bs-example-navbar-collapse-1',
        //     'menu_class'      => 'navbar-nav mr-auto',
        //     'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
        //     'walker'          => new WP_Bootstrap_Navwalker(),
        //     )); ?>

<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">C-Theme</a>
        <?php
        wp_nav_menu( array(
            'theme_location'    => 'primary',
            'depth'             => 1,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
        ) );
        ?>
    </div>
</nav>
        <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt=""/><br>