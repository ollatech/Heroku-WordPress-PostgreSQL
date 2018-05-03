<?php

namespace Stencil\App;

use Stencil\Core\Template;

final class Helpers extends \Stencil_Loader {

    protected $includes = array(
        'app/helpers/wordpress',
        'app/helpers/posts',
        'app/helpers/post',
        'app/helpers/view',
    );

    public function init() {
        $template = Template::instance();

        //wordpress
        $wordpress = \Stencil\App\Helpers\Wordpress::instance();
        $template->add_helper('sidebar', array($wordpress, 'sidebar'));
        $template->add_helper('menu', array($wordpress, 'menu'));
        $template->add_helper('wp_option', array($wordpress, 'option'));

          //wordpress post
        $posts = \Stencil\App\Helpers\Posts::instance();
        $template->add_helper('posts', array($posts, 'posts'));
        $template->add_helper('posts_loop', array($posts, 'loop'));
        $template->add_helper('posts_item', array($posts, 'item'));
        $template->add_helper('posts_pagination', array($posts, 'pagination'));
        $template->add_helper('posts_filter', array($posts, 'filter'));

         //wordpress post
        $post = \Stencil\App\Helpers\Post::instance();
        $template->add_helper('post_title', array($post, 'title'));
        $template->add_helper('post_content', array($post, 'content'));

        



        //view
        $view = \Stencil\App\Helpers\View::instance();
        $template->add_helper('logo', array($view, 'logo'));


    }

    private static $instance;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->includes();
            self::$instance->init();
        }
        return self::$instance;
    }
    public function __clone() {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'stencil'), '1.6');
    }

    public function __wakeup() {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'stencil'), '1.6');
    }
}
