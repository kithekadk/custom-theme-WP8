<?php
/**
 * Template Name: Book Registration
 */

 get_header();?>

 <div class="row justify-content-center">
    <form action="" method="post" style="width:40vw; box-shadow:3px 3px 3px 3px grey; padding:30px;">
        <div class="form-group">
            <input type="text" name="title" class="form-control input-sm mb-3" id="title" placeholder="Input Book Title" required>
        </div>
        <div class="form-group">
            <input type="text" name="author" class="form-control input-sm mb-3" id="author" placeholder="Input Book author" required>
        </div>
        <div class="form-group">
            <input type="text" name="publisher" class="form-control input-sm mb-3" id="publisher" placeholder="Input Book publisher" required>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="submit" value="Register" name="submitbtn" class="btn btn-primary btn-block">
            </div>
        </div>
    </form>
 </div>

 <?php get_footer(); ?>