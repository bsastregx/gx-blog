<?php
$cat = $args[0];
$cat_english_id = apply_filters( 'wpml_object_id', $cat->term_id, 'category', FALSE, 'en');
$cat_color = get_term_meta( $cat_english_id, 'gx_category_color', true );
$cat_bg_color = get_term_meta( $cat_english_id, 'gx_category_bg_color', true );
$cat_icon_url =  get_term_meta( $cat_english_id, 'gx_category_icon', true );

if($cat_color == null) {
    $cat_color = "#D8D8D8";
}
?>
<div class="carousel-cell">
    <div class="categories-showcase__cat">
        <a href="<?php echo esc_url(get_category_link( $cat->term_id )); ?>" class="categories-showcase__link"
            style="color:<?php echo $cat_color;?>">
            <div class="categories-showcase__image-container"
                style="background-color: <?php echo $cat_bg_color;?>;">
                <img src="<?php echo esc_url($cat_icon_url); ?>" class="categories-showcase__image">
            </div>
            <span class="categories-showcase__name"><?php echo esc_html( $cat->name ) ?></span>
        </a>
    </div>
</div>