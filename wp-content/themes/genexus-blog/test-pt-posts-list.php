<?php
/* Template Name: All Posts V2*/

get_header(); // Include the site header
?>

<head>
    <style type="text/css">
    
    </style>
</head>

<div class="all-posts">
    <h1>All Blog Posts</h1>
    <ul>
        <?php
        // Query all posts
        $args = array(
            'post_type' => 'post', // Get posts
            'posts_per_page' => -1, // Show all posts
            'orderby' => 'date', // Order by date
            'order' => 'DESC' // Newest first
        );
        $all_posts = new WP_Query($args);

        // Loop through the posts
        if ($all_posts->have_posts()) :
            while ($all_posts->have_posts()) : $all_posts->the_post();
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <span> - <?php echo get_the_date(); ?></span>
                </li>
                <?php
            endwhile;
        else :
            echo '<p>No posts found.</p>';
        endif;

        // Reset post data
        wp_reset_postdata();
        ?>
    </ul>
</div>

<?php
get_footer(); // Include the site footer
?>
