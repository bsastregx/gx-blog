<?php
if (!function_exists('get_stickies')) {
  function get_stickies($quantity, $excluded_sticky_main_id)
  {
    $aside_posts = [];
    $sticky_posts = get_option( 'sticky_posts' );
    $excluded_sticky_main_id_key = array_search($excluded_sticky_main_id[0], $sticky_posts); //exclude sticky_post if was already used in sticky_main
    if ($excluded_sticky_main_id_key !== false) {
      unset($sticky_posts[$excluded_sticky_main_id_key]);
    }
    $aside_get_posts = get_posts(array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'numberposts' => $quantity,
      'post__in' => $sticky_posts,
      'post__not_in' => $excluded_sticky_main_id, //Esto evita que se muestre de nuevo el sticky_main post
      'orderby' => 'date',
    ));    
    $aside_get_posts_cantidad = count($aside_get_posts);
    if ($aside_get_posts_cantidad < $quantity) {
      //var_dump("hay menos que 3 sticky posts");
      //var_dump($aside_get_posts_cantidad);
      //var_dump($aside_get_posts);
      //Hay menos posts stickies que los solicitados ($quantity). Rellenar los faltantes, con posts comunes. 
      //1. Primero llenamos con los stickies...
      foreach ($aside_get_posts as $sticky) {
        array_push($aside_posts, $sticky);
        array_push($excluded_sticky_main_id, $sticky->ID);
      }
      //2. Luego rellenamos los faltantes con posts comunes.
      $diff = $quantity - $aside_get_posts_cantidad;
      $extra_posts = get_posts_comunes(
        $diff,
        $excluded_sticky_main_id,
        null,
        null,
        null
      );
      foreach ($extra_posts->posts as $post_comun) {
        array_push($aside_posts, $post_comun);
      }
    }
    else {
      //hay 3 o más
      //Hay la cantidad requerida de posts stickies, o también puede que no haya ningún sticky, en cuyo caso todos los posts son comunes.
      foreach ($aside_get_posts as $post) {
        array_push($aside_posts, $post);
      }  
    }
    return $aside_posts; 
  }
}
?>
