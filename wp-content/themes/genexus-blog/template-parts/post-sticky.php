<?php
    $sticky_post = $args[0];
    global $post;
    $post = $sticky_post;
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

    wp_reset_postdata();
?>

<article class="featured-post">
    <?php get_template_part('template-parts/post','categories', array($categories)); ?>
    <h1 class="h3 featured-post__title">
        <a href="<?php echo $permalink;?>">
            <?php echo $title;?>
        </a>
    </h1>
    <?php get_template_part('template-parts/author', null, array($author_array)); ?>
</article>
<hr class="post-separator post-separator--mobile">