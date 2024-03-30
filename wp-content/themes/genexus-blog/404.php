<?php get_header(); ?>
<div class="four04">
    <div class="four04-container">
        <img src="<?php echo get_template_directory_uri().'/assets/images/404.svg'?>" alt="404" class="four04-image">
        <p class="four04-text-primary">
            <?php echo $GLOBALS["gx_trans"]->four04_main_text;?>
        </p>
        <p class="four04-text-secondary">
            <?php echo $GLOBALS["gx_trans"]->four04_secondary_text;?>
        </p>
        <a class="button" href="<?php echo get_site_url(); ?>">
            <?php echo $GLOBALS["gx_trans"]->four04_button_text;?>
        </a>
    </div>
</div>
<?php get_footer() ?>