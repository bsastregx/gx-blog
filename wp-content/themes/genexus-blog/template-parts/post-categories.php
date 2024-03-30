<?php
    $categories = $args[0];
?>
<div class="categories-tags-container">
    <?php
    foreach ($categories as $cat_id) {
        $cat_name = get_cat_name($cat_id);
        $cat_english_id = apply_filters( 'wpml_object_id', $cat_id, 'category', FALSE, 'en');
        $cat_color = get_term_meta( $cat_english_id, 'gx_category_color', true );
        $cat_bg_color = get_term_meta( $cat_english_id, 'gx_category_bg_color', true );
        $cat_link = get_category_link($cat_id);

        if($cat_color == null or $cat_bg_color == null) {
            $cat_color = '#888484';
            $cat_bg_color = '#f8f8f8';  
        }
    ?>

    <a href="<?php echo $cat_link?>" class="category-tag"
        style="background-color: <?php echo $cat_bg_color; ?>; color: <?php echo $cat_color; ?>">
        <?php echo $cat_name; ?>
    </a>

    <?php }
    ?>

</div>