<?php

function custom_scripts_enqueue(){

    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', array(), 1, 'all');
    wp_enqueue_style('bootstrap');

    wp_enqueue_style('customstyle',  get_template_directory_uri().'/css/custom.css', array(), '1.0.0', 'all'); //hooks


    wp_register_script('bootstrapjs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', array(), '1', true);
    wp_enqueue_script('bootstrapjs');
    wp_enqueue_script('customjs', get_template_directory_uri().'/js/custom.js', array(), '1.0.0', true); //hooks
}

add_action('wp_enqueue_scripts', 'custom_scripts_enqueue');

// Activating menu in admin dashboard

function custom_theme_setup(){
    add_theme_support('menus');

    register_nav_menu('primary', 'Navigation Bar');
    register_nav_menu('secondary', 'Footer');
}


if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
    // File does not exist... return an error.
    return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
    // File exists... require it.
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}


add_action('init','custom_theme_setup');

add_theme_support('custom-background');

add_theme_support('custom-header');

add_theme_support('post-thumbnails');

add_theme_support('post-formats', array('aside', 'image', 'video'));

// sidebar function
function custom_widgets_setup(){
    register_sidebar(array(
        'name'=> 'Sidebar',
        'id'=> 'sidebar-1',
        'class'=> 'custom',
        'description'=> 'Standard Sidebar',
        'before_widget'  => '<li id="%1$s" class="widget %2$s">',
		'after_widget'   => "</li>\n",
		'before_title'   => '<h2 class="widgettitle">',
		'after_title'    => "</h2>\n"
    ));
}

add_action('widgets_init','custom_widgets_setup');



/*
 =========================================
    Custom Post Type
 =========================================

*/

function custom_post_type(){
    $labels = array(
        'name'=>'Portfolio',
        'singular_name'=>'Portfolio',
        'add_new'=>'Add Item',
        'all_item'=>'All Items',
        'edit_item'=>'Edit Item',
        'view_item'=>'View Item',
        'search_item'=>'Search Portfolio',
        'not_found'=>'No Portfolio found',
        'not_found_in_trash'=>'No items found in trash',
        'parent_item_colon'=>'Parent Item'
    );

    $args = array(
        'labels'=>$labels,
        'public'=>true,
        'has_archive'=>true,
        'public_queryable'=>true,
        'query_var'=>true,
        'rewrite'=>true,
        'capability_type'=>'post',
        'hierarchical'=>false,
        'supports'=>array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revisions'
        ),
        // 'taxonomies'=>array('category', 'post_tag'),
        'menu_position'=>5,
        'exclude_from_search'=>false
    );

    register_post_type('portfolio', $args);
}

add_action('init','custom_post_type');

/*
 =========================================
    Custom Taxonomy
 =========================================

*/

function custom_taxonomy(){
    $labels= array(
        'name'=>'Profession',
        'singular_name'=>'Profession',
        'search_items'=>'Search Profession',
        'all_items'=>'All Professions',
        'parent_item'=>'Parent Profession',
        'parent_item_colon'=>'Parent Profession:',
        'edit_item'=> 'Edit Profession',
        'update_item'=>'Update Profession',
        'add_new_item'=>'Add New Profession',
        'new_item_name'=> 'New Profession Name',
        'menu_name'=>'Professions'
    );
    $args = array(
        'labels'=>$labels,
        'hierarchical'=>true,
        'show_ui'=>true,
        'show_admin_column'=>true,
        'query_var'=>true,
        'rewrite'=>array('slug'=>'profession')
    );

    register_taxonomy('profession', array('portfolio'), $args);
    
    // add new taxonomy NOT hierarchical

    register_taxonomy('tools', 'portfolio', array(
        'label'=>'Tools',
        'rewrite'=>array('slug'=>'tool'),
        'hierarchical'=>false
    ));
}

add_action('init', 'custom_taxonomy');

/*
 =========================================
    Custom Term Function
 =========================================

*/

function custom_get_terms($postID, $term){
    $terms_list = wp_get_post_terms($postID, $term);

    $i = 0;
    $output='';
    foreach($terms_list as $term){
        $i++;
        if($i >1){
            $output .= ', ';
        }
        $output .= '<a href="'.get_term_link($term).'">'.$term->name.' </a>';

    }

    return $output;

}

add_shortcode('cohort8', function($atts){
    // echo 'This is cohort 8 shot code' ; 
    // echo '<br/>';

    $attributes = shortcode_atts([
        'team_members'=>'Christine, Cripin, Jonah, Kennedy, Wilson',
        'number_of_trainees'=>'5'
    ], $atts);

    return 'Team Members ='.$attributes['team_members']. ' and Number Of Trainees =' .$attributes['number_of_trainees'];

});