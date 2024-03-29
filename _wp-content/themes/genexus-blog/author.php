<?php get_header();

/*******************************
REQUIRES
*******************************/
require_once(__ROOT__.'/inc/get-posts-comunes.php');

$author = get_queried_object();
$author_id = $author->data->ID;
$author_gravatar_url = get_avatar_url($author_id , array(
    'size' => '216'
));
$author_display_name = $author->data->display_name;
$author_position = get_post_meta( $author_id, 'gx_author_position', true );
//phrase
$lang = get_locale();
if($lang == 'es_ES') {
    $author_phrase = get_post_meta( $author_id, 'gx_author_favorite_quote_es', true );
  } else if ($lang == 'pt_BR'){
    $author_phrase = get_post_meta( $author_id, 'gx_author_favorite_quote_pt', true );
  } else {
    //english
    $author_phrase = get_post_meta( $author_id, 'gx_author_favorite_quote_en', true );
  }
$autor_email = $author->data->user_email;
$author_linkedin = get_user_meta( $author_id, 'linkedin' , true );
$author_twitter = get_user_meta( $author_id, 'twitter' , true );

?>

<div class="container position-relative z-index-10-mobile">
    <section class="author-info section">

        <div class="big-circle author-info__image">
            <img src="<?php echo $author_gravatar_url; ?>" alt="gravatar image">
        </div>

        <h1 class="author-info__name">
            <?php echo $author_display_name; ?>
        </h1>

        <?php if($author_position) { ?>
        <span class="author-info__position">
            <?php echo $author_position; ?>
        </span>
        <?php } ?>

        <?php
        if($author_phrase) { ?>
        <p class="author-info__description">
            <?php echo $author_phrase; ?>
        </p>
        <?php } ?>

        <?php
        if($author_linkedin || $author_twitter) {
        ?>
        <address class="author-info__contact">
            <ul class="author-info__social">

                <?php if($author_linkedin) { ?>
                <li class="author-info__social__item">
                    <a class="author-info__social__link" target="_blank" href="<?php echo $author_linkedin; ?>">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </li>
                <?php }

                    if($author_twitter) { ?>
                <li class="author-info__social__item">
                    <a class="author-info__social__link" target="_blank"
                        href="//twitter.com/<?php echo $author_twitter; ?>">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <?php } ?>

            </ul>
        </address>
        <?php } ?>

    </section>
</div>

<?php
    //If there are less than four results, hide the search input
    $posts_author = get_posts_comunes(9, null, null, null, $author_id);
    $less_than_four_results = false;
    if(count($posts_author->posts) < 4) {
        $less_than_four_results = true;
    }
?>

<main class="main section" id="live-search">
    <nav class="navbar navbar--search-posts">
        <div class="container">
            <section class="wrapper">
                <h2 class="h1 m-0">
                    Posts by <?php echo $author_display_name?>
                </h2>
                <div class="menu" id="menu-posts">
                    <ul class="menu-inner">
                        <li
                            class="menu-item menu-item--live-search <?php if($less_than_four_results){echo 'hidden';}?>">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="<?php echo $GLOBALS["gx_trans"]->search;?>"
                                id="input-live-search" data-author="<?php echo $author_id?>"
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
                    get_template_part('template-parts/posts', 'grid' , array($posts_author->posts));
                ?>
            </div>

            <?php 
                $pagination = paginate_links( array(
                    'total'        => $posts_author->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' )),
                    'show_all'     => true,
                    'type'         => 'array',
                    'prev_next'    => false,
                ) );
                get_template_part('template-parts/custom', 'pagination' , array($pagination ,'' , false));
            ?>

        </div>
    </div>
</main>

<?php get_footer() ?>