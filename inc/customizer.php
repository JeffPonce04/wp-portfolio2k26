<?php
if (!defined('ABSPATH')) exit;
function my_portfolio_customize_register($wp_customize) {
    $wp_customize->add_section('my_portfolio_identity', ['title'=>__('Portfolio identity','my-portfolio'),'priority'=>30]);
    $wp_customize->add_setting('my_portfolio_logo_text', ['default'=>'PERSONAL PORTFOLIO','sanitize_callback'=>'sanitize_text_field']);
    $wp_customize->add_control('my_portfolio_logo_text', ['label'=>__('Navigation logo text','my-portfolio'),'section'=>'my_portfolio_identity','type'=>'text']);
}
add_action('customize_register','my_portfolio_customize_register');
