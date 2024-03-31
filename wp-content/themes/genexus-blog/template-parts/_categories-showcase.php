<?php
$category = $args[0];
$category_color = get_field( 'category_color', $category->taxonomy . '_' . $category->term_id);
$category_bgcolor = get_field( 'category_background_color', $category->taxonomy . '_' . $category->term_id);
$category_icon_url = get_field( 'category_icon', $category->taxonomy . '_' . $category->term_id);

if($category_color == null) {
    $$category_color = "#D8D8D8";
}
?>
<div class="carousel-cell">
    <div class="categories-showcase__cat">
        <a href="<?php echo esc_url(get_category_link( $category->term_id )); ?>" class="categories-showcase__link"
            style="color:<?php echo $category_color;?>">
            <div class="categories-showcase__image-container"
                style="background-color: <?php echo $category_bgcolor;?>;">
                <img src="<?php echo esc_url($category_icon_url); ?>" class="categories-showcase__image">
            </div>
            <span class="categories-showcase__name"><?php echo esc_html( $category->name ) ?></span>
        </a>
    </div>
</div>