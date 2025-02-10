<?php
/* Template Name: All Posts */
$the_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'orderby' => 'date',    
));
?>

<html>

<head>
    <title>Title</title>
    <style type="text/css">
    body {
        background-color: #ccc;
        font-family: sans-serif;
    }

    h1 {
        font-size: 20px;
    }

    .button {
        padding: 4px 10px;
        background-color: #4141af;
        color: #fff;
        border-radius: 4px;
        text-decoration: none;
        display: block;
        width: 60px;
        margin-top: 10px;
        font-size: 12px;
    }

    .post {
        border: 3px solid black;
        border-radius: 3px;
        padding: 20px;
        margin-bottom: 30px;
        background-color: #fff;
    }

    .post.error {
        border-color: black;
        background-color: #f7eeee;
    }

    .post.success {
        border-color: green;
        background-color: #eef7ee;
    }

    .multiples-categorias,
    .no-meta-description {
        display: block;
        font-weight: bold;
        margin-top: 10px;
    }

    .multiples-categorias {
        display: inline-block;
    }

    .good {
        color: green;
        font-weight: bold;
        margin-top: 10px;
        margin-right: 5px;
        display: inline-block;
    }

    .categorias {
        font-style: italic;
    }
    </style>
</head>

<body>
    <h1>Estado de posts (categoría única y meta description)</h1>
    <?php echo do_shortcode( '[multilanguage_switcher]' ); ?>

    <?php
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        
        $multiple_categories = false;
        $categories_ids = wp_get_post_categories(get_the_ID());
        $categories_list = '';
        foreach ($categories_ids as $category_id) {
            $categories_list .= get_cat_name($category_id) . ', ';
        }
        $no_meta_description = false;
        $post_classes = 'post';

        $cats = wp_get_post_categories(get_the_ID());
        if(count($cats) > 1) {
            $multiple_categories = true;
        }

        //yoast meta description
        $yoast_md = get_post_meta( get_the_ID() , '_yoast_wpseo_metadesc', true); 
        if(empty($yoast_md)){
            $no_meta_description = true;
        }

        if($multiple_categories or $no_meta_description) {
            $post_classes .= ' error';
        } else {
            $post_classes .= ' success';
        }

        echo '<div class="'.$post_classes.'">'; ?>
    <div class="post-name">
        <?php echo get_the_title() . ' - ' . get_the_author(); ?>
    </div>
    <?php 
    if($multiple_categories) {
    echo '<span class="multiples-categorias">Mas de una categoría: </span><span
        class="categorias">'.$categories_list.'</span>';
    }
    if($no_meta_description) {
    echo '<span class="no-meta-description">No meta description</span>';
    }
    if(!$no_meta_description and !$multiple_categories) {
    echo '<div class=><span class="good">Good</span>😃</div>';
    }
    echo '<a class="button" href="/wp-admin/post.php?post='.get_the_ID().'&action=edit" target="_blank"> Editar post
    </a>';
    echo '</div>';
    }
    }
    ?>
</body>

</html>