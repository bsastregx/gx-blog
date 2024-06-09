<?php get_header();

/*******************************
REQUIRES
*******************************/
require_once(__ROOT__.'/inc/get-posts-comunes.php');

/*******************************
THE POST
*******************************/
while(have_posts()) {
the_post();

$category = array(wp_get_post_categories(get_the_id())[0]); //We only want to display one category per post.

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

//tags
$tags = get_the_tags();
if($tags) {
    $tags_sliced = array_slice($tags, 0, 3); //We only want to display a maximum of three tags per post.
}

$args = array(
    'post_id' => get_the_id(), // Use post_id, not post_ID
    //'count' => true // Return only the count
    'number' => 2
);
$comments_count = get_comments( $args );

//Calculate time of reading
$number_of_words = count_content_words(get_the_content());
$words_per_minute = 200;
$minutes_of_reading = ceil($number_of_words / $words_per_minute);

//Featured image
$post_image_url = null;
if (has_post_thumbnail( $post->ID ) ):
    $post_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post_single' )[0];
endif;
?>

<main class="main section">
    <div class="container">

        <?php
            $post_edit_url = get_edit_post_link( get_the_ID());
            echo "<a style='display:block; margin-bottom: 16px;' href='.$post_edit_url.' target='_blank'>Edit Post</a>"
        ?>
    
        <?php get_template_part('template-parts/post','categories', array($category)); ?>
        <div class="author-reading-time">
            <?php get_template_part('template-parts/author', null, array($author_array)); ?>
            <span class="reading-time"><i class="far fa-clock"></i><?php echo $minutes_of_reading; ?> Min.</span>
        </div>

        <h1 class="main-title">
            <?php the_title()?>
        </h1>
        <?php if($post_image_url) { ?>
        <div class="featured-image-container">
            <img class="featured-image" src="<?php echo $post_image_url; ?>" alt="">
        </div>
        <?php } ?>
        <div class="the-content">
            <?php the_content()?>
        </div><!-- /content -->
        <footer class="post__footer">
            <?php
            if($tags) {
                echo '<div class="tags-container">';
                foreach($tags_sliced as $tag) {
                    $tag_link = get_tag_link($tag->term_id);
                    echo '<a href="'.$tag_link.'" class="tag">#'.$tag->name.'</a>';
                }
                echo '</div>';
                }
            ?>
        </footer>
    </div>
</main>

<?php
$related_posts = get_posts_comunes(3, array(get_the_id()), $category, null, null);
if($related_posts) { ?>
<section class="section" id="related-posts">
    <div class="container">
        <h2 class="h1">Related Posts</h2>
        <div class="grid grid-3">
            <?php
                //get_template_part('template-parts/posts', 'grid' , array($related_posts->posts));  
                foreach($related_posts->posts as $related_post) {
                    echo '<div class="grid__item">';
                    get_template_part('template-parts/post', 'comun' , array($related_post, false));
                    echo '<hr class="post-separator post-separator--mobile">';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</section>
<?php } 

}
get_footer(); ?>