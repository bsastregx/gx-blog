<?php get_header();

/*******************************
REQUIRES
*******************************/
require_once(__ROOT__.'/inc/get-posts-comunes.php');

$category = get_queried_object();
?>

<main class="main section" id="live-search">
    <nav class="navbar navbar--search-posts">
        <div class="container">
            <section class="wrapper">
                <h2 class="h1 m-0 main-title">
                    <?php echo $category->name?> <?php echo $GLOBALS["gx_trans"]->posts;?>
                </h2>
                <div class="menu" id="menu-posts">
                    <ul class="menu-inner">
                        <li class="menu-item menu-item--live-search">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="<?php echo $GLOBALS["gx_trans"]->search;?>"
                                id="input-live-search" data-cat="<?php echo $category->term_id?>"
                                class="input-live-search light">
                            <i class="fas fa-times"></i>
                            <!-- <i class="fas fa-microphone"></i> -->
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
                    $posts_categoria = get_posts_comunes(9, null, $category->term_id, null, null);
                    get_template_part('template-parts/posts', 'grid' , array($posts_categoria->posts));
                ?>
            </div>

            <?php 
                $pagination = paginate_links( array(
                    'total'        => $posts_categoria->max_num_pages,
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