<?php
    $sticy_main_post = $args[0];
    global $post;
    $post = $sticy_main_post;
    setup_postdata($post);

    $id = $post->ID;
    $title = get_the_title();
    $permalink = get_permalink();
    //date
    $lang = get_locale();
    if($lang == 'en_US') {
        $date = get_the_date('n/j/Y');
    } else {
        $date = get_the_date('j/n/Y');
    }
    //author
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

    //categories
    $categories = array(wp_get_post_categories($id)[0]); //We only want to display one category per post.
    //featured image
    $featured_img_id = get_post_thumbnail_id();
    if($featured_img_id == 0) {
        //the post has no featured image
        $featured_img_url = get_theme_file_uri('/assets/images/default-mega-post-image.png');
    } else {
        $featured_img_url_array = wp_get_attachment_image_src($featured_img_id, 'post_mega_destacado', true);
        $featured_img_url = $featured_img_url_array[0];
    }
    
    wp_reset_postdata();
?>
<article class="featured-post featured-post--main">
    <h1 class="h1 featured-post--main__title">
        <a href="<?php echo $permalink;?>"><?php echo $title;?></a>
    </h1>
    <div class="autor-categories-container">
        <?php get_template_part('template-parts/author', null, array($author_array)); ?>
        <?php get_template_part('template-parts/post','categories', array($categories)); ?>
    </div>
    <div class="featured-post--main__image">
        <a href="<?php echo $permalink;?>">
            <img src="<?php echo $featured_img_url; ?>" alt="main featured post image">
        </a>
    </div>
</article>
<hr class="post-separator post-separator--mobile">
<hr class="post-separator post-separator--mobile">