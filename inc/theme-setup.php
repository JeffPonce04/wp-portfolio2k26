<?php
if (!defined('ABSPATH')) exit;
function my_portfolio_setup() {
    load_theme_textdomain('my-portfolio', get_template_directory().'/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('editor-styles');
    register_nav_menus(['primary' => __('Primary Menu', 'my-portfolio')]);
}
add_action('after_setup_theme', 'my_portfolio_setup');
function my_portfolio_widgets_init() {
    register_sidebar(['name'=>__('Sidebar','my-portfolio'),'id'=>'sidebar-1','before_widget'=>'<section class="widget">','after_widget'=>'</section>','before_title'=>'<h2>','after_title'=>'</h2>']);
    register_sidebar(['name'=>__('Footer','my-portfolio'),'id'=>'footer-1','before_widget'=>'<section class="footer-widget">','after_widget'=>'</section>','before_title'=>'<h2>','after_title'=>'</h2>']);
}
add_action('widgets_init', 'my_portfolio_widgets_init');
