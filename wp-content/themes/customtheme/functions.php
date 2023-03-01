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

//ADDING NEW LOGIN URL

// function new_login_url($loginURL){
//     $loginURL = site_url('cohort8.php', 'login');
//     return $loginURL;
// }

// add_filter('login_url', 'new_login_url');\

//LIMITING LOGIN ATTEMPTS

function check_attempted_login($user, $username, $password){
    if(get_transient('attempted_login')){
        $datas = get_transient('attempted_login');

        if ($datas['tried'] >= 3){
            $until = get_option('_transient_timeout_' . 'attempted_login');
            $time = time_to_go($until);

            return new WP_Error('too_many_tried', sprintf(__('<strong>ERROR</strong>: You have reached authentication limit, please try after %1$s'), $time));
        }
    }

    return $user;
}

add_filter('authenticate', 'check_attempted_login', 30, 3);

function login_failed($username){
    if (get_transient('attempted_login')){
        $datas = get_transient('attempted_login');
        $datas['tried']++;

        if ($datas['tried'] <= 3)
            set_transient('attempted_login', $datas, 300);
        }else{
            $datas = array(
                'tried' => 1
            );
            set_transient ('attempted_login', $datas, 300);
        }
          
    
}

add_action('wp_login_failed', 'login_failed', 10, 1);

function time_to_go($timestamp){
    //converting mysql timestamp to php time
    $periods = array(
        "second",
        "minute",
        "hour",
        "day",
        "week",
        "month",
        "year"
    );

    $lengths = array(
        "60",
        "60",
        "24",
        "7",
        "4.35",
        "12"
    );

    $current_timestamp = time();
    $difference = abs($current_timestamp - $timestamp);

    for ($i = 0; $difference >= $lengths[$i] && $i < count($lengths)-1; $i ++ ){
        $difference /= $lengths[$i];
    }

    //adding the countdown if the remaining is less than a minute
    $difference = round($difference);

    if(isset($difference)){
        if($difference != 1){
            $periods[$i] .= "s";
            $output = "$difference $periods[$i]";
            return $output;
        }
    }
}

//CREATE CUSTOM FIELD REST API
function custom_rest_api(){
    register_rest_field('post', 'CustomFieldNew', ['get_callback'=> 'get_custom_field']);

    register_rest_route(
        'portfolioplugin/v1', 
        'c8-portfolios', 
        [
            'callback'=>'get_c8_portfolios',
            'method'=>'GET', 
            'permission_callback'=>'custom_endpoint_permission',
            'args'=>[
                'meta_key'=>[
                    'required'=>true,
                    'default'=>'_edit_lock',
                    'validate_callback'=>function($param, $request, $key){
                        return !is_numeric($param);
                    }
                ],
                'meta_value'=>[
                    'required'=>true,
                    'default'=>'1677654767:1',
                    // 'validate_callback'=>function($param, $request, $key){
                    //     return !is_numeric($param);
                    // }
                ]
            ]
        ]);
}

function custom_endpoint_permission(){
    if(is_user_logged_in()){
        return true;
    }else{
        return false;
    }
}

function get_c8_portfolios(WP_REST_Request $request){

    // echo '<pre>'; print_r($request); '</pre>';

    $meta_key = $request->get_param('meta_key');
    $meta_value = $request->get_param('meta_value');

    $args=[
        'post_type'=>'portfolio',
        'status'=>'publish',
        'posts_per_page'=>10,
        'meta_query'=>[[
            'key'=>$meta_key,
            'value'=>$meta_value
        ]]
    ];

    $the_query = new WP_Query($args);

    $portfolios = $the_query->posts;

    return $portfolios;

}

function get_custom_field($obj){

    $post_id = $obj['id'];

    // echo 'pre';print_r($post_id); '</pre>';

    return get_post_meta($post_id, 'CustomFieldNew', true);

}

add_action('rest_api_init', 'custom_rest_api');