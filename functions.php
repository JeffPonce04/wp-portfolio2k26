<?php
if (!defined('ABSPATH')) exit;

define('PORTFOLIO2K26_VERSION', '1.0.7');

function portfolio2k26_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form','comment-form','gallery','caption','style','script'));
    register_nav_menus(array('primary' => __('Primary Navigation','portfolio2k26')));
}
add_action('after_setup_theme','portfolio2k26_setup');

function portfolio2k26_asset_url($path='') {
    return trailingslashit(get_template_directory_uri()) . ltrim($path,'/');
}

function portfolio2k26_image_key($filename) {
    return 'portfolio2k26_img_' . sanitize_title(pathinfo(basename($filename), PATHINFO_FILENAME));
}

function portfolio2k26_image_url($filename) {
    $id=(int)get_theme_mod(portfolio2k26_image_key($filename),0);
    if ($id) {
        $url=wp_get_attachment_image_url($id,'full');
        if ($url) return $url;
    }
    return portfolio2k26_asset_url('assets/images/'.basename($filename));
}

function portfolio2k26_image_shortcode($atts) {
    $atts=shortcode_atts(array('file'=>''),$atts,'portfolio_image');
    if (!$atts['file']) return '';
    return esc_url(portfolio2k26_image_url($atts['file']));
}
add_shortcode('portfolio_image','portfolio2k26_image_shortcode');

function portfolio2k26_setting_shortcode($atts) {
    $atts=shortcode_atts(array('key'=>'','default'=>''),$atts,'portfolio_setting');
    $map=array(
        'contact_email'=>'portfolio2k26_contact_email',
        'contact_phone'=>'portfolio2k26_contact_phone',
        'contact_address'=>'portfolio2k26_contact_address'
    );
    if (!isset($map[$atts['key']])) return esc_html($atts['default']);
    return esc_html(get_theme_mod($map[$atts['key']],$atts['default']));
}
add_shortcode('portfolio_setting','portfolio2k26_setting_shortcode');


function portfolio2k26_content_default() {
    $file=get_template_directory().'/template-default.html';
    return file_exists($file) ? file_get_contents($file) : '';
}
function portfolio2k26_extract_element_by_id($html, $id) {
    $pattern='/<([a-z][a-z0-9]*)\b(?=[^>]*\bid=["\']'.preg_quote($id,'/').'["\'])[^>]*>/i';
    if (!preg_match($pattern,$html,$m,PREG_OFFSET_CAPTURE)) return '';
    $tag=strtolower($m[1][0]);
    $start=$m[0][1];
    $open_len=strlen($m[0][0]);
    $depth=1;
    $token_pattern='/<\/?'.preg_quote($tag,'/').'\b[^>]*>/i';
    preg_match_all($token_pattern,$html,$tokens,PREG_OFFSET_CAPTURE);
    foreach ($tokens[0] as $token) {
        if ($token[1] < $start + $open_len) continue;
        if (preg_match('/^<\//',$token[0])) $depth--;
        elseif (!preg_match('/\/>$/',$token[0])) $depth++;
        if ($depth===0) return substr($html,$start,$token[1]+strlen($token[0])-$start);
    }
    return '';
}

function portfolio2k26_get_content() {
    $default=portfolio2k26_content_default();
    $saved=get_option('portfolio2k26_html_content',null);
    $content=($saved === null || $saved === '') ? $default : $saved;

    // Preserve essential interactive sections even if an older saved page omitted them.
    $required_ids=array('intro-loader','skillsModal','projectModal','profile-page');
    foreach ($required_ids as $id) {
        if (strpos($content,'id="'.$id.'"') !== false || strpos($content,"id='".$id."'") !== false) continue;
        $fragment=portfolio2k26_extract_element_by_id($default,$id);
        if ($fragment !== '') $content .= "\n".$fragment;
    }
    return $content;
}

function portfolio2k26_print_runtime_config() {
    $images=array();
    foreach (portfolio2k26_image_files() as $file) $images[$file]=portfolio2k26_image_url($file);
    $config=array('images'=>$images,'imageBase'=>portfolio2k26_asset_url('assets/images/'));
    echo '<script>window.Portfolio2k26 = window.Portfolio2k26 || {}; window.Portfolio2k26.images = '.wp_json_encode($config['images']).'; window.Portfolio2k26.image = function(file){ return window.Portfolio2k26.images[file] || ('.wp_json_encode($config['imageBase']).' + file); };</script>';
}
function portfolio2k26_print_interactions() {
    $scripts_file=get_template_directory().'/scripts-default.json';
    $default_scripts=file_exists($scripts_file) ? json_decode(file_get_contents($scripts_file),true) : array();
    $default_js_file=get_template_directory().'/js-main-default.js';
    $default_js=file_exists($default_js_file) ? file_get_contents($default_js_file) : '';

    // Older database-saved interaction code can override newer bundled behavior.
    // Use the verified bundled interactions until the site is running this theme version.
    $installed_version=get_option('portfolio2k26_interaction_version','');
    if ($installed_version !== PORTFOLIO2K26_VERSION) {
        $scripts=$default_scripts;
        $js=$default_js;
    } else {
        $saved=get_option('portfolio2k26_inline_scripts',null);
        $scripts=is_array($saved) ? $saved : $default_scripts;
        $js=get_option('portfolio2k26_main_js',null);
        if ($js === null || $js === '') $js=$default_js;
    }

    if (!is_array($scripts)) $scripts=array();
    foreach ($scripts as $script) {
        if (is_string($script) && $script !== '') echo "\n<script>\n".$script."\n</script>\n";
    }
    if (is_string($js) && $js !== '') echo "\n<script>\n".$js."\n</script>\n";
}

/* Original images ship with the theme; each can be replaced in the Customizer. */
function portfolio2k26_image_files() {
    return array('adriane.png','background.png','blog1.jpg','blog2.jpg','blog3.jpg','contact1.png','contact2.png','contact3.png','contact4.png','geo.png','grouoPhoto.png','html.jpg','it.avif','java.jpg','jefferson.png','maria.png','occ.jpg','ponce.jpg','python.jpg','react.jpg','html1.jpg','html2.jpg','html3.jpg','html4.jpg','java1.jpg','java2.jpg','java3.jpg','java4.jpg','python1.jpg','python2.jpg','python3.jpg','python4.jpg','react1.jpg','react2.jpg','react3.jpg','react4.jpg');
}
function portfolio2k26_customizer($wp_customize) {
    $wp_customize->add_section('portfolio2k26_images',array(
        'title'=>__('Portfolio Images','portfolio2k26'),
        'priority'=>31,
        'description'=>__('All original images are already included. Select a replacement only when you want to change one.','portfolio2k26')
    ));
    foreach (portfolio2k26_image_files() as $file) {
        $key=portfolio2k26_image_key($file);
        $wp_customize->add_setting($key,array('default'=>0,'sanitize_callback'=>'absint'));
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize,$key,array(
            'label'=>sprintf(__('Replace %s','portfolio2k26'),$file),
            'section'=>'portfolio2k26_images',
            'mime_type'=>'image'
        )));
    }
    $wp_customize->add_section('portfolio2k26_details',array(
        'title'=>__('Portfolio Details','portfolio2k26'),
        'priority'=>32
    ));
    $fields=array(
        'portfolio2k26_contact_email'=>array('Contact email','cmponce90@gmail.com'),
        'portfolio2k26_contact_phone'=>array('Contact phone','+63 970 898 6628'),
        'portfolio2k26_contact_address'=>array('Contact address','El Salvador City')
    );
    foreach($fields as $id=>$field) {
        $wp_customize->add_setting($id,array('default'=>$field[1],'sanitize_callback'=>'sanitize_text_field'));
        $wp_customize->add_control($id,array('label'=>__($field[0],'portfolio2k26'),'section'=>'portfolio2k26_details','type'=>'text'));
    }
    $bgkey=portfolio2k26_image_key('background.png');
    $wp_customize->add_setting('portfolio2k26_background_override',array('default'=>0,'sanitize_callback'=>'absint'));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize,'portfolio2k26_background_override',array(
        'label'=>__('Background image','portfolio2k26'),'section'=>'portfolio2k26_images','mime_type'=>'image'
    )));
}
add_action('customize_register','portfolio2k26_customizer');

function portfolio2k26_print_background_css() {
    $id=(int)get_theme_mod('portfolio2k26_background_override',0);
    $url=$id ? wp_get_attachment_image_url($id,'full') : portfolio2k26_image_url('background.png');
    echo '<style>:root{--portfolio2k26-background:url("'.esc_url($url).'");}</style>';
}
add_action('wp_head','portfolio2k26_print_background_css',99);

/* WordPress media/editor dependencies and original libraries. */
function portfolio2k26_enqueue_assets() {
    wp_enqueue_style('portfolio2k26-fonts','https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&family=Montserrat:wght@400;500;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap',array(),null);
    wp_enqueue_style('portfolio2k26-bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css',array(),'5.0.0-alpha1');
    wp_enqueue_style('portfolio2k26-fontawesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',array(),'6.4.0');
    wp_enqueue_style('portfolio2k26-aos','https://unpkg.com/aos@next/dist/aos.css',array(),null);
    wp_enqueue_style('portfolio2k26-style',get_stylesheet_uri(),array(),'1.0.0');
    wp_enqueue_script('portfolio2k26-aos','https://unpkg.com/aos@next/dist/aos.js',array(),null,false);
}
add_action('wp_enqueue_scripts','portfolio2k26_enqueue_assets');

/* Admin editing: full original HTML plus original inline interactions. */
function portfolio2k26_admin_menu() {
    add_menu_page('Portfolio2k26','Portfolio2k26','manage_options','portfolio2k26','portfolio2k26_admin_page','dashicons-admin-customizer',25);
}
add_action('admin_menu','portfolio2k26_admin_menu');

function portfolio2k26_admin_page() {
    if (!current_user_can('manage_options')) return;
    $default_scripts=json_decode(file_get_contents(get_template_directory().'/scripts-default.json'),true);
    $default_js=file_get_contents(get_template_directory().'/js-main-default.js');
    if (isset($_POST['portfolio2k26_save']) && check_admin_referer('portfolio2k26_save')) {
        update_option('portfolio2k26_html_content',wp_unslash($_POST['html_content'] ?? ''),false);
        $scripts_raw=wp_unslash($_POST['inline_scripts'] ?? '');
        $decoded=json_decode($scripts_raw,true);
        if (is_array($decoded)) update_option('portfolio2k26_inline_scripts',$decoded,false);
        update_option('portfolio2k26_main_js',wp_unslash($_POST['main_js'] ?? ''),false);
        update_option('portfolio2k26_interaction_version',PORTFOLIO2K26_VERSION,false);
        echo '<div class="notice notice-success is-dismissible"><p>Portfolio content and interaction code saved.</p></div>';
    }
    $html=get_option('portfolio2k26_html_content',null);
    if ($html === null) $html=portfolio2k26_content_default();
    $scripts=get_option('portfolio2k26_inline_scripts',null);
    if (!is_array($scripts)) $scripts=$default_scripts;
    $main_js=get_option('portfolio2k26_main_js',null);
    if ($main_js === null) $main_js=$default_js;
    echo '<div class="wrap"><h1>Portfolio2k26 Editor</h1>';
    echo '<p>The original portfolio is preloaded. Edit the HTML text below to change visible content. Preserve IDs and class names to keep animations, buttons, navigation and modals working. Replace images under Appearance → Customize → Portfolio Images.</p>';
    echo '<form method="post">'; wp_nonce_field('portfolio2k26_save');
    echo '<h2>Portfolio HTML / Text</h2><textarea name="html_content" rows="26" style="width:100%;font:13px/1.5 monospace;">'.esc_textarea($html).'</textarea>';
    echo '<h2>Interactive scripts and profile/modal data (JSON array)</h2><textarea name="inline_scripts" rows="18" style="width:100%;font:13px/1.5 monospace;">'.esc_textarea(wp_json_encode($scripts,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)).'</textarea>';
    echo '<h2>Main interaction JavaScript</h2><textarea name="main_js" rows="22" style="width:100%;font:13px/1.5 monospace;">'.esc_textarea($main_js).'</textarea>';
    echo '<p><button class="button button-primary button-hero" type="submit" name="portfolio2k26_save" value="1">Save Changes</button></p></form></div>';
}


/* Front-end click-to-edit mode for administrators.
 * This is intentionally loaded on the normal public site, not just in Customizer preview.
 * It is available only inside the WordPress Customizer preview to logged-in administrators.
 */
function portfolio2k26_frontend_editor_assets() {
    if (is_admin() || !is_customize_preview() || !is_user_logged_in() || !current_user_can('manage_options')) return;
    wp_enqueue_media();
    wp_enqueue_script(
        'portfolio2k26-frontend-editor',
        portfolio2k26_asset_url('js/frontend-editor.js'),
        array('jquery'),
        PORTFOLIO2K26_VERSION,
        true
    );
    wp_localize_script('portfolio2k26-frontend-editor','Portfolio2k26Editor',array(
        'ajaxUrl'=>admin_url('admin-ajax.php'),
        'nonce'=>wp_create_nonce('portfolio2k26_frontend_save'),
        'saved'=>'Portfolio changes saved.',
        'error'=>'Unable to save. Please try again.'
    ));
    wp_enqueue_style('portfolio2k26-frontend-editor',portfolio2k26_asset_url('css/frontend-editor.css'),array(),PORTFOLIO2K26_VERSION);
}
add_action('wp_enqueue_scripts','portfolio2k26_frontend_editor_assets',100);

function portfolio2k26_frontend_save() {
    if (!current_user_can('manage_options')) wp_send_json_error(array('message'=>'Permission denied.'),403);
    check_ajax_referer('portfolio2k26_frontend_save','nonce');
    $html=isset($_POST['html']) ? wp_unslash($_POST['html']) : '';
    if ($html === '') wp_send_json_error(array('message'=>'No page content received.'),400);
    update_option('portfolio2k26_html_content',wp_kses_post($html),false);
    wp_send_json_success(array('message'=>'Saved.'));
}
add_action('wp_ajax_portfolio2k26_frontend_save','portfolio2k26_frontend_save');
