<?php
class Translation {
    // Main Navbar
    public $learn_more_about_genexus;
    public $back_to_genexus;
    public $blog;
    public $categories;
    public $search;
    public $recent_posts;
    public $subscrible_blog_title;
    public $subscrible_blog_description;
    public $all_posts;
    public $back_to_top;
    public $posts;

    // set language
    function set_language($lang) {
        if($lang == 'es') {

            // Spanish
            $this->learn_more_about_genexus = 'Conoce más sobre GeneXus';
            $this->back_to_genexus = 'Vovler a genexus.com';
            $this->blog = 'Blog';
            $this->categories = 'Categorías';
            $this->search= 'Buscar';
            $this->you_searched_for= 'Usted buscó';
            $this->no_match= 'Su busqueda no arrojó ningun resultado. Busque algo diferente.';
            $this->recent_posts= 'Posts Recientes';
            $this->subscrible_blog_title= 'Suscríbete al blog vía email';
            $this->subscrible_blog_description= 'Ingresa tu dirección de correo para suscribirte a este blog y recibir notificaciones de nuevos posts por email.';
            $this->all_posts= 'Todos los posts';
            $this->back_to_top= 'Volver al incio';
            $this->posts= 'Posts';
            $this->four04_main_text= 'Oops. La página que estás buscando no existe.';
            $this->four04_secondary_text= 'Es posible que hayas escrito mal la dirección o que la página se haya movido.';
            $this->four04_button_text= 'Ir a la página principal';

        } else if ($lang =='pt-br') {

            // Portuguese
            $this->learn_more_about_genexus = 'Aprenda mais sobre GeneXus';
            $this->back_to_genexus = 'Voltar para genexus.com';
            $this->blog = 'Blog';
            $this->categories = 'Categorias';
            $this->search = 'Procurar';
            $this->you_searched_for= 'Você pesquisou por';
            $this->no_match= 'Sua pesquisa não encontrou nenhuma postagem. Tente uma pesquisa diferente.';
            $this->recent_posts= 'Postagens recentes';
            $this->subscrible_blog_title= 'Inscreva-se no blog por e-mail';
            $this->subscrible_blog_description= 'Digite seu endereço de e-mail para se inscrever neste blog e receber notificações de novos posts por e-mail.';
            $this->all_posts= 'Todas os posts';
            $this->back_to_top= 'Voltar ao início';
            $this->posts= 'Posts';
            $this->four04_main_text= 'Opa. A página que você está procurando não existe.';
            $this->four04_secondary_text= 'Você pode ter digitado incorretamente o endereço ou a página pode ter sido movida.';
            $this->four04_button_text= 'Vá para a página inicial';

        } else {

            // English
           $this->learn_more_about_genexus = 'Learn more about GeneXus';
           $this->back_to_genexus = 'Vovler a genexus.com';
           $this->blog = 'Blog';
           $this->categories = 'Categories';
           $this->search = 'Search';
           $this->you_searched_for= 'You searched for';
           $this->no_match= 'Your search did not match any post. Try a different search.';
           $this->recent_posts= 'Recent posts';
           $this->subscrible_blog_title= 'Subscribe to blog via email';
           $this->subscrible_blog_description= 'Enter your email address to subscribe to this blog and receive notifications of new posts by email.';
           $this->all_posts= 'All posts';
           $this->back_to_top= 'Back to top';
           $this->posts= 'Posts';
           $this->four04_main_text= 'Oops. The page you\'re looking for doesn\'t exist.';
           $this->four04_secondary_text= 'You may have mistyped the address or the page may have moved.';
           $this->four04_button_text= 'Go to home page';
           
        }
    }
}
?>