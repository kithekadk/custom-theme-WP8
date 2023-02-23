<div class="wrap">
    <h1>This is Admin Template 8</h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php 
            settings_fields('cohort_8_group');
            do_settings_sections('cohort_8');
            submit_button();
        ?>
    </form>
    
</div>