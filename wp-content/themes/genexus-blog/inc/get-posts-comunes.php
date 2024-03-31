<?php
    if(!function_exists('get_posts_comunes')){
        function get_posts_comunes($quantity, $excluded_posts, $categories_in, $tags_in, $author){
            
            $posts_comunes = new WP_Query(array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'cat' => $categories_in,
                'tag_id' => $tags_in,
                'author' => $author,
                'posts_per_page' => $quantity,
                'post__not_in' => $excluded_posts,
                'orderby' => 'date',
                'suppress_filters' => false
            ));
            if($posts_comunes->have_posts()){                
                return $posts_comunes;
            } else {
                return null;
                //No hay posts comunes (nada que hacer).
            }
        }
    }
?>