<?php get_header();

/*******************************
REQUIRES
*******************************/
require_once(__ROOT__.'/inc/get-posts-comunes.php');

$tag = get_queried_object();
$tag_name = $tag->name;
?>

<?php
    //If there are less than four results, hide the search input
    $posts_tag = get_posts_comunes(9, null, null, $tag->term_id, null);
    $less_than_four_results = false;
    if(count($posts_tag->posts) < 4) {
        $less_than_four_results = true;
    }
?>

<main class="section" id="live-search">

    <nav class="navbar navbar--search-posts">
        <div class="container">
            <section class="wrapper">
                <h2 class="h1 m-0">
                    #<?php echo $tag_name;?> Tag
                </h2>
                <div class="menu" id="menu-posts">
                    <ul class="menu-inner">
                        <li
                            class="menu-item menu-item--live-search <?php if($less_than_four_results){echo 'hidden';}?>">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search" id="input-live-search"
                                data-tag="<?php echo $tag->term_id?>" class="input-live-search light">
                            <i class="fas fa-times"></i>
                            <i class="fas fa-microphone"></i>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </nav>

    <div class="container" id="live-search-results">
        <div class="search-results-feedback search-results-feedback--hidden">
            <!-- this gets filled by javascript -->
        </div>
        <div class="search-results-wrapper">

            <div class="grid grid-3">
                <?php
                    get_template_part('template-parts/posts', 'grid' , array($posts_tag->posts));
                ?>
            </div>

            <?php 
                $pagination = paginate_links( array(
                    'total'        => $posts_tag->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' )),
                    'show_all'     => true,
                    'type'         => 'array',
                    'prev_next'    => false,
                ) );
                get_template_part('template-parts/custom', 'pagination' , array($pagination ,'', false));
            ?>

        </div>
    </div>

</main>

<?php get_footer() ?>