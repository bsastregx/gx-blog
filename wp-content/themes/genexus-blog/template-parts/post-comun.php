<?php
    $post_comun = $args[0];
    $show_image = $args[1];
    
    global $post;
    $post = $post_comun;
    setup_postdata($post);
    $id = $post->ID;

    //categories
    $categories = array(wp_get_post_categories($id)[0]); //We only want to display one category per post.
    

    //author and date
    $lang = get_locale();
    if($lang == 'en_US') {
        $date = get_the_date('n/j/Y');
    } else {
        $date = get_the_date('j/n/Y');
    }

    $author_id = get_the_author_meta('ID');
    $author_gravatar_url = get_avatar_url($author_id);
    $author_display_name = get_the_author_meta('display_name', $author_id);
    $author_url = get_author_posts_url($author_id);
    $author_array = [
        $author_gravatar_url,
        $author_display_name,
        $author_url,
        $date
    ];
    

    //title
    $title = get_the_title();
    $permalink = get_permalink();

    //featured image
    if($show_image) {
        $has_featured_img = has_post_thumbnail($id);
        $hide_featured_image = get_post_meta( $id, 'gx_post_aside_hide_featured_image', true );
        if(!$hide_featured_image and $has_featured_img) {
            $thumbnail_url = get_the_post_thumbnail_url( $id , 'post_grilla');   
        }
    }

    //yoast meta description
    $yoast_md = get_post_meta($id, '_yoast_wpseo_metadesc', true); 
    $yoast_md_short = wp_trim_words($yoast_md, 25);    
    
    //tags
    $tags = get_the_tags($id);
    if($tags) {
        $tags_sliced = array_slice($tags, 0, 3); //We only want to display a maximum of three tags per post.
    }

    wp_reset_postdata();
?>

<article class="post">
    <?php get_template_part('template-parts/post','categories', array($categories)); ?>
    <?php get_template_part('template-parts/author', null, array($author_array)); ?>
    <h1 class="post__title">
        <a href="<?php echo $permalink; ?>">
            <?php echo $title ?>
        </a>
    </h1>
    <?php
    
    if($show_image) {
        if($has_featured_img and !$hide_featured_image) {
            echo '<div class="post__image"><a href="'.$permalink.'"><img src="'.$thumbnail_url.'" alt=""></a></div>';
        }
    }

    if(!empty($yoast_md)) {
        echo '<p class="post__excerpt">'.$yoast_md_short.'</p>';
    }

    if($tags) {
    echo '<div class="tags-container">';
    foreach($tags_sliced as $tag) {
        $tag_link = get_tag_link($tag->term_id);
        echo '<a href="'.$tag_link.'" class="tag">#'.$tag->name.'</a>';
    }
    echo '</div>';
    }
    ?>
</article>