<?php
define('__ROOT__', dirname(__FILE__));
/*
INDEX:
1.ENQUEUE SCRIPTS
2.THEME SUPPORT
3.ADD CUSTOM POST THUMBNAIL TO WORDPRESS API
4.CUSTOM WORDPRESS API ENDPOINTS
5.COUNT NUMBER OF WORDS A POST HAS
6.TRANSLATIONS
7.AFTER BODY OPEN TAG
8.CUSTOM REDIRECT 404
9.CMB2 CUSTOM FIELDS
*/

/*******************************
1.ENQUEUE SCRIPTS
*******************************/
function blog_files() {
    wp_enqueue_script('google-tag-manager-head', get_theme_file_uri('/scripts/gtm-head.js'), array(), '1.0');
    wp_enqueue_script('live-search', get_theme_file_uri('/scripts/live-search.js'), array(), '3.1', true);
    wp_enqueue_script('flickity-slider', get_theme_file_uri('/scripts/flickity.min.js'), array(), '1.1', true);
    wp_enqueue_script('blog_scripts', get_theme_file_uri('/scripts/blog-scripts.js'), array('live-search', 'flickity-slider'), '1.9', true);
    wp_enqueue_style('blog_styles', get_theme_file_uri('style.css'), array(), '4.6');
    wp_enqueue_script('font-awesome', '//kit.fontawesome.com/7f657c2296.js');

    // Threaded comment reply styles.
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply');
    }
    
    //GeneXus sticky banner on every page:
    /*wp_enqueue_script('gx-sticky-banner', 'https://gx-sticky-banner.netlify.app/assets/sticky-gx.min.js');*/
}
add_action('wp_enqueue_scripts', 'blog_files');



/*******************************
2.THEME SUPPORT
*******************************/
function blog_features() {
  //add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('post_mega_destacado', 740, 430, true);
  add_image_size('post_grilla', 350, 203, true);
  add_image_size('post_single', 560, 325, true);
  add_theme_support('html5', array('comment-list', 'comment-form'));
}

add_action('after_setup_theme', 'blog_features');


/********************************************
3.ADD CUSTOM POST THUMBNAIL TO WORDPRESS API
********************************************/
function custom_thumbnail_api( $data ) {
  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $data['id'] ), 'post_grilla' );
  return $image_url;
}
add_action( 'rest_api_init', function () {
  register_rest_route( 'custom_thumbnail', '/post/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'custom_thumbnail_api',
  ) );
} );


/********************************
4.CUSTOM WORDPRESS API ENDPOINTS
********************************/
require get_theme_file_path('/inc/custom-api.php');


/*********************************
5.COUNT NUMBER OF WORDS A POST HAS
*********************************/
/**
 * Count the number of words in post content
 * @param string $content The post content
 * @return integer $count Number of words in the content
 */
function count_content_words( $content ) {
  $decode_content = html_entity_decode( $content );
  $filter_shortcode = do_shortcode( $decode_content );
  $strip_tags = wp_strip_all_tags( $filter_shortcode, true );
  $count = str_word_count( $strip_tags );
  return $count;
}

/*******************************
6.TRANSLATIONS
*******************************/
require_once(__ROOT__.'/inc/translations.php');
$lang = get_locale();
$GLOBALS["gx_trans"] = new Translation();
if($lang == 'es_ES') {
  $GLOBALS["gx_trans"]->set_language('es_ES');
} else if ($lang == 'pt_BR'){
  $GLOBALS["gx_trans"]->set_language('pt_BR');
} else {
  //english
  $GLOBALS["gx_trans"]->set_language('en_US');
}

/*******************************
7.AFTER BODY OPEN TAG
*******************************/
function custom_content_after_body_open_tag() { ?>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M66CXD2"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

<?php }
add_action('after_body_open_tag', 'custom_content_after_body_open_tag');


/*******************************
9.CMB2 CUSTOM FIELDS
*******************************/
require_once(__ROOT__.'/inc/cmb2.php');

?>