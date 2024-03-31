<?php
$cat = $args[0];
$cat_english_id = apply_filters( 'wpml_object_id', $cat->term_id, 'category', FALSE, 'en');
$cat_id = $cat_english_id;
$cat_color = get_term_meta( $cat_english_id, 'gx_category_color', true );

if($cat_english_id == null) {
    $cat_color = "#D8D8D8";
}
?>
<li class="ul-categories__category">
    <a class="ul-categories__link" href="<?php echo get_category_link( $cat->term_id ); ?>">
        <span class="ul-categories__circle" style="background-color:<?php echo $cat_color; ?>"></span>
        <span class="ul-categories__text"><?php echo $cat->name ?></span>
    </a>
</li>

