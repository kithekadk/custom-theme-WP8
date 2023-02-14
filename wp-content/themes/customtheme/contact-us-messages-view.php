<?php
/**
 * Template Name: View Contact Us Messages
 */

 get_header()?>

<?php 
    global $wpdb;
    $table = $wpdb->prefix.'contactus';
    $messages = $wpdb->get_results("SELECT * FROM $table");
?>
<table class="table table-stripes">
    <thead>
        <tr>
            <th>User Name</th>
            <th>User Email</th>
            <th>Message</th>
        </tr>
    </thead>
    <?php foreach($messages as $message){?>
        <tr>
            <td><?php echo $message->name ?></td>
            <td><?php echo $message->email ?></td>
            <td><?php echo $message->message ?></td>
        </tr>
    <?php }?>
</table>

<?php get_footer()?>