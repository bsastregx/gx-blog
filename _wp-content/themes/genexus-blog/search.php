<?php
    get_header();
    $the_search = get_search_query();
    $page = get_query_var( 'page' );
?>

<div class="container section">

    <div class="search-container">
        <form method="get" action="<?php echo esc_url(site_url('/'));?>" class="traditional-search">
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" name="s" class="input-search light" value="<?php echo $the_search?>">
                <i class="fas fa-times"></i>
            </div>
            <input type="submit" value="<?php echo $GLOBALS["gx_trans"]->search;?>">
        </form>
    </div>
    <h1 class="main-title"><?php echo $GLOBALS["gx_trans"]->you_searched_for;?> <?php echo $the_search?></h1>

    <?php
        $query = new WP_Query(array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 9,
            'orderby' => 'date',  
            's' => $the_search,
            'paged' => $page
        ));
        if($query->have_posts()){  ?>
    <div class="search-results-wrapper">

        <div class="grid grid-3">
            <?php
            get_template_part('template-parts/posts', 'grid' , array($query->posts));
        ?>
        </div>

        <?php 
        $pagination = paginate_links( array(
            'total'        => $query->max_num_pages,
            'current'      => max( $page, get_query_var( 'paged' )),
            'show_all'     => true,
            'type'         => 'array',
            'prev_next'    => false,
        ) );
        get_template_part('template-parts/custom', 'pagination' , array($pagination , $the_search, true));
    ?>
    </div>
    <?php } else { ?>
    <p><?php echo $GLOBALS["gx_trans"]->no_match;?></p>
    <?php }
    ?>

</div>

<?php get_footer() ?>