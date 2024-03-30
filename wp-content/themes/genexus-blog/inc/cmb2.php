<?php
// Add custom meta box to category admin
function cmb2_meta_boxes() {
    /*******************************
     CATEGORIES
     *******************************/
    $prefix = 'gx_category_';
    $cmb_category = new_cmb2_box( array(
        'id'           => $prefix,
        'title'        => __( 'Custom Category Meta Box', 'cmb2' ),
        'object_types' => array( 'term' ), 
        'taxonomies'   => array( 'category' ), 
    ) );
    $cmb_category->add_field( array(
        'name' => __( 'CMB2 Custom Fields', 'cmb2' ),
        'id'   => $prefix . 'title',
        'type' => 'title',
    ) );
    //Color
    $cmb_category->add_field( array(
        'name' => __( 'Category Color', 'cmb2' ),
        'id'   => $prefix . 'color',
        'type' => 'colorpicker',
    ) );
    //Background Color
    $cmb_category->add_field( array(
        'name' => __( 'Category Background Color', 'cmb2' ),
        'id'   => $prefix . 'bg_color',
        'type' => 'colorpicker',
    ) );
    //Header Image
    $cmb_category->add_field( array(
        'name' => __( 'Category Header Image', 'cmb2' ),
        'id'   => $prefix . 'header_image',
        'type' => 'file',
    ) );
    //Icon
    $cmb_category->add_field( array(
        'name' => __( 'Category Icon', 'cmb2' ),
        'id'   => $prefix . 'icon',
        'type' => 'file',
    ) );
    //Icon Mobile
    $cmb_category->add_field( array(
        'name' => __( 'Category Icon Mobile', 'cmb2' ),
        'id'   => $prefix . 'icon_mobile',
        'type' => 'file',
    ) );


    /*******************************
    AUTHOR
    *******************************/
    $prefix = 'gx_author_';
    $cmb_author = new_cmb2_box( array(
        'id'           => $prefix,
        'title'        => __( 'Custom author Meta Box', 'cmb2' ),
        'object_types' => array( 'author' ),   'context'      => 'normal',
        'priority'     => 'high',
    ) );
    $cmb_author->add_field( array(
        'name' => __( 'CMB2 Custom Fields', 'cmb2' ),
        'id'   => $prefix . 'title',
        'type' => 'title',
    ) );
    //Position
    $cmb_author->add_field( array(
        'name' => __( 'Position', 'cmb2' ),
        'id'   => $prefix . 'position',
        'type' => 'text',
    ) );
    //Favorite Quote (English)
    $cmb_author->add_field( array(
        'name' => __( '🇺🇸 Favorite Quote', 'cmb2' ),
        'id'   => $prefix . 'favorite_quote_en',
        'type' => 'textarea_small',
    ) );
    //Favorite Quote (Spanish)
    $cmb_author->add_field( array(
        'name' => __( '🇪🇸 Cita Favorita', 'cmb2' ),
        'id'   => $prefix . 'favorite_quote_es',
        'type' => 'textarea_small',
    ) );
    //Favorite Quote (Portuguese)
    $cmb_author->add_field( array(
        'name' => __( '🇧🇷 Citação Favorita', 'cmb2' ),
        'id'   => $prefix . 'favorite_quote_pt',
        'type' => 'textarea_small',
    ) );

    /*******************************
    POST > MAIN
    *******************************/
    $prefix = 'gx_post_main_';
    $cmb_post_main = new_cmb2_box( array(
        'id'           => $prefix,
        'title'        => __( 'CMB2 Custom Fields', 'cmb2' ),
        'object_types' => array( 'post' ),
        'context' => 'normal',
        'priority' => 'high',
    ) );
    //Legacy URL
    $cmb_post_main->add_field( array(
        'name' => __( 'Legacy URL', 'cmb2' ),
        'id'   => $prefix . 'legacy_url',
        'type' => 'text_url',
        'desc' => 'The legacy slug from this post.'
    ) );

    /*******************************
    POST > ASIDE
    *******************************/
    $prefix = 'gx_post_aside_';
    $cmb_post_aside = new_cmb2_box( array(
        'id'           => $prefix,
        'title'        => __( 'CMB2 Custom Fields', 'cmb2' ),
        'object_types' => array( 'post' ),
        'context' => 'side',
        'priority' => 'default',
    ) );
    //Make Super Sticky
    $cmb_post_aside->add_field( array(
        'name' => __( 'Super Sticky', 'cmb2' ),
        'id'   => $prefix . 'super_sticky',
        'type' => 'checkbox',
        'desc' => 'It will make this post be the first sticky, which takes the most prominence.'
    ) );
    //Hide Featured Image
    $cmb_post_aside->add_field( array(
        'name' => __( 'Hide Featured Image', 'cmb2' ),
        'id'   => $prefix . 'hide_featured_image',
        'type' => 'checkbox',
        'desc' => 'It will hide the featured image on the home grid.'
    ) );
}
add_action( 'cmb2_admin_init', 'cmb2_meta_boxes' );
?>