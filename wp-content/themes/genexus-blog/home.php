<?php get_header(); ?>

<main>
    <?php
    /*******************************
    REQUIRES
    *******************************/
    require_once __ROOT__ . '/inc/get-posts-comunes.php';
    require_once __ROOT__ . '/inc/get-stickies.php';
    require_once __ROOT__ . '/inc/get-sticky-main.php';
    $excluded_posts_ids = [];
    ?>

    <section class="section featured-posts" id="featured-posts">
        <div class="container">
            <div class="featured-posts__grid">
                <div class="featured-posts__grid__left">
                    <?php
                    /*******************************
                    STICKY MAIN POST 
                    *******************************/
                    if($sticky_main === null) {
                      get_template_part('template-parts/empty', 'state', ["main-sticky-post"]);

                    } else {
                      array_push($excluded_posts_ids, $sticky_main->ID);
                      get_template_part('template-parts/post', 'sticky-main', [
                        $sticky_main,
                      ]);
                    }

                    ?>
                </div>
                <div class="featured-posts__grid__right">
                    <?php
                    /*******************************
                    3 STICKY POSTS
                    *******************************/
                    $stickies = get_stickies(3, $excluded_posts_ids);
                    if(count($stickies) === 0) {
                      get_template_part('template-parts/empty', 'state', ["sticky-posts"]);
                    } else {
                      foreach ($stickies as $destacado) {
                        array_push($excluded_posts_ids, $destacado->ID);
                        get_template_part('template-parts/post', 'sticky', [
                          $destacado,
                        ]);
                      }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- RECENT POSTS -->
<section class="section" id="recent-posts">
    <div class="container">
        <h2 class="h1"><?php echo $GLOBALS["gx_trans"]->recent_posts; ?></h2>

        <?php 
          $recent_posts = get_posts_comunes(
            3,
            $excluded_posts_ids,
            null,
            null,
            null
          );

          if((isset($recent_posts->posts) && count($recent_posts->posts) >= 1)) {
            echo '<div class="grid grid-3">';
            foreach ($recent_posts->posts as $recent_post) {
              echo '<div class="grid__item">';
              get_template_part('template-parts/post', 'comun', [
                $recent_post,
                false,
              ]);
              echo '</div>';
              echo '<hr class="post-separator post-separator--mobile">';
            }
            echo '</div>';
          } else {
            get_template_part('template-parts/empty', 'state', ["recent posts"]);
          }

        ?>
    </div>
</section>

<!-- CATEGORIES -->
<section class="section" id="categories">
    <div class="container">
        <h2 class="h1"><?php echo $GLOBALS["gx_trans"]
          ->categories; ?> <i class="fas fa-long-arrow-alt-right"></i></h2>
        <div class="categories-showcase main-carousel">
            <?php
            $categories = get_categories([
              'orderby' => 'name',
              'order' => 'ASC',
            ]);
            foreach ($categories as $category) {
              if ($category->slug !== 'uncategorized') {
                get_template_part('template-parts/categories', 'showcase', [
                  $category,
                ]);
              }
            }
            ?>
        </div>
    </div>
</section>

<!-- SUBSCRIBE BANNER -->
<?php get_template_part('template-parts/subscribe-banner'); ?>

<!-- ALL POSTS -->
<section class="section" id="live-search">
    <nav class="navbar navbar--search-posts">
        <div class="container">
            <section class="wrapper">
                <h2 class="h1 m-0">
                    <?php echo $GLOBALS["gx_trans"]->all_posts; ?>
                </h2>
                <div class="menu" id="menu-posts">
                    <ul class="menu-inner">
                        <li class="menu-item menu-item--live-search">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="<?php echo $GLOBALS[
                              "gx_trans"
                            ]->search; ?>"
                                id="input-live-search" class="input-live-search light">
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
                $all_posts = get_posts_comunes(9, null, null, null, null);
                get_template_part('template-parts/posts', 'grid', [
                  $all_posts->posts,
                ]);
                ?>
            </div>

            <?php
            $pagination = paginate_links([
              'total' => $all_posts->max_num_pages,
              'current' => max(1, get_query_var('paged')),
              'show_all' => true,
              'type' => 'array',
              'prev_next' => false,
            ]);
            get_template_part('template-parts/custom', 'pagination', [
              $pagination,
              '',
              false,
            ]);
            ?>
        </div>
</section>

<?php get_footer(); ?>
