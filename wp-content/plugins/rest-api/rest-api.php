<?php
/**
 *  @package Rest API
 */

/**
 * Plugin Name: Custom Endpoint WP8
 * Plugin URI: http://............
 * Description: This is a plugin to fetch all portfolios
 * Version: 1.0.0
 * Author: Cohort 8
 * Author URI: http://........
 * Licence: GPLv2 or later
 * Text Domain: rest-api-plugin
 */

if (!defined('ABSPATH')){
    die;
}

class My_REST_Posts_Controller {

    // Here initialize our namespace and resource name.
    public function __construct() {
        $this->namespace     = '/my-portfolios/v1';
        $this->resource_name = 'portfolios';
    }

    // Register our routes.
    public function register_routes() {
        register_rest_route( $this->namespace, '/' . $this->resource_name, array(
            // Here we register the readable endpoint for collections.
            array(
                'methods'   => 'GET',
                'callback'  => array( $this, 'get_c8_portfolios' ),
                'permission_callback' => array( $this, 'get_items_permissions_check' ),
            ),
            // Register our schema callback.
            'schema' => array( $this, 'custom_get_post_schema' ),
        ) );
    }

    /**
     * Check permissions for the posts.
     *
     * @param WP_REST_Request $request Current request.
     */
    public function get_items_permissions_check( $request ) {
        if(is_user_logged_in()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Grabs the five most recent posts and outputs them as a rest response.
     *
     * @param WP_REST_Request $request Current request.
     */
    public function get_c8_portfolios( $request ) {
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

    if (empty($portfolios)){
        return new WP_Error(
            'no_data_found',
            'No data found',
            [
                'status'=> 404
            ]
        );
    }

    foreach($portfolios as $portfolio){
        $response = custom_rest_prepare_post($portfolio, $request);
        $data[] = custom_prepare_for_collection($response);
    }

    return rest_ensure_response($data);
    }

function custom_get_post_schema(){
        $schema = [
            'schema'=>'',
            'title'=>'all-portfolios',
            'type'=> 'object',
    
            'properties'=>[
                'id'=>[
                    'description'=> esc_html__('Unique identifier for the object', 'my-textdomain'),
                    'type'=>'integer'
                ],
                'author'=>[
                    'description'=> esc_html__('The ID of the user object', 'my-textdomain'),
                    'type'=>'integer'
                ],
                'title'=>[
                    'description'=>esc_html__('The title of the object', 'my-textdomain'),
                    'type'=>'string'
                ],
                'content'=>[
                    'description'=>esc_html__('The content of the object', 'my-textdomain'),
                    'type'=>'string'
                ],
                'creation_date'=>[
                    'description'=>esc_html__('The date of creation of the object', 'my-textdomain'),
                    'type'=>'string'
                ]
            ]
    
        ];
    
        return $schema;
    }   



function custom_rest_prepare_post($post, $request){
        $post_data = [];
        $schema = custom_get_post_schema();
    
        if(isset($schema['properties']['id'])){
            $post_data['id'] = (int) $post->ID;
        }
    
        if(isset($schema['properties']['author'])){
            $post_data['author'] = (int) $post->post_author;
        }
    
        if(isset($schema['properties']['title'])){
            $post_data['title'] = apply_filters('post_heading', $post->post_title, $post);
        }
    
        if(isset($schema['properties']['content'])){
            $post_data['content'] = apply_filters('post_text', $post->post_content, $post);
        }
    
        if(isset($schema['properties']['creation_date'])){
            $post_data['creation_date']= apply_filters('post_date', $post->post_date, $post);
        }
    
        return rest_ensure_response($post_data);
    }


    public function custom_prepare_for_collection( $response ) {
        if (!($response instanceof WP_REST_Response)){
            return $response;
        }
    
        $data = (array) $response->get_data();
        $links = rest_get_server()::get_compact_response_links($response);
    
        if(!empty($links)){
            $data['_links']= $links;
        }
    
        return $data;
    }
}




// Function to register our new routes from the controller.
function prefix_register_my_rest_routes() {
    $controller = new My_REST_Posts_Controller();
    $controller->register_routes();
}

add_action( 'rest_api_init', 'prefix_register_my_rest_routes' );