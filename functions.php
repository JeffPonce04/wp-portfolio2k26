<?php
if (!defined('ABSPATH')) exit;

define('PORTFOLIO2K26_VERSION', '2.1.0');
define('PORTFOLIO2K26_CONTENT_VERSION', '2.0.0');

function portfolio2k26_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption', 'style', 'script'));
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'portfolio2k26')
    ));
}
add_action('after_setup_theme', 'portfolio2k26_setup');

function portfolio2k26_asset_url($path = '') {
    return trailingslashit(get_template_directory_uri()) . ltrim($path, '/');
}

function portfolio2k26_image_key($filename) {
    // Include the extension so files such as html.png and html.jpg have separate settings.
    return 'portfolio2k26_img_' . sanitize_title(basename((string) $filename));
}

function portfolio2k26_legacy_image_key($filename) {
    return 'portfolio2k26_img_' . sanitize_title(pathinfo(basename((string) $filename), PATHINFO_FILENAME));
}

function portfolio2k26_image_url($filename) {
    $filename = basename((string) $filename);
    $id = (int) get_theme_mod(portfolio2k26_image_key($filename), 0);
    if (!$id) $id = (int) get_theme_mod(portfolio2k26_legacy_image_key($filename), 0);

    if ($id) {
        $url = wp_get_attachment_image_url($id, 'full');
        if ($url) return $url;
    }

    return portfolio2k26_asset_url('assets/images/' . $filename);
}

function portfolio2k26_video_url() {
    $id = (int) get_theme_mod('portfolio2k26_presentation_video', 0);

    if ($id) {
        $url = wp_get_attachment_url($id);
        if ($url) return $url;
    }

    return portfolio2k26_asset_url('assets/images/trailer.mp4');
}

function portfolio2k26_video_mime() {
    $id = (int) get_theme_mod('portfolio2k26_presentation_video', 0);
    $mime = $id ? get_post_mime_type($id) : ''; 
    return $mime && strpos($mime, 'video/') === 0 ? $mime : 'video/mp4';
}

function portfolio2k26_video_poster_url() {
    $id = (int) get_theme_mod('portfolio2k26_presentation_poster', 0);
    if ($id) {
        $url = wp_get_attachment_image_url($id, 'full');
        if ($url) return $url;
    }
    return portfolio2k26_image_url('trailer-poster.jpg');
}

function portfolio2k26_image_shortcode($atts) {
    $atts = shortcode_atts(array('file' => ''), $atts, 'portfolio_image');
    if (!$atts['file']) return '';
    return esc_url(portfolio2k26_image_url($atts['file']));
}
add_shortcode('portfolio_image', 'portfolio2k26_image_shortcode');

function portfolio2k26_video_shortcode($atts) {
    return esc_url(portfolio2k26_video_url());
}
add_shortcode('portfolio_video', 'portfolio2k26_video_shortcode');

function portfolio2k26_video_mime_shortcode($atts) {
    return esc_attr(portfolio2k26_video_mime());
}
add_shortcode('portfolio_video_mime', 'portfolio2k26_video_mime_shortcode');

function portfolio2k26_video_poster_shortcode($atts) {
    return esc_url(portfolio2k26_video_poster_url());
}
add_shortcode('portfolio_video_poster', 'portfolio2k26_video_poster_shortcode');

function portfolio2k26_setting_shortcode($atts) {
    $atts = shortcode_atts(array('key' => '', 'default' => ''), $atts, 'portfolio_setting');

    $map = array(
        'contact_email' => 'portfolio2k26_contact_email',
        'contact_phone' => 'portfolio2k26_contact_phone',
        'contact_address' => 'portfolio2k26_contact_address'
    );

    if (!isset($map[$atts['key']])) return esc_html($atts['default']);
    return esc_html(get_theme_mod($map[$atts['key']], $atts['default']));
}
add_shortcode('portfolio_setting', 'portfolio2k26_setting_shortcode');

function portfolio2k26_content_default() {
    $file = get_template_directory() . '/template-default.html';
    return file_exists($file) ? file_get_contents($file) : '';
}

/**
 * On the first request after the 2.0 theme update, install the new supplied
 * portfolio markup. Preserve the previous database-edited HTML as a backup.
 */
function portfolio2k26_migrate_content() {
    $installed_content_version = get_option('portfolio2k26_content_version', '');
    if ($installed_content_version === PORTFOLIO2K26_CONTENT_VERSION) return;

    $default = portfolio2k26_content_default();
    if ($default === '') return;

    $old_content = get_option('portfolio2k26_html_content', null);
    if (is_string($old_content) && $old_content !== '') {
        $backup_suffix = $installed_content_version ? sanitize_key($installed_content_version) : 'pre-v2';
        $backup_key = 'portfolio2k26_html_backup_' . $backup_suffix;

        if (get_option($backup_key, null) === null) {
            add_option($backup_key, $old_content, '', false);
        }
    }

    update_option('portfolio2k26_html_content', $default, false);
    update_option('portfolio2k26_content_version', PORTFOLIO2K26_CONTENT_VERSION, false);
}
add_action('init', 'portfolio2k26_migrate_content', 1);

function portfolio2k26_extract_element_by_id($html, $id) {
    $pattern = '/<([a-z][a-z0-9]*)\b(?=[^>]*\bid=["\']' . preg_quote($id, '/') . '["\'])[^>]*>/i';
    if (!preg_match($pattern, $html, $m, PREG_OFFSET_CAPTURE)) return '';

    $tag = strtolower($m[1][0]);
    $start = $m[0][1];
    $open_len = strlen($m[0][0]);
    $depth = 1;
    $token_pattern = '/<\/?' . preg_quote($tag, '/') . '\b[^>]*>/i';

    preg_match_all($token_pattern, $html, $tokens, PREG_OFFSET_CAPTURE);
    foreach ($tokens[0] as $token) {
        if ($token[1] < $start + $open_len) continue;

        if (preg_match('/^<\//', $token[0])) {
            $depth--;
        } elseif (!preg_match('/\/>$/', $token[0])) {
            $depth++;
        }

        if ($depth === 0) {
            return substr($html, $start, $token[1] + strlen($token[0]) - $start);
        }
    }

    return '';
}

/**
 * Repair presentation markup in older saved page HTML without replacing the
 * administrator's existing content. This fixes the portrait poster and adds
 * the explicit play fallback for browsers that block delayed autoplay.
 */
function portfolio2k26_patch_presentation_markup($content) {
    if (!is_string($content) || $content === '') return $content;

    $content = str_replace(
        'poster="[portfolio_image file=\'grouoPhoto.png\']"',
        'poster="[portfolio_video_poster]"',
        $content
    );
    $content = preg_replace("~poster=[\"'][^\"']*(?:grouoPhoto|groupPhoto)\\.png[^\"']*[\"']~i", 'poster="[portfolio_video_poster]"', $content);
    $content = preg_replace("~(<video\\b[^>]*id=[\"']teamPresentationVideo[\"'][^>]*?)\\s+preload=[\"'][^\"']*[\"']~i", '$1 preload="metadata"', $content);
    $content = preg_replace("~(<source\\b[^>]*src=[\"']\\[portfolio_video\\][\"'][^>]*?)\\s+type=[\"']video/mp4[\"']~i", '$1 type="[portfolio_video_mime]"', $content);

    if (strpos($content, 'id="presentationVideoPlay"') === false && strpos($content, "id='presentationVideoPlay'") === false) {
        $button = '<button type="button" class="presentation-video-play" id="presentationVideoPlay" aria-label="Play team presentation"><span class="presentation-video-play-icon"><i class="fas fa-play"></i></span><span class="presentation-video-play-label">PLAY PRESENTATION</span></button>';
        $content = preg_replace("~(<video\\b[^>]*id=[\"']teamPresentationVideo[\"'][^>]*>.*?</video>)~is", '$1' . $button, $content, 1);
    }

    return $content;
}

function portfolio2k26_get_content() {
    $default = portfolio2k26_content_default();
    $saved = get_option('portfolio2k26_html_content', null);
    $content = ($saved === null || $saved === '') ? $default : $saved;
    $content = portfolio2k26_patch_presentation_markup($content);

    // Keep the main interaction containers available if an administrator removes one accidentally.
    $required_ids = array(
        'intro-loader',
        'profile-page',
        'skillsModal',
        'projectModal',
        'hackerPresentationModal'
    );

    foreach ($required_ids as $id) {
        if (strpos($content, 'id="' . $id . '"') !== false || strpos($content, "id='" . $id . "'") !== false) {
            continue;
        }

        $fragment = portfolio2k26_extract_element_by_id($default, $id);
        if ($fragment !== '') $content .= "\n" . $fragment;
    }

    return $content;
}

function portfolio2k26_print_runtime_config() {
    $images = array();
    foreach (portfolio2k26_image_files() as $file) {
        $images[$file] = portfolio2k26_image_url($file);
    }

    $config = array(
        'images' => $images,
        'video' => portfolio2k26_video_url(),
        'videoMime' => portfolio2k26_video_mime(),
        'videoPoster' => portfolio2k26_video_poster_url(),
        'imageBase' => portfolio2k26_asset_url('assets/images/')
    );

    echo '<script>';
    echo 'window.Portfolio2k26 = window.Portfolio2k26 || {};';
    echo 'window.Portfolio2k26.images = ' . wp_json_encode($config['images']) . ';';
    echo 'window.Portfolio2k26.video = ' . wp_json_encode($config['video']) . ';';
    echo 'window.Portfolio2k26.videoMime = ' . wp_json_encode($config['videoMime']) . ';';
    echo 'window.Portfolio2k26.videoPoster = ' . wp_json_encode($config['videoPoster']) . ';';
    echo 'window.Portfolio2k26.image = function(file){ return window.Portfolio2k26.images[file] || (' . wp_json_encode($config['imageBase']) . ' + file); };';
    echo '</script>';
}

function portfolio2k26_print_interactions() {
    $scripts_file = get_template_directory() . '/scripts-default.json';
    $default_scripts = file_exists($scripts_file) ? json_decode(file_get_contents($scripts_file), true) : array();

    $default_js_file = get_template_directory() . '/js-main-default.js';
    $default_js = file_exists($default_js_file) ? file_get_contents($default_js_file) : '';

    $installed_version = get_option('portfolio2k26_interaction_version', '');
    if ($installed_version !== PORTFOLIO2K26_VERSION) {
        $scripts = $default_scripts;
        $js = $default_js;
    } else {
        $saved = get_option('portfolio2k26_inline_scripts', null);
        $scripts = is_array($saved) ? $saved : $default_scripts;
        $js = get_option('portfolio2k26_main_js', null);
        if ($js === null || $js === '') $js = $default_js;
    }

    if (!is_array($scripts)) $scripts = array();

    $main_js_marker = '__PORTFOLIO2K26_MAIN_JS__';
    $main_js_printed = false;

    foreach ($scripts as $script) {
        if ($script === $main_js_marker) {
            if (is_string($js) && $js !== '') {
                echo "\n<script>\n" . $js . "\n</script>\n";
            }
            $main_js_printed = true;
            continue;
        }

        if (is_string($script) && $script !== '') {
            echo "\n<script>\n" . $script . "\n</script>\n";
        }
    }

    if (!$main_js_printed && is_string($js) && $js !== '') {
        echo "\n<script>\n" . $js . "\n</script>\n";
    }
}

/* All bundled image files, including legacy project-slider images still used by the profile/project data. */
function portfolio2k26_image_files() {
    return array(
        '214750c5-8e18-4737-89e4-335ba6011b8c.png',
        'adriane.png',
        'background.png',
        'blog1.jpg',
        'blog2.jpg',
        'blog3.jpg',
        'contact1.png',
        'contact2.png',
        'contact3.png',
        'contact4.png',
        'geo.png',
        'grouoPhoto.png',
        'html.png',
        'html.jpg',
        'html1.jpg',
        'html2.jpg',
        'html3.jpg',
        'html4.jpg',
        'it.avif',
        'java.jpg',
        'java1.jpg',
        'java2.jpg',
        'java3.jpg',
        'java4.jpg',
        'jefferson.png',
        'logo.png',
        'maria.png',
        'occ.jpg',
        'ponce.jpg',
        'project1.jpg',
        'project2.jpg',
        'project3.jpg',
        'python.jpg',
        'python1.jpg',
        'python2.jpg',
        'python3.jpg',
        'python4.jpg',
        'react.png',
        'react.jpg',
        'react1.jpg',
        'react2.jpg',
        'react3.jpg',
        'react4.jpg',
        'trailer-poster.jpg'
    );
}

function portfolio2k26_page_customizer_schema() {
    return array(
        'home' => array(
            'title' => __('Home Page', 'portfolio2k26'),
            'description' => __('Edit the landing-page headline, supporting text, and background.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_home_eyebrow' => array('label' => __('Hero first line', 'portfolio2k26'), 'type' => 'text', 'default' => 'WE BUILD THE', 'selector' => '#home .hero-title .title-small'),
                'portfolio2k26_home_title' => array('label' => __('Hero main title', 'portfolio2k26'), 'type' => 'text', 'default' => 'FUTURE', 'selector' => '#home .hero-title .title-large'),
                'portfolio2k26_home_subtitle' => array('label' => __('Hero subtitle', 'portfolio2k26'), 'type' => 'text', 'default' => 'ONE LINE OF CODE AT A TIME.', 'selector' => '#home .hero-subtitle'),
                'portfolio2k26_home_description' => array('label' => __('Hero description', 'portfolio2k26'), 'type' => 'textarea', 'default' => 'Driven by creativity, powered by technology, and united by innovation. We turn ideas into meaningful digital experiences.', 'selector' => '#home .hero-desc'),
                'portfolio2k26_page_bg_home' => array('label' => __('Home page background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#home .background-layer')
            ),
            'media' => array('logo.png', 'background.png', 'grouoPhoto.png')
        ),
        'about' => array(
            'title' => __('About Page', 'portfolio2k26'),
            'description' => __('Edit the team introduction and replace each member portrait.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_about_title' => array('label' => __('Page heading', 'portfolio2k26'), 'type' => 'heading', 'default' => 'About Us', 'selector' => '#about .section-title'),
                'portfolio2k26_about_subtitle' => array('label' => __('Page subtitle', 'portfolio2k26'), 'type' => 'textarea', 'default' => 'Four minds. One vision. Black & white clarity.', 'selector' => '#about .section-subtitle'),
                'portfolio2k26_page_bg_about' => array('label' => __('About page background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#about')
            ),
            'media' => array('maria.png', 'jefferson.png', 'geo.png', 'adriane.png')
        ),
        'memory_book' => array(
            'title' => __('Memory Book Page', 'portfolio2k26'),
            'description' => __('Customize the memory-book heading and introduction.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_memory_title' => array('label' => __('Page heading', 'portfolio2k26'), 'type' => 'heading', 'default' => 'Memory Book', 'selector' => '#profileBookGallery .profile-book-heading h2'),
                'portfolio2k26_memory_subtitle' => array('label' => __('Page introduction', 'portfolio2k26'), 'type' => 'textarea', 'default' => 'Every picture tells a story. Turn the pages and explore our journey.', 'selector' => '#profileBookGallery .profile-book-heading > p'),
                'portfolio2k26_page_bg_memory_book' => array('label' => __('Memory book background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#profileBookGallery')
            ),
            'media' => array()
        ),
        'gallery' => array(
            'title' => __('Gallery Page', 'portfolio2k26'),
            'description' => __('Customize the 3D gallery heading and the images used by its cards.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_gallery_title' => array('label' => __('Page heading', 'portfolio2k26'), 'type' => 'heading', 'default' => 'Our Gallery', 'selector' => '#gallery .gallery-3d-header h2'),
                'portfolio2k26_gallery_subtitle' => array('label' => __('Page subtitle', 'portfolio2k26'), 'type' => 'textarea', 'default' => 'Capturing Moments · Building Memories', 'selector' => '#gallery .gallery-3d-header p'),
                'portfolio2k26_page_bg_gallery' => array('label' => __('Gallery background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#gallery')
            ),
            'media' => array('contact1.png', 'contact2.png', 'contact3.png', 'contact4.png')
        ),
        'education' => array(
            'title' => __('Education Page', 'portfolio2k26'),
            'description' => __('Edit the school information and replace the school or department logos.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_education_title' => array('label' => __('Page heading', 'portfolio2k26'), 'type' => 'heading', 'default' => 'Our School', 'selector' => '#education .edu-title'),
                'portfolio2k26_education_subtitle' => array('label' => __('Page subtitle', 'portfolio2k26'), 'type' => 'textarea', 'default' => 'Where the journey of innovation began.', 'selector' => '#education .edu-subtitle'),
                'portfolio2k26_education_school' => array('label' => __('School name', 'portfolio2k26'), 'type' => 'text', 'default' => 'Opol Community College', 'selector' => '#education .edu-school-name span'),
                'portfolio2k26_education_degree' => array('label' => __('Program / degree', 'portfolio2k26'), 'type' => 'text', 'default' => 'Bachelor of Science in Information Technology', 'selector' => '#education .edu-degree'),
                'portfolio2k26_page_bg_education' => array('label' => __('Education background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#education')
            ),
            'media' => array('occ.jpg', 'it.avif')
        ),
        'projects' => array(
            'title' => __('Projects Page', 'portfolio2k26'),
            'description' => __('Customize the projects heading and replace project thumbnails and slider images.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_projects_title' => array('label' => __('Page heading', 'portfolio2k26'), 'type' => 'heading', 'default' => 'Featured Projects', 'selector' => '#projects .section-title'),
                'portfolio2k26_projects_subtitle' => array('label' => __('Page subtitle', 'portfolio2k26'), 'type' => 'textarea', 'default' => 'Explore our latest works built with modern tech.', 'selector' => '#projects .section-subtitle'),
                'portfolio2k26_page_bg_projects' => array('label' => __('Projects background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#projects')
            ),
            'media' => array('project1.jpg', 'project2.jpg', 'project3.jpg', 'html.png', 'html.jpg', 'html1.jpg', 'html2.jpg', 'html3.jpg', 'html4.jpg', 'java.jpg', 'java1.jpg', 'java2.jpg', 'java3.jpg', 'java4.jpg', 'python.jpg', 'python1.jpg', 'python2.jpg', 'python3.jpg', 'python4.jpg', 'react.png', 'react.jpg', 'react1.jpg', 'react2.jpg', 'react3.jpg', 'react4.jpg')
        ),
        'services' => array(
            'title' => __('Services Page', 'portfolio2k26'),
            'description' => __('Customize the services heading and supporting statement.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_services_title' => array('label' => __('Page heading', 'portfolio2k26'), 'type' => 'heading', 'default' => 'Our Services', 'selector' => '#services .section-title'),
                'portfolio2k26_services_subtitle' => array('label' => __('Page subtitle', 'portfolio2k26'), 'type' => 'textarea', 'default' => 'We deliver high-quality solutions across multiple platforms.', 'selector' => '#services .section-subtitle'),
                'portfolio2k26_page_bg_services' => array('label' => __('Services background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#services')
            ),
            'media' => array()
        ),
        'achievements' => array(
            'title' => __('Achievements Page', 'portfolio2k26'),
            'description' => __('Customize the achievements and statistics section.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_achievements_title' => array('label' => __('Page heading', 'portfolio2k26'), 'type' => 'heading', 'default' => 'Achievements & Statistics', 'selector' => '#achievements .section-title'),
                'portfolio2k26_achievements_subtitle' => array('label' => __('Page subtitle', 'portfolio2k26'), 'type' => 'textarea', 'default' => 'Numbers that reflect our dedication and hard work.', 'selector' => '#achievements .section-subtitle'),
                'portfolio2k26_page_bg_achievements' => array('label' => __('Achievements background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#achievements')
            ),
            'media' => array()
        ),
        'testimonials' => array(
            'title' => __('Testimonials Page', 'portfolio2k26'),
            'description' => __('Customize the testimonials heading and supporting statement.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_testimonials_title' => array('label' => __('Page heading', 'portfolio2k26'), 'type' => 'heading', 'default' => 'Client Testimonials', 'selector' => '#testimonials .section-title'),
                'portfolio2k26_testimonials_subtitle' => array('label' => __('Page subtitle', 'portfolio2k26'), 'type' => 'textarea', 'default' => 'What people say about working with us.', 'selector' => '#testimonials .section-subtitle'),
                'portfolio2k26_page_bg_testimonials' => array('label' => __('Testimonials background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#testimonials')
            ),
            'media' => array()
        ),
        'blog' => array(
            'title' => __('Blog Page', 'portfolio2k26'),
            'description' => __('Customize the articles heading and replace the three article thumbnails.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_blog_title' => array('label' => __('Page heading', 'portfolio2k26'), 'type' => 'heading', 'default' => 'Latest Articles', 'selector' => '#blog .section-title'),
                'portfolio2k26_blog_subtitle' => array('label' => __('Page subtitle', 'portfolio2k26'), 'type' => 'textarea', 'default' => 'Thoughts, tutorials, and news from our team.', 'selector' => '#blog .section-subtitle'),
                'portfolio2k26_page_bg_blog' => array('label' => __('Blog background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#blog')
            ),
            'media' => array('blog1.jpg', 'blog2.jpg', 'blog3.jpg')
        ),
        'facebook' => array(
            'title' => __('Facebook Follow Page', 'portfolio2k26'),
            'description' => __('Customize the social-photo strip heading.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_facebook_title' => array('label' => __('Section heading', 'portfolio2k26'), 'type' => 'text', 'default' => 'FOLLOW ON FACEBOOK', 'selector' => '#facebook-follow .container_contact > h2'),
                'portfolio2k26_page_bg_facebook' => array('label' => __('Facebook section background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#facebook-follow')
            ),
            'media' => array()
        ),
        'contact' => array(
            'title' => __('Contact Page', 'portfolio2k26'),
            'description' => __('Edit the contact heading and the public contact details used by the page.', 'portfolio2k26'),
            'fields' => array(
                'portfolio2k26_contact_title' => array('label' => __('Page heading', 'portfolio2k26'), 'type' => 'heading', 'default' => 'Contact Me', 'selector' => '#contact .section-title'),
                'portfolio2k26_contact_email' => array('label' => __('Contact email', 'portfolio2k26'), 'type' => 'text', 'default' => 'cmponce90@gmail.com', 'selector' => '#contact .row .card:nth-child(3) .info span'),
                'portfolio2k26_contact_phone' => array('label' => __('Contact phone', 'portfolio2k26'), 'type' => 'text', 'default' => '+63 970 898 6628', 'selector' => '#contact .row .card:nth-child(2) .info span'),
                'portfolio2k26_contact_address' => array('label' => __('Contact address', 'portfolio2k26'), 'type' => 'text', 'default' => 'El Salvador City', 'selector' => '#contact .row .card:nth-child(1) .info span'),
                'portfolio2k26_page_bg_contact' => array('label' => __('Contact page background image', 'portfolio2k26'), 'type' => 'background', 'selector' => '#contact')
            ),
            'media' => array()
        ),
        'presentation' => array(
            'title' => __('Presentation Screen', 'portfolio2k26'),
            'description' => __('Replace the cinematic team trailer and its widescreen preview poster.', 'portfolio2k26'),
            'fields' => array(),
            'media' => array()
        ),
        'other' => array(
            'title' => __('Additional Media', 'portfolio2k26'),
            'description' => __('Additional supplied assets retained for profile and legacy content.', 'portfolio2k26'),
            'fields' => array(),
            'media' => array('214750c5-8e18-4737-89e4-335ba6011b8c.png', 'ponce.jpg')
        )
    );
}

function portfolio2k26_customizer($wp_customize) {
    $wp_customize->add_panel('portfolio2k26_pages_panel', array(
        'title' => __('Portfolio Pages', 'portfolio2k26'),
        'priority' => 30,
        'description' => __('Customize each portfolio page section separately. Changes are applied to the matching section in the live preview.', 'portfolio2k26')
    ));

    $schema = portfolio2k26_page_customizer_schema();
    foreach ($schema as $page_id => $page) {
        $section_id = 'portfolio2k26_page_' . $page_id;
        $wp_customize->add_section($section_id, array(
            'title' => $page['title'],
            'description' => $page['description'],
            'panel' => 'portfolio2k26_pages_panel',
            'priority' => 10
        ));

        foreach ($page['fields'] as $setting_id => $field) {
            $type = $field['type'];
            if ($type === 'background') {
                $wp_customize->add_setting($setting_id, array(
                    'default' => 0,
                    'sanitize_callback' => 'absint',
                    'transport' => 'refresh'
                ));
                $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, $setting_id, array(
                    'label' => $field['label'],
                    'section' => $section_id,
                    'mime_type' => 'image'
                )));
                continue;
            }

            $sanitize = ($type === 'textarea') ? 'sanitize_textarea_field' : 'sanitize_text_field';
            $wp_customize->add_setting($setting_id, array(
                'default' => $field['default'],
                'sanitize_callback' => $sanitize,
                'transport' => 'postMessage'
            ));
            $wp_customize->add_control($setting_id, array(
                'label' => $field['label'],
                'section' => $section_id,
                'type' => ($type === 'textarea') ? 'textarea' : 'text'
            ));
        }

        foreach ($page['media'] as $filename) {
            $setting_id = portfolio2k26_image_key($filename);
            if (!$wp_customize->get_setting($setting_id)) {
                $wp_customize->add_setting($setting_id, array(
                    // Seed the new extension-specific setting from the old basename-only setting.
                    'default' => (int) get_theme_mod(portfolio2k26_legacy_image_key($filename), 0),
                    'sanitize_callback' => 'absint',
                    'transport' => 'refresh'
                ));
            }
            $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, $setting_id, array(
                'label' => sprintf(__('Replace %s', 'portfolio2k26'), $filename),
                'section' => $section_id,
                'mime_type' => 'image'
            )));
        }
    }

    // Keep the original global background override available under Home Page.
    $wp_customize->add_setting('portfolio2k26_background_override', array(
        'default' => 0,
        'sanitize_callback' => 'absint',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'portfolio2k26_background_override', array(
        'label' => __('Global site background image', 'portfolio2k26'),
        'section' => 'portfolio2k26_page_home',
        'mime_type' => 'image'
    )));

    $wp_customize->add_setting('portfolio2k26_presentation_video', array(
        'default' => 0,
        'sanitize_callback' => 'absint',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'portfolio2k26_presentation_video', array(
        'label' => __('Team presentation video (MP4)', 'portfolio2k26'),
        'section' => 'portfolio2k26_page_presentation',
        'mime_type' => 'video'
    )));

    $wp_customize->add_setting('portfolio2k26_presentation_poster', array(
        'default' => 0,
        'sanitize_callback' => 'absint',
        'transport' => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'portfolio2k26_presentation_poster', array(
        'label' => __('Presentation video poster image', 'portfolio2k26'),
        'section' => 'portfolio2k26_page_presentation',
        'mime_type' => 'image'
    )));
}
add_action('customize_register', 'portfolio2k26_customizer');

function portfolio2k26_page_customizer_runtime_config() {
    $config = array('fields' => array());
    foreach (portfolio2k26_page_customizer_schema() as $page) {
        foreach ($page['fields'] as $setting_id => $field) {
            if (empty($field['selector'])) continue;
            // Do not apply schema defaults over HTML that an administrator edited in the visual editor.
            $value = get_theme_mod($setting_id, null);
            if ($value === null || $value === false) continue;
            if ($field['type'] === 'background') {
                $value = $value ? wp_get_attachment_image_url((int) $value, 'full') : '';
            }
            $config['fields'][$setting_id] = array(
                'selector' => $field['selector'],
                'type' => $field['type'],
                'value' => $value
            );
        }
    }
    return $config;
}


function portfolio2k26_print_background_css() {
    $id = (int) get_theme_mod('portfolio2k26_background_override', 0);
    $url = $id ? wp_get_attachment_image_url($id, 'full') : portfolio2k26_image_url('background.png');
    echo '<style>:root{--portfolio2k26-background:url("' . esc_url($url) . '");}</style>';
}
add_action('wp_head', 'portfolio2k26_print_background_css', 99);

/* Enqueue the supplied portfolio styles and their dependencies in source order. */
function portfolio2k26_enqueue_assets() {
    wp_enqueue_style(
        'portfolio2k26-fonts',
        'https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&family=Montserrat:wght@400;500;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap',
        array(),
        null
    );
    wp_enqueue_style(
        'portfolio2k26-bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css',
        array(),
        '5.0.0-alpha1'
    );
    wp_enqueue_style(
        'portfolio2k26-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
    wp_enqueue_style(
        'portfolio2k26-aos',
        'https://unpkg.com/aos@next/dist/aos.css',
        array(),
        null
    );

    wp_enqueue_style(
        'portfolio2k26-theme',
        get_stylesheet_uri(),
        array('portfolio2k26-fonts', 'portfolio2k26-bootstrap', 'portfolio2k26-fontawesome', 'portfolio2k26-aos'),
        PORTFOLIO2K26_VERSION
    );

    $styles = array(
        'main' => 'css/main.css',
        'about' => 'css/about.css',
        'education' => 'css/education.css',
        'extra-sections' => 'css/extra-sections.css',
        'contact' => 'css/contact.css',
        'theme' => 'css/theme.css',
        'gallery-3d' => 'css/gallery-3d.css',
        'source-inline' => 'css/source-inline.css'
    );

    $dependency = 'portfolio2k26-theme';
    foreach ($styles as $handle => $path) {
        $style_handle = 'portfolio2k26-' . $handle;
        wp_enqueue_style($style_handle, portfolio2k26_asset_url($path), array($dependency), PORTFOLIO2K26_VERSION);
        $dependency = $style_handle;
    }

    wp_enqueue_script(
        'portfolio2k26-aos',
        'https://unpkg.com/aos@next/dist/aos.js',
        array(),
        null,
        false
    );

    wp_enqueue_script(
        'portfolio2k26-page-customizer',
        portfolio2k26_asset_url('js/page-customizer.js'),
        array(),
        PORTFOLIO2K26_VERSION,
        true
    );
    wp_localize_script('portfolio2k26-page-customizer', 'Portfolio2k26PageSettings', portfolio2k26_page_customizer_runtime_config());
}
add_action('wp_enqueue_scripts', 'portfolio2k26_enqueue_assets');

/* Dashboard editor: complete HTML, interaction-script JSON, and the main effects script. */
function portfolio2k26_admin_menu() {
    add_menu_page(
        'Portfolio2k26',
        'Portfolio2k26',
        'manage_options',
        'portfolio2k26',
        'portfolio2k26_admin_page',
        'dashicons-admin-customizer',
        25
    );
}
add_action('admin_menu', 'portfolio2k26_admin_menu');

function portfolio2k26_admin_page() {
    if (!current_user_can('manage_options')) return;

    $scripts_file = get_template_directory() . '/scripts-default.json';
    $default_scripts = file_exists($scripts_file) ? json_decode(file_get_contents($scripts_file), true) : array();

    $default_js_file = get_template_directory() . '/js-main-default.js';
    $default_js = file_exists($default_js_file) ? file_get_contents($default_js_file) : '';

    $installed_version = get_option('portfolio2k26_interaction_version', '');
    $use_saved_interactions = ($installed_version === PORTFOLIO2K26_VERSION);

    if (isset($_POST['portfolio2k26_save']) && check_admin_referer('portfolio2k26_save')) {
        $scripts_raw = wp_unslash($_POST['inline_scripts'] ?? '');
        $decoded = json_decode($scripts_raw, true);

        if (!is_array($decoded)) {
            echo '<div class="notice notice-error is-dismissible"><p>The interaction scripts were not saved because the JSON array is invalid. Correct the JSON and try again.</p></div>';
        } else {
            update_option('portfolio2k26_html_content', wp_unslash($_POST['html_content'] ?? ''), false);
            update_option('portfolio2k26_inline_scripts', $decoded, false);
            update_option('portfolio2k26_main_js', wp_unslash($_POST['main_js'] ?? ''), false);
            update_option('portfolio2k26_content_version', PORTFOLIO2K26_CONTENT_VERSION, false);
            update_option('portfolio2k26_interaction_version', PORTFOLIO2K26_VERSION, false);

            echo '<div class="notice notice-success is-dismissible"><p>Portfolio content and interaction code saved.</p></div>';
            $use_saved_interactions = true;
        }
    }

    $html = get_option('portfolio2k26_html_content', null);
    if ($html === null || $html === '') $html = portfolio2k26_content_default();
    $html = portfolio2k26_patch_presentation_markup($html);

    $saved_scripts = get_option('portfolio2k26_inline_scripts', null);
    $scripts = ($use_saved_interactions && is_array($saved_scripts)) ? $saved_scripts : $default_scripts;

    $saved_js = get_option('portfolio2k26_main_js', null);
    $main_js = ($use_saved_interactions && $saved_js !== null && $saved_js !== '') ? $saved_js : $default_js;

    echo '<div class="wrap">';
    echo '<h1>Portfolio2k26 Editor <small style="font-size:13px;color:#777;">v' . esc_html(PORTFOLIO2K26_VERSION) . '</small></h1>';
    echo '<p>The updated Quadra Tech portfolio is preloaded. Edit the HTML below while preserving IDs and class names used by the interactions. This update preserves your existing saved page HTML and repairs the presentation video markup without forcing a content reset.</p>';
    echo '<p><strong>Visual editing:</strong> Open Appearance → Customize, then use the front-end editor toolbar in the preview. Click text to edit it, an image to replace it, or the presentation video to choose a video from the WordPress Media Library.</p>';
    echo '<p><strong>Page-by-page customization:</strong> Open Appearance → Customize → Portfolio Pages. Each section has its own heading, description, background, and related media controls. The Presentation Screen section controls the MP4 video and its widescreen poster.</p>';
    echo '<form method="post">';
    wp_nonce_field('portfolio2k26_save');

    echo '<h2>Portfolio HTML / Text</h2>';
    echo '<textarea name="html_content" rows="26" style="width:100%;font:13px/1.5 monospace;">' . esc_textarea($html) . '</textarea>';

    echo '<h2>Interactive scripts and profile / gallery / project data (JSON array)</h2>';
    echo '<p class="description">Keep the <code>__PORTFOLIO2K26_MAIN_JS__</code> marker in the scripts array to preserve the original script loading order.</p>';
    echo '<textarea name="inline_scripts" rows="20" style="width:100%;font:13px/1.5 monospace;">' . esc_textarea(wp_json_encode($scripts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)) . '</textarea>';

    echo '<h2>Main interaction JavaScript</h2>';
    echo '<textarea name="main_js" rows="22" style="width:100%;font:13px/1.5 monospace;">' . esc_textarea($main_js) . '</textarea>';

    echo '<p><button class="button button-primary button-hero" type="submit" name="portfolio2k26_save" value="1">Save Changes</button></p>';
    echo '</form></div>';
}

/**
 * Restore theme-bundled asset URLs to shortcodes before storing front-end edits.
 * This keeps Customizer image/video overrides active on later page loads.
 */
function portfolio2k26_normalize_theme_media_urls($html) {
    foreach (portfolio2k26_image_files() as $file) {
        $shortcode = "[portfolio_image file='" . $file . "']";
        $urls = array(
            portfolio2k26_asset_url('assets/images/' . $file),
            portfolio2k26_image_url($file)
        );

        foreach (array_unique($urls) as $url) {
            if ($url) $html = str_replace($url, $shortcode, $html);
        }
    }

    $video_urls = array(
        portfolio2k26_asset_url('assets/images/trailer.mp4'),
        portfolio2k26_video_url()
    );
    foreach (array_unique($video_urls) as $url) {
        if ($url) $html = str_replace($url, '[portfolio_video]', $html);
    }

    $poster_urls = array(portfolio2k26_video_poster_url(), portfolio2k26_image_url('trailer-poster.jpg'));
    foreach (array_unique($poster_urls) as $url) {
        if ($url) $html = str_replace($url, '[portfolio_video_poster]', $html);
    }

    $html = str_replace('type="' . esc_attr(portfolio2k26_video_mime()) . '"', 'type="[portfolio_video_mime]"', $html);
    return $html;
}

function portfolio2k26_sanitize_frontend_html($html) {
    $allowed = wp_kses_allowed_html('post');

    // Extend the normal post allow-list for the supplied portfolio's semantic layout and media.
    $extra = array(
        'nav' => array('id' => true, 'class' => true, 'role' => true, 'aria-label' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'main' => array('id' => true, 'class' => true, 'role' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'section' => array('id' => true, 'class' => true, 'role' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'footer' => array('id' => true, 'class' => true, 'role' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'canvas' => array('id' => true, 'class' => true, 'width' => true, 'height' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'video' => array('id' => true, 'class' => true, 'src' => true, 'controls' => true, 'playsinline' => true, 'preload' => true, 'poster' => true, 'width' => true, 'height' => true, 'muted' => true, 'loop' => true, 'autoplay' => true, 'controlslist' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'source' => array('src' => true, 'type' => true, 'media' => true),
        'button' => array('type' => true, 'id' => true, 'class' => true, 'disabled' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'input' => array('type' => true, 'id' => true, 'class' => true, 'accept' => true, 'hidden' => true, 'placeholder' => true, 'value' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'label' => array('for' => true, 'id' => true, 'class' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'textarea' => array('id' => true, 'class' => true, 'rows' => true, 'placeholder' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'article' => array('id' => true, 'class' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'div' => array('id' => true, 'class' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'span' => array('id' => true, 'class' => true, 'style' => true, 'data-*' => true, 'aria-*' => true),
        'i' => array('class' => true, 'style' => true, 'aria-hidden' => true),
        'img' => array('src' => true, 'alt' => true, 'id' => true, 'class' => true, 'title' => true, 'style' => true, 'srcset' => true, 'sizes' => true, 'width' => true, 'height' => true, 'loading' => true, 'decoding' => true, 'data-*' => true, 'aria-*' => true)
    );

    foreach ($extra as $tag => $attributes) {
        $allowed[$tag] = isset($allowed[$tag]) && is_array($allowed[$tag])
            ? array_merge($allowed[$tag], $attributes)
            : $attributes;
    }

    // Add standard data/ARIA attributes to the remaining WordPress-approved tags.
    foreach ($allowed as $tag => $attributes) {
        if (is_array($attributes)) {
            $allowed[$tag] = array_merge($attributes, array('data-*' => true, 'aria-*' => true, 'hidden' => true, 'role' => true, 'title' => true, 'style' => true, 'id' => true, 'class' => true));
        }
    }

    return wp_kses($html, $allowed);
}

/* Front-end visual editor: available in the logged-in administrator's Customizer preview. */
function portfolio2k26_frontend_editor_assets() {
    if (is_admin() || !is_customize_preview() || !is_user_logged_in() || !current_user_can('manage_options')) return;

    wp_enqueue_media();
    wp_enqueue_script(
        'portfolio2k26-frontend-editor',
        portfolio2k26_asset_url('js/frontend-editor.js'),
        array('jquery', 'media-views'),
        PORTFOLIO2K26_VERSION,
        true
    );
    wp_localize_script('portfolio2k26-frontend-editor', 'Portfolio2k26Editor', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('portfolio2k26_frontend_save'),
        'saved' => 'Portfolio changes saved.',
        'error' => 'Unable to save. Please try again.',
        'imageTitle' => 'Choose a replacement image',
        'imageButton' => 'Use this image',
        'videoTitle' => 'Choose a replacement video',
        'videoButton' => 'Use this video'
    ));
    wp_enqueue_style(
        'portfolio2k26-frontend-editor',
        portfolio2k26_asset_url('css/frontend-editor.css'),
        array(),
        PORTFOLIO2K26_VERSION
    );
}
add_action('wp_enqueue_scripts', 'portfolio2k26_frontend_editor_assets', 100);

function portfolio2k26_frontend_save() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Permission denied.'), 403);
    }

    check_ajax_referer('portfolio2k26_frontend_save', 'nonce');

    $html = isset($_POST['html']) ? wp_unslash($_POST['html']) : '';
    if ($html === '') {
        wp_send_json_error(array('message' => 'No page content received.'), 400);
    }

    // Sanitize the rendered HTML while media URLs are still normal URLs, then
    // restore only known bundled/Customizer URLs to their trusted shortcodes.
    $html = portfolio2k26_sanitize_frontend_html($html);
    $html = portfolio2k26_normalize_theme_media_urls($html);

    update_option('portfolio2k26_html_content', $html, false);
    update_option('portfolio2k26_content_version', PORTFOLIO2K26_CONTENT_VERSION, false);

    wp_send_json_success(array('message' => 'Saved.'));
}
add_action('wp_ajax_portfolio2k26_frontend_save', 'portfolio2k26_frontend_save');
