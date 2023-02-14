<?php
/**
 * Template Name: Contact Us Input Form
 */

 get_header()?>

<div class="row justify-content-center">
    <form action="" method="post" style="width:40vw">
        <div class="form-group">
            <input type="text" name="name" id="name" placeholder="Input your full name" class="form-control input-sm mb-3" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Input your email" class="form-control input-sm mb-3" required>
        </div>
        <div class="form-group">
            <input type="text" name="message" id="message" placeholder="Say something ..." class="form-control input-sm mb-3" required>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <input type="submit" class="btn btn-success btn-block" name="submitmsg" value="Send">
            </div>
        </div>
    </form>
</div>


<?php get_footer() ?>