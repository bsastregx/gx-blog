<?php

$category = $args[0];
$cat_id = $category->cat_ID;
$cat_color = get_term_meta( $cat_id, 'gx_category_color', true );

if($cat_color == null) {
    $cat_color = "#D8D8D8";
}
?>
<li class="ul-categories__category">
    <a class="ul-categories__link" href="<?php echo get_category_link( $category->term_id ); ?>">
        <span class="ul-categories__circle" style="background-color:<?php echo $cat_color; ?>"></span>
        <span class="ul-categories__text"><?php echo $category->name ?></span>
    </a>
</li>

