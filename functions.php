<?php
if (!defined('ABSPATH')) exit;

require_once get_theme_file_path('/inc/theme-setup.php');
require_once get_theme_file_path('/inc/enqueue.php');
require_once get_theme_file_path('/inc/customizer.php');
require_once get_theme_file_path('/inc/portfolio-editor.php');

function my_portfolio_register_content_types() {
    $types = [
        'project' => ['Projects', 'Project', ['title','editor','thumbnail','excerpt']],
        'testimonial' => ['Testimonials', 'Testimonial', ['title','editor','thumbnail']],
        'service' => ['Services', 'Service', ['title','editor','thumbnail']],
        'achievement_stat' => ['Achievement Stats', 'Achievement Stat', ['title']],
    ];
    foreach ($types as $slug => $data) {
        register_post_type($slug, [
            'labels' => ['name' => $data[0], 'singular_name' => $data[1]],
            'public' => true, 'show_in_rest' => true, 'has_archive' => true,
            'menu_icon' => 'dashicons-portfolio',
            'supports' => $data[2],
            'rewrite' => ['slug' => $slug],
        ]);
    }
}
add_action('init', 'my_portfolio_register_content_types');

function my_portfolio_register_meta_boxes() {
    $fields = [
        'project' => ['language_icon'=>'Language icon class','slider_images'=>'Slider image IDs (comma-separated)','description'=>'Project description','features'=>'Features (one per line)'],
        'testimonial' => ['author'=>'Author name','role'=>'Author role','quote'=>'Quote','avatar'=>'Avatar attachment ID'],
        'service' => ['icon_class'=>'Icon class','service_title'=>'Service title','service_desc'=>'Description','tech_tags'=>'Technology tags (comma-separated)'],
        'achievement_stat' => ['count'=>'Count','suffix'=>'Suffix','label'=>'Label','icon'=>'Icon class'],
    ];
    foreach ($fields as $post_type => $items) {
        add_meta_box('my_portfolio_fields', 'Portfolio details', function($post) use ($items) {
            wp_nonce_field('my_portfolio_save_meta', 'my_portfolio_meta_nonce');
            foreach ($items as $key => $label) {
                $value = get_post_meta($post->ID, '_mp_'.$key, true);
                echo '<p><label style="display:block;font-weight:600" for="mp_'.esc_attr($key).'">'.esc_html($label).'</label>';
                if (in_array($key, ['description','features','quote','tech_tags'], true)) {
                    echo '<textarea style="width:100%" rows="3" id="mp_'.esc_attr($key).'" name="mp_'.esc_attr($key).'">'.esc_textarea($value).'</textarea>';
                } else {
                    echo '<input style="width:100%" id="mp_'.esc_attr($key).'" name="mp_'.esc_attr($key).'" value="'.esc_attr($value).'">';
                }
                echo '</p>';
            }
        }, $post_type, 'normal', 'default');
    }
}
add_action('add_meta_boxes', 'my_portfolio_register_meta_boxes');

function my_portfolio_save_meta($post_id) {
    if (!isset($_POST['my_portfolio_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['my_portfolio_meta_nonce'])), 'my_portfolio_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    $keys = ['language_icon','slider_images','description','features','author','role','quote','avatar','icon_class','service_title','service_desc','tech_tags','count','suffix','label','icon'];
    foreach ($keys as $key) {
        if (isset($_POST['mp_'.$key])) update_post_meta($post_id, '_mp_'.$key, sanitize_textarea_field(wp_unslash($_POST['mp_'.$key])));
    }
}
add_action('save_post', 'my_portfolio_save_meta');

function my_portfolio_contact_submit() {
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['contact_nonce'])), 'my_portfolio_contact')) {
        wp_die('Security check failed.', 403);
    }
    $name = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));
    if (!$name || !is_email($email) || !$message) {
        wp_safe_redirect(add_query_arg('contact', 'invalid', wp_get_referer() ?: home_url('/')));
        exit;
    }
    $subject = sprintf('Portfolio contact from %s', $name);
    $body = "Name: {$name}\nEmail: {$email}\n\n{$message}";
    $sent = wp_mail(get_option('admin_email'), $subject, $body, ['Reply-To: '.$name.' <'.$email.'>']);
    wp_safe_redirect(add_query_arg('contact', $sent ? 'sent' : 'error', wp_get_referer() ?: home_url('/')));
    exit;
}
add_action('admin_post_nopriv_my_portfolio_contact', 'my_portfolio_contact_submit');
add_action('admin_post_my_portfolio_contact', 'my_portfolio_contact_submit');
