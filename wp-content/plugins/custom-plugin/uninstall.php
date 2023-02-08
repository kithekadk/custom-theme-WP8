<?php

/**
 * Trigger this file on Plugin uninstallation
 * 
 * @package CustomPlugin
 */

 //security check

 if (! defined('WP_UNISTALL_PLUGIN')){
    die;
 }

 //delete from DB
 $books = get_posts(array('post_type'=>'book', 'posts_per_page'=> -1));
//loop
foreach ($books as $book){
    wp_delete_posts($book->ID, true);
}

//method 2
global $wpdb;
$wpdb->query("DELETE FROM ct_posts WHERE post_type='books'");
$wpdb->query("DELETE FROM ct_postmeta WHERE post_id NOT IN (SELECT ID from ct_posts)");
$wpdb->query("DELETE FROM ct_term_relationships WHERE object_id NOT IN (SELECT ID FROM ct_posts)");