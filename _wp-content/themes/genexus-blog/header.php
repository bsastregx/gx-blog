<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>

    <?php
    //CURRENT LANG
    $current_lang = apply_filters( 'wpml_current_language', null );
    $searchLang = "";
    if($current_lang !== "en") {
        //only portuguese and spanish need to be added as a parameter.
        //english does not need bo the added, because is the default language.
        $searchLang = $current_lang;
    }

    //TITLE TAG
    $title = '';
    if(is_front_page()) {
        $title = 'Blog GeneXus';
    }
    else if(is_category()){
        $category_name = get_category( get_query_var( 'cat' ))-> name;
        $title = $category_name;
    } else if(is_single()) {
        $title = single_post_title('', false);
    } else if (is_author()) {
        $title = get_the_author_meta('display_name');
    } else if(is_tag()) {
        $title = $tag = get_queried_object()->slug;
    }
    $blog_name = get_bloginfo('name');
    ?>
    <title><?php echo $title . ' - ' . $blog_name; ?></title>

    <!-- MailerLite Universal -->
    <script>
    (function(m, a, i, l, e, r) {
        m['MailerLiteObject'] = e;

        function f() {
            var c = {
                a: arguments,
                q: []
            };
            var r = this.push(c);
            return "number" != typeof r ? r : f.bind(c.q);
        }
        f.q = f.q || [];
        m[e] = m[e] || f.bind(f.q);
        m[e].q = m[e].q || f.q;
        r = a.createElement(i);
        var _ = a.getElementsByTagName(i)[0];
        r.async = 1;
        r.src = l + '?v' + (~~(new Date().getTime() / 1000000));
        _.parentNode.insertBefore(r, _);
    })(window, document, 'script', 'https://static.mailerlite.com/js/universal.js', 'ml');

    var ml_account = ml('accounts', '2974798', 'a4y7z2q4a3', 'load');
    </script>
    <!-- End MailerLite Universal -->
</head>

<?php

/*******************************
NAVBAR CLASSES
*******************************/
$navbarClasses = 'navbar navbar--main navbar--collapsable';
if(is_author()) {
    $navbarClasses .= ' navbar--offset-bottom';
}

/*******************************
CATEGORIES
*******************************/
$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );

if(is_category()){
    $category = get_queried_object();
    $cat_name = $category->name; 
    $cat_english_id = apply_filters( 'wpml_object_id', $category->term_id, 'category', FALSE, 'en');
    $cat_color = get_term_meta( $cat_english_id, 'gx_category_color', true );
    $cat_bgcolor = get_term_meta( $cat_english_id, 'gx_category_bg_color', true );
    $cat_header_img_url = get_term_meta( $cat_english_id, 'gx_category_header_image', true );
    $cat_header_icon_url = get_term_meta( $cat_english_id, 'gx_category_icon', true );
    $cat_header_icon_mobile_url = get_term_meta( $cat_english_id, 'gx_category_icon_mobile', true );
}   
?>

<body <?php body_class('body-hidden'); ?>>
    <?php do_action('after_body_open_tag'); ?>
    <header class="header header--main"
        <?php if(is_category()){echo 'style="background-image: url('.$cat_header_img_url.');"';}?>>
        <a href="//www.genexus.com/" class="top-bar" id="top-bar">
            <span class="top-bar__text"><?php echo $GLOBALS["gx_trans"]->learn_more_about_genexus;?></span> <i
                class="top-bar__arrow fas fa-arrow-right"></i>
        </a>
        <nav class="<?php echo $navbarClasses; ?>" id="main-navbar"
            <?php if(is_category()){echo 'style="background-color:'.$cat_bgcolor.'"';}?>>
            <div class="container">
                <section class="wrapper">
                    <div class="brand-search-button-wrapper">
                        <h1 class="brand">
                            <a href="<?php echo get_site_url(); ?>" class="brand-link">
                                GeneXus Blog
                            </a>
                        </h1>
                        <div class="serach-button-wrapper">
                            <i class="fas fa-search fa-search--mobile go-to-search"></i>
                            <button type="button" class="burger" id="burger-main">
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                            </button>
                        </div>
                    </div>
                    <div class="menu" id="menu-main">
                        <ul class="menu__inner">
                            <li class="menu-item menu-item--has-card">
                                <a class="menu-item__link" id="main-navbar-categories-link">
                                    <?php echo $GLOBALS["gx_trans"]->categories;?><i
                                        class="fas fa-chevron-down"></i></a>
                                <div class="card navbar__card navbar__card--categories">
                                    <ul class="ul-categories">
                                        <?php
                                        foreach( $categories as $category ) {
                                            if($category->slug !== 'uncategorized') {
                                                get_template_part('template-parts/category', 'menu' , array($category));
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item--search menu-item--has-card">
                                <a class="menu-item__link go-to-search"><?php echo $GLOBALS["gx_trans"]->search;?> <i
                                        class="fas fa-search"></i></a>
                                <div class="card navbar__card">
                                    <form method="get" action="<?php echo esc_url(site_url('/'.$searchLang));?>"
                                        class="traditional-search">
                                        <input type="search" name="s" class="light" placeholder="Type here...">
                                        <input type="submit" value="Search">
                                    </form>
                                </div>
                            </li>
                            <li class="menu-item menu-item--has-card menu-item__language_switcher">
                                <a class="menu-item__link">
                                    Languages<i class="fas fa-chevron-down"></i></a>
                                <div class="card-invisible" <i class="fas fa-globe"></i>
                                    <?php echo do_shortcode('[multilanguage_switcher]') ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </nav>

        <?php if(is_category()){ ?>

        <div class="container category-info-container category-info-container--desktop">
            <div class="category-info">
                <div class="category-info__wrapper">
                    <div class="category-info__icon">
                        <img src="<?php echo $cat_header_icon_url;?>">
                    </div>
                    <h1 class="category-info__name">
                        <?php echo $cat_name;?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="container category-info-container category-info-container--mobile position-relative z-index-10">
            <div class="category-info">
                <div class="category-info__wrapper">
                    <div class="big-circle category-info__image" style="background-color:<?php echo $cat_color; ?>">
                        <img src="<?php echo $cat_header_icon_mobile_url; ?>" alt="category icon">
                    </div>
                    <h1 class="category-info__name">
                        <?php echo $cat_name;?>
                    </h1>
                </div>
            </div>
        </div>

        <?php } ?>
    </header>