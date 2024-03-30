<?php

function gx_get_posts( WP_REST_Request $request ) {

    $per_page = $request->get_param('per_page'); 
    if(!$per_page) {
        $per_page = -1; //all posts
    }
    $cat = $request->get_param('cat');
    $tag = $request->get_param('tag');
    $search = $request->get_param('search');
    $paged = $request->get_param('paged');
    $author = $request->get_param('author');
    $langCode = $request->get_param('lang_code');
    //switch language
    do_action( 'wpml_switch_language', $langCode );

    $return = [
        'posts'=>[],
        'pagination'=>[],
    ];

    $query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => $cat,
        'tag_id' => $tag,
        'author' => $author,
        'posts_per_page' => $per_page,
        's' => sanitize_text_field($search),
        'sentence' => 1, //Make wordpress search by exact phrase
        'paged' => $paged,
        'orderby' => 'date',
        'suppress_filters' => false
    ));
    
    if($query->have_posts()){
        
        //return $query->posts;
        foreach($query->posts as $post) {
        
        $post_object = (object)[];
              
        //id, permalink and title                                       
        $post_object->ID = $post->ID;
        $post_object->permalink = get_permalink($post->ID);
        $post_object->title = get_the_title($post->ID);
        //date
        $date_time = new DateTime($post->post_date);
        $url = $_SERVER['REQUEST_URI'];
        if ($langCode == 'en') {
            //ingles
            $post_object->date = date_format($date_time,'n/j/Y');
        } else {
            //espanol o portugues
            $post_object->date = date_format($date_time,'j/n/Y');
        }

        //author
        $post_object->author_display_name = get_the_author_meta('display_name', $post->post_author);
        $post_object->author_url = get_author_posts_url($post->post_author);
        $post_object->author_gravatar_url = get_avatar_url($post->post_author, ['size' => '40']);
        
        //Yoast meta description
        if(empty(get_post_meta($post->ID, '_yoast_wpseo_metadesc', true))){
            $post_object->yoast_meta_description = null;
            $post_object->yoast_meta_description_short = null;
        } else {
            $post_object->yoast_meta_description = get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);
            $post_object->yoast_meta_description_short = wp_trim_words($post_object->yoast_meta_description, 25);
        }

        //categories
        $categories = wp_get_post_categories($post->ID);
        $categories_array = [];
        foreach($categories as $cat_id) {
            $cat_object = (object)[];   
            $cat_object->name = get_term_meta($cat_id);
            $cat_color = get_term_meta( $cat_id, 'gx_category_color', true );
            $cat_bg_color = get_term_meta( $cat_id, 'gx_category_bg_color', true );
            if($cat_color == null or $cat_bg_color == null) {
                $cat_color = '#888484';
                $cat_bg_color = '#f8f8f8';
            }
            $cat_object->color = $cat_color;
            $cat_object->bgcolor = $cat_bg_color;
            $cat_object->link = get_category_link($cat_id);
            array_push($categories_array, $cat_object);
        }
        $post_object->categories = $categories_array;
        
        //tags
        $tags = get_the_tags($post->ID);
        if($tags) {
            $tags_array = [];
            foreach($tags as $tag) {
                $tag_object = (object)[];   
                $tag_object->name = $tag->name;
                $tag_object->link = get_tag_link($tag->term_id);
                array_push($tags_array, $tag_object);
            }
            $post_object->tags = $tags_array;        
        } else {
            $post_object->tags = null;
        }

        //featured image url
        $has_featured_img = has_post_thumbnail($post->ID);
        $hide_featured_image = get_post_meta( $post->ID, 'gx_post_aside_hide_featured_image', true );
        if(!$hide_featured_image and $has_featured_img) {
            $post_object->featured_img_url = get_the_post_thumbnail_url( $post->ID , 'post_grilla');   
        } else {
            $post_object->featured_img_url = null;
        }    
        
        array_push($return['posts'], $post_object);
    }
      
    $pagination = paginate_links( array(
        'total'        => $query->max_num_pages,
        'current'      => $query->query['paged'],
        'show_all'     => true,
        'type'         => 'array',
        'prev_next'    => false,
    ) );
    
    array_push($return['pagination'], $pagination);
      
    }
    return $return;
  }
  
  add_action( 'rest_api_init', function () {
    register_rest_route( 'genexus/v1', '/posts', array(
      'methods' => WP_REST_Server::READABLE,
      'callback' => 'gx_get_posts',
      'permission_callback' => '__return_true',
    ) );
  } );
?>