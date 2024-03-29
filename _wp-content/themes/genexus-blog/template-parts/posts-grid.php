<?php
$posts = $args[0];

if($posts) {

    $column1 = '<div class="grid__item">';
    $column2 = '<div class="grid__item">';
    $column3 = '<div class="grid__item">';

    foreach( $posts as $key=>$post_comun ) {

        ob_start();
        get_template_part('template-parts/post', 'comun' , array($post_comun, true));
        $article = ob_get_contents();
        
        if($key === 0 or $key % 3 == 0) {
            $column1 .= $article . '<hr class="post-separator">';
        } else if ($key == 1 or ($key - 1) % 3 == 0 ) {
            $column2 .= $article . '<hr class="post-separator">';
        } else if (($key + 1) % 3 == 0) {
            $column3 .= $article . '<hr class="post-separator">';
        }

        ob_end_clean();
    }

    //close columns
    $column1 .= '</div>';
    $column2 .= '</div>';
    $column3 .= '</div>';

    //merge columns
    echo $column1 . $column2 . $column3;
    
} ?>