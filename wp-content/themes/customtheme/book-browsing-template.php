<?php
/**
 * Template Name: View Books
 */

 get_header();?>

 <?php 
    global $wpdb;
    $table = $wpdb->prefix.'books';
    $books = $wpdb->get_results("SELECT * FROM $table");
 ?>
<p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Book Title</th>
            <th>Book Author</th>
            <th>Book Publisher</th>
        </tr>
    </thead>
    <?php
    foreach($books as $book){?>
        <tr>
            <td><?php echo $book->title;?></td>
            <td><?php echo $book->author;?></td>
            <td><?php echo $book->publisher;?></td>
        </tr>

   <?php }?>
</table>
</p>

 <?php get_footer(); ?>