<?php
if (!defined('ABSPATH')) exit;
function my_portfolio_enqueue_assets() {
    $uri = get_template_directory_uri();
    wp_enqueue_style('my-portfolio-fonts', 'https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&family=Montserrat:wght@400;500;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap', [], null);
    wp_enqueue_style('my-portfolio-aos', 'https://unpkg.com/aos@next/dist/aos.css', [], null);
    wp_enqueue_style('my-portfolio-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', [], '6.4.0');
    wp_enqueue_style('my-portfolio-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], '5.3.3');
    $styles = ['homepage','main','about','education','extra-sections','contact','theme'];
    $deps = ['my-portfolio-bootstrap'];
    foreach ($styles as $name) {
        $handle = 'my-portfolio-'.$name;
        wp_enqueue_style($handle, $uri.'/assets/css/'.$name.'.css', $deps, filemtime(get_theme_file_path('/assets/css/'.$name.'.css')));
        $deps = [$handle];
    }
    wp_enqueue_style(
        'my-portfolio-modal-overrides',
        $uri.'/assets/css/modal-overrides.css',
        $deps,
        filemtime(get_theme_file_path('/assets/css/modal-overrides.css'))
    );
    wp_enqueue_script('my-portfolio-aos', 'https://unpkg.com/aos@next/dist/aos.js', [], null, true);
    wp_enqueue_script('my-portfolio-main', $uri.'/assets/js/main.js', ['my-portfolio-aos'], '1.0.2', true);
    wp_localize_script('my-portfolio-main', 'MyPortfolio', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'adminPostUrl' => admin_url('admin-post.php'),
        'contactNonce' => wp_create_nonce('my_portfolio_contact'),
        'assetBase' => $uri.'/assets/images',
        'projects' => my_portfolio_get_project_data(),
        'members' => my_portfolio_get_members_data(),
    ]);
}
add_action('wp_enqueue_scripts', 'my_portfolio_enqueue_assets');

function my_portfolio_get_project_data() {
    $items = [];
    $query = new WP_Query(['post_type'=>'project','posts_per_page'=>-1,'post_status'=>'publish']);
    while ($query->have_posts()) {
        $query->the_post();
        $id = get_the_ID();
        $image_ids = array_filter(array_map('absint', explode(',', (string)get_post_meta($id, '_mp_slider_images', true))));
        $images = [];
        foreach ($image_ids as $image_id) {
            $url = wp_get_attachment_image_url($image_id, 'large');
            if ($url) $images[] = $url;
        }
        if (!$images && has_post_thumbnail()) $images[] = get_the_post_thumbnail_url($id, 'large');
        $items[get_post_field('post_name', $id)] = [
            'title'=>get_the_title(),
            'lang'=>get_post_meta($id, '_mp_language_icon', true),
            'desc'=>get_post_meta($id, '_mp_description', true) ?: get_the_excerpt(),
            'features'=>preg_split('/\r\n|\r|\n/', (string)get_post_meta($id, '_mp_features', true), -1, PREG_SPLIT_NO_EMPTY),
            'images'=>$images,
        ];
    }
    wp_reset_postdata();
    return $items;
}


function my_portfolio_get_members_data() {
    $members = [];
    for ($i = 1; $i <= 4; $i++) {
        $key = 'team_'.$i.'_';
        $name = mp_editor_get($key.'name');
        $photo = mp_editor_get($key.'photo');
        $skills_raw = mp_editor_get($key.'skills');
        $skills = json_decode($skills_raw, true);
        if (!is_array($skills)) $skills = [];
        $tags = array_filter(array_map('trim', explode(',', mp_editor_get($key.'tags'))));
        $members[['maria','jefferson','geo','adriane'][$i-1]] = [
            'name' => $name,
            'role' => mp_editor_get($key.'role'),
            'photo' => $photo ?: get_theme_file_uri('/assets/images/'.['maria.png','jefferson.png','geo.png','adriane.png'][$i-1]),
            'skills' => $skills,
            'tags' => array_values($tags),
        ];
    }
    return $members;
}

add_action('wp_enqueue_scripts', function() {
    if (!is_front_page()) return;
    $background = mp_editor_get('hero_background');
    if ($background) {
        $css = '.dev-portfolio-wrapper{background-image:radial-gradient(circle at 70% 50%,rgba(20,20,20,.35) 0%,rgba(5,5,5,.9) 80%),url("'.esc_url($background).'") !important;background-size:cover;background-position:center;background-repeat:no-repeat;}';
        wp_add_inline_style('my-portfolio-homepage', $css);
    }
}, 30);
