<?php
    if(!function_exists('get_sticky_main')){
        function get_sticky_main(){
            $sticky_main = get_posts(array(
                'numberposts' => -1,
                'post_type' => 'post',
                'post_status' => 'publish',
                'meta_key' => 'sticky_main',
                'meta_value' => '1',
                'orderby' => 'date',
                'suppress_filters' => false
            ));    
            if(count($sticky_main) === 0) {
                //There is no sticky_main post. Try to get a sticky post then. If there is no sticky post neither, get_stickies will return a common post.
                $sticky_main = get_stickies(1, null);
                return $sticky_main[0];
            } else {
                //There is a sticky_main post. We are happy.
                return $sticky_main[0];
            }
        }
    }

?>