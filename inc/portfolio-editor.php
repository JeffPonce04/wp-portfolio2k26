<?php
if (!defined('ABSPATH')) exit;

function mp_editor_defaults() {
    return [
        'hero_small' => ['Hero small heading','WE BUILD THE','text','Home'],
        'hero_large' => ['Hero main heading','FUTURE','text','Home'],
        'hero_subtitle' => ['Hero subtitle','ONE LINE OF CODE AT A TIME.','text','Home'],
        'hero_description' => ['Hero description','"Driven by creativity, powered by technology, and united by innovation. We turn ideas into meaningful digital experiences."','textarea','Home'],
        'hero_marquee' => ['Scrolling marquee text','Driven by creativity, powered by technology, and united by innovation. We turn ideas into meaningful digital experiences.','textarea','Home'],
        'hero_button1' => ['First button label','About us','text','Home'],
        'hero_button2' => ['Second button label','Contact us','text','Home'],
        'hero_background' => ['Hero background image','', 'image','Home'],
        'hero_team_image' => ['Hero foreground/team image','', 'image','Home'],

        'about_tag' => ['Section tag','/ our team','text','About'],
        'about_title' => ['About section title','About Us','text','About'],
        'nav_logo' => ['Navigation logo text','PERSONAL PORTFOLIO','text','Home'],
        'about_title' => ['Section title','About Us','text','About'],
        'about_subtitle' => ['Section subtitle','Four minds. One vision. Black & white clarity.','text','About'],
        'about_quote' => ['Footer quote','“Design is intelligence made visible.”','text','About'],
        'team_1_name' => ['Member 1 name','Maria Blanquera','text','Team'],
        'team_1_role' => ['Member 1 role','PROJECT MANAGER','text','Team'],
        'team_1_desc' => ['Member 1 description','Leads the team, manages project tasks, and ensures that all activities are completed according to the project goals and deadlines.','textarea','Team'],
        'team_1_photo' => ['Member 1 photo','', 'image','Team'],
        'team_1_skills' => ['Member 1 skills JSON','[{"name":"Project Planning","percent":95},{"name":"Team Leadership","percent":92},{"name":"Agile & Scrum","percent":90},{"name":"Risk Management","percent":88},{"name":"Communication","percent":96}]','textarea','Team'],
        'team_1_tags' => ['Member 1 skill tags (comma-separated)','Jira, Trello, Asana, Slack, Notion, MS Project','text','Team'],
        'team_2_name' => ['Member 2 name','Jefferson Ponce','text','Team'],
        'team_2_role' => ['Member 2 role','PROGRAMMER','text','Team'],
        'team_2_desc' => ['Member 2 description','Responsible for designing, coding, and developing the software to ensure that all system features function properly.','textarea','Team'],
        'team_2_photo' => ['Member 2 photo','', 'image','Team'],
        'team_2_skills' => ['Member 2 skills JSON','[{"name":"JavaScript / TypeScript","percent":94},{"name":"HTML & CSS","percent":96},{"name":"React / Node.js","percent":90},{"name":"PHP & MySQL","percent":85},{"name":"UI / UX Implementation","percent":88}]','textarea','Team'],
        'team_2_tags' => ['Member 2 skill tags','React, Node.js, PHP, MySQL, Tailwind, Git, Figma','text','Team'],
        'team_3_name' => ['Member 3 name','Geoffrey Bermudez','text','Team'],
        'team_3_role' => ['Member 3 role','ANALYST','text','Team'],
        'team_3_desc' => ['Member 3 description',"Gathers and evaluates information to identify user requirements and ensure that the system effectively addresses the project's objectives.",'textarea','Team'],
        'team_3_photo' => ['Member 3 photo','', 'image','Team'],
        'team_3_skills' => ['Member 3 skills JSON','[{"name":"Requirement Analysis","percent":93},{"name":"Data Analysis","percent":90},{"name":"System Design","percent":87},{"name":"Documentation","percent":91},{"name":"Problem Solving","percent":94}]','textarea','Team'],
        'team_3_tags' => ['Member 3 skill tags','SQL, Excel, Power BI, Visio, Lucidchart, Python','text','Team'],
        'team_4_name' => ['Member 4 name','Adriane Manggay','text','Team'],
        'team_4_role' => ['Member 4 role','TECHNICAL WRITER','text','Team'],
        'team_4_desc' => ['Member 4 description','Prepares clear and accurate technical documentation, user manuals, and guides to help users understand and operate the system.','textarea','Team'],
        'team_4_photo' => ['Member 4 photo','', 'image','Team'],
        'team_4_skills' => ['Member 4 skills JSON','[{"name":"Technical Documentation","percent":96},{"name":"User Manuals","percent":94},{"name":"Content Editing","percent":90},{"name":"Research & Accuracy","percent":92},{"name":"Information Architecture","percent":88}]','textarea','Team'],
        'team_4_tags' => ['Member 4 skill tags','Markdown, Confluence, MadCap Flare, GitBook, Snagit, Word','text','Team'],

        'education_title' => ['Education title','My Education','text','Education'],
        'education_subtitle' => ['Education subtitle','Where the journey of innovation began.','text','Education'],
        'education_school' => ['School name','Opol Community College','text','Education'],
        'education_degree' => ['Degree','Bachelor of Science in Information Technology','text','Education'],
        'education_period' => ['School year','2023 — 2027','text','Education'],
        'education_location' => ['School location','Opol Misamis Oriental, Philippines','text','Education'],
        'education_logo1' => ['School logo','', 'image','Education'],
        'education_logo2' => ['Department logo','', 'image','Education'],
        'education_description1' => ['Education description 1','The Information Technology Department is a hub of innovation where students learn to design, build, and maintain the digital systems of tomorrow. Our curriculum blends theoretical foundations with hands-on practice in programming, networking, database management, and modern software development.','textarea','Education'],
        'education_description2' => ['Education description 2','Through capstone projects, industry partnerships, and real-world simulations, the department equips students with the technical expertise and critical thinking needed to thrive in the fast-paced world of technology. We believe in learning by building — every line of code is a step toward shaping the future.','textarea','Education'],
        'contact_title' => ['Contact section title','Contact Me','text','Contact'],
        'contact_address' => ['Address','El Salvador City','text','Contact'],
        'contact_phone' => ['Phone','+63 970 898 6628','text','Contact'],
        'contact_email' => ['Email','cmponce90@gmail.com','text','Contact'],
        'contact_messenger' => ['Messenger name','Jefferson Ponce','text','Contact'],
        'footer_name' => ['Footer name','Jefferson Ponce','text','Footer'],
        'footer_copyright' => ['Copyright line','Copyright @2025','text','Footer'],
        'footer_project_link' => ['Footer link text','Final Project','text','Footer'],
        'footer_rights' => ['Footer rights text','All Rights Reserved.','text','Footer'],
        'contact_gallery_1' => ['Contact gallery image 1','', 'image','Contact'],
        'contact_gallery_2' => ['Contact gallery image 2','', 'image','Contact'],
        'contact_gallery_3' => ['Contact gallery image 3','', 'image','Contact'],
        'contact_gallery_4' => ['Contact gallery image 4','', 'image','Contact'],
        'project_1_title'=>['Project 1 title','Inventory Management System','text','Projects'],
        'project_1_desc'=>['Project 1 card description','A robust desktop application for managing stock, suppliers, and sales built with JavaFX and MySQL.','textarea','Projects'],
        'project_1_image'=>['Project 1 card image','', 'image','Projects'],
        'project_2_title'=>['Project 2 title','AI Chatbot Assistant','text','Projects'],
        'project_2_desc'=>['Project 2 card description','An intelligent chatbot using Natural Language Processing to answer customer queries automatically.','textarea','Projects'],
        'project_2_image'=>['Project 2 card image','', 'image','Projects'],
        'project_3_title'=>['Project 3 title','E-Commerce Landing Page','text','Projects'],
        'project_3_desc'=>['Project 3 card description','A fully responsive and interactive landing page for a modern fashion brand.','textarea','Projects'],
        'project_3_image'=>['Project 3 card image','', 'image','Projects'],
        'project_4_title'=>['Project 4 title','Task Management Dashboard','text','Projects'],
        'project_4_desc'=>['Project 4 card description','A dynamic single-page application for tracking tasks with drag-and-drop functionality.','textarea','Projects'],
        'project_4_image'=>['Project 4 card image','', 'image','Projects'],
        'service_1_title'=>['Service 1 title','Web Development','text','Services'],
        'service_1_desc'=>['Service 1 description','Building fast, responsive, and scalable web applications using modern frameworks.','textarea','Services'],
        'service_2_title'=>['Service 2 title','Mobile Development','text','Services'],
        'service_2_desc'=>['Service 2 description','Creating cross-platform mobile apps that deliver a seamless native experience.','textarea','Services'],
        'service_3_title'=>['Service 3 title','Game Development','text','Services'],
        'service_3_desc'=>['Service 3 description','Designing and developing engaging 2D and 3D games for various platforms.','textarea','Services'],
        'service_4_title'=>['Service 4 title','Backend & API','text','Services'],
        'service_4_desc'=>['Service 4 description','Building secure, high-performance server-side logic and RESTful APIs.','textarea','Services'],
        'stat_1_count'=>['Statistic 1 number','120','text','Achievements'],
        'stat_1_label'=>['Statistic 1 label','Projects Completed','text','Achievements'],
        'stat_2_count'=>['Statistic 2 number','85','text','Achievements'],
        'stat_2_label'=>['Statistic 2 label','Happy Clients','text','Achievements'],
        'stat_3_count'=>['Statistic 3 number','15','text','Achievements'],
        'stat_3_label'=>['Statistic 3 label','Awards Won','text','Achievements'],
        'stat_4_count'=>['Statistic 4 number','500000','text','Achievements'],
        'stat_4_label'=>['Statistic 4 label','Lines of Code','text','Achievements'],
        'testimonial_1_quote'=>['Testimonial 1 quote','The team delivered our e-commerce platform ahead of schedule. Their attention to detail and coding standards are top-notch.','textarea','Testimonials'],
        'testimonial_1_author'=>['Testimonial 1 author','Sarah Jenkins','text','Testimonials'],
        'testimonial_1_role'=>['Testimonial 1 role','CEO, TrendStore','text','Testimonials'],
        'testimonial_2_quote'=>['Testimonial 2 quote','Working with Jefferson and his team was a breeze. They understood our vision and built a mobile app that exceeded our expectations.','textarea','Testimonials'],
        'testimonial_2_author'=>['Testimonial 2 author','Mark Villanueva','text','Testimonials'],
        'testimonial_2_role'=>['Testimonial 2 role','Founder, FoodieApp','text','Testimonials'],
        'testimonial_3_quote'=>['Testimonial 3 quote','Their technical documentation and testing process are incredibly thorough. We felt confident from start to finish.','textarea','Testimonials'],
        'testimonial_3_author'=>['Testimonial 3 author','Emily Chen','text','Testimonials'],
        'testimonial_3_role'=>['Testimonial 3 role','CTO, InnovateLab','text','Testimonials'],
        'blog_1_title'=>['Blog 1 title','Why React Remains the Top Choice for Frontend in 2025','text','Blog'],
        'blog_1_desc'=>['Blog 1 description','Exploring the new features and ecosystem updates that keep React at the forefront of web development.','textarea','Blog'],
        'blog_1_image'=>['Blog 1 image','', 'image','Blog'],
        'blog_2_title'=>['Blog 2 title','The Power of Minimalist UI in Modern Web Applications','text','Blog'],
        'blog_2_desc'=>['Blog 2 description','How simplifying designs can drastically improve user experience and conversion rates.','textarea','Blog'],
        'blog_2_image'=>['Blog 2 image','', 'image','Blog'],
        'blog_3_title'=>['Blog 3 title',"Building Your First AI Model with Python: A Beginner's Guide",'text','Blog'],
        'blog_3_desc'=>['Blog 3 description','A step-by-step tutorial on leveraging Python libraries to create a simple predictive model.','textarea','Blog'],
        'blog_3_image'=>['Blog 3 image','', 'image','Blog'],
        'projects_tag'=>['Projects section tag','/ portfolio','text','Section headings'],
        'projects_heading'=>['Projects section heading','Featured Projects','text','Section headings'],
        'projects_subtitle'=>['Projects subtitle','Explore our latest works built with modern tech.','text','Section headings'],
        'services_tag'=>['Services section tag','/ what we do','text','Section headings'],
        'services_heading'=>['Services section heading','Our Services','text','Section headings'],
        'services_subtitle'=>['Services subtitle','We deliver high-quality solutions across multiple platforms.','text','Section headings'],
        'achievements_tag'=>['Achievements section tag','/ milestones','text','Section headings'],
        'achievements_heading'=>['Achievements section heading','Achievements & Statistics','text','Section headings'],
        'achievements_subtitle'=>['Achievements subtitle','Numbers that reflect our dedication and hard work.','text','Section headings'],
        'testimonials_tag'=>['Testimonials section tag','/ feedback','text','Section headings'],
        'testimonials_heading'=>['Testimonials section heading','Client Testimonials','text','Section headings'],
        'testimonials_subtitle'=>['Testimonials subtitle','What people say about working with us.','text','Section headings'],
        'blog_tag'=>['Blog section tag','/ insights','text','Section headings'],
        'blog_heading'=>['Blog section heading','Latest Articles','text','Section headings'],
        'blog_subtitle'=>['Blog subtitle','Thoughts, tutorials, and news from our team.','text','Section headings'],
        'facebook_heading'=>['Social gallery heading','FOLLOW ON FACEBOOK','text','Contact'],
        'facebook_handle'=>['Social gallery handle','@Jefferson_Ponce','text','Contact'],
        'project_1_language'=>['Project 1 language label','Java','text','Projects'],
        'project_2_language'=>['Project 2 language label','Python','text','Projects'],
        'project_3_language'=>['Project 3 language label','HTML/CSS/JS','text','Projects'],
        'project_4_language'=>['Project 4 language label','React JS','text','Projects'],
        'service_1_tags'=>['Service 1 technology tags','HTML/CSS, JavaScript, React, Node.js, PHP','text','Services'],
        'service_2_tags'=>['Service 2 technology tags','React Native, Flutter, Swift, Kotlin','text','Services'],
        'service_3_tags'=>['Service 3 technology tags','Unity, C#, C++, Godot','text','Services'],
        'service_4_tags'=>['Service 4 technology tags','Python, Java, Node.js, MySQL','text','Services'],
        'blog_1_category'=>['Blog 1 category','Development','text','Blog'],
        'blog_2_category'=>['Blog 2 category','Design','text','Blog'],
        'blog_3_category'=>['Blog 3 category','Python','text','Blog'],
        'blog_1_date'=>['Blog 1 date','May 15, 2025','text','Blog'],
        'blog_2_date'=>['Blog 2 date','April 28, 2025','text','Blog'],
        'blog_3_date'=>['Blog 3 date','April 10, 2025','text','Blog'],
        'social_facebook'=>['Facebook profile URL','#','text','Social links'],
        'social_instagram'=>['Instagram profile URL','#','text','Social links'],
        'social_telegram'=>['Telegram profile URL','#','text','Social links'],
        'social_github'=>['GitHub profile URL','#','text','Social links'],
        'edu_highlight_1'=>['Education highlight 1','Programming','text','Education'],
        'edu_highlight_2'=>['Education highlight 2','Networking','text','Education'],
        'edu_highlight_3'=>['Education highlight 3','Database','text','Education'],
        'edu_highlight_4'=>['Education highlight 4','Cybersecurity','text','Education'],
        'edu_highlight_5'=>['Education highlight 5','Web & Mobile','text','Education'],
        'edu_stat_1'=>['Education statistic 1','4','text','Education'],
        'edu_stat_2'=>['Education statistic 2','40','text','Education'],
        'edu_stat_3'=>['Education statistic 3','15','text','Education'],
        'edu_stat_4'=>['Education statistic 4','3','text','Education'],
        'edu_stat_label_1'=>['Education statistic label 1','Years','text','Education'],
        'edu_stat_label_2'=>['Education statistic label 2','Courses','text','Education'],
        'edu_stat_label_3'=>['Education statistic label 3','Projects','text','Education'],
        'edu_stat_label_4'=>['Education statistic label 4','Awards','text','Education'],
        'testimonial_1_avatar'=>['Testimonial 1 avatar','', 'image','Testimonials'],
        'testimonial_2_avatar'=>['Testimonial 2 avatar','', 'image','Testimonials'],
        'testimonial_3_avatar'=>['Testimonial 3 avatar','', 'image','Testimonials'],
    ];
}
function mp_editor_get($key) {
    $all = get_option('mp_portfolio_content', []);
    $defs = mp_editor_defaults();
    return isset($all[$key]) && $all[$key] !== '' ? $all[$key] : ($defs[$key][1] ?? '');
}
function mp_editor_register() {
    register_setting('mp_portfolio_editor_group', 'mp_portfolio_content', [
        'sanitize_callback' => function($input) {
            $clean = [];
            foreach (mp_editor_defaults() as $key => $field) {
                $value = isset($input[$key]) ? wp_unslash($input[$key]) : '';
                if ($field[2] === 'image') $clean[$key] = esc_url_raw($value);
                elseif ($field[2] === 'textarea') $clean[$key] = sanitize_textarea_field($value);
                else $clean[$key] = sanitize_text_field($value);
            }
            return $clean;
        }
    ]);
}
add_action('admin_init', 'mp_editor_register');

function mp_editor_menu() {
    add_menu_page('Portfolio Editor','Portfolio Editor','edit_theme_options','mp-portfolio-editor','mp_editor_page','dashicons-edit-page',3);
}
add_action('admin_menu','mp_editor_menu');

function mp_editor_admin_assets($hook) {
    if ($hook !== 'toplevel_page_mp-portfolio-editor') return;
    wp_enqueue_media();
    wp_add_inline_script('jquery-core', "
    jQuery(function($){
      $('.mp-image-select').on('click', function(e){
        e.preventDefault(); var button=$(this), input=button.siblings('input.mp-image-url'), preview=button.siblings('.mp-image-preview');
        var frame=wp.media({title:'Choose portfolio image',button:{text:'Use this image'},multiple:false});
        frame.on('select',function(){var item=frame.state().get('selection').first().toJSON();input.val(item.url).trigger('change');preview.html('<img src=\"'+item.url+'\" style=\"max-width:180px;height:auto;display:block;margin-top:8px\">');});
        frame.open();
      });
      $('.mp-image-clear').on('click',function(e){e.preventDefault();var wrap=$(this).closest('.mp-image-field');wrap.find('input').val('');wrap.find('.mp-image-preview').empty();});
    });");
}
add_action('admin_enqueue_scripts','mp_editor_admin_assets');

function mp_editor_page() {
    if (!current_user_can('edit_theme_options')) return;
    $fields = mp_editor_defaults();
    $groups = [];
    foreach ($fields as $key=>$field) $groups[$field[3]][$key]=$field;
    echo '<div class="wrap"><h1>Portfolio Editor</h1><p>Edit the visible content and images of your portfolio here. Keep the design and modal behavior intact. Use Projects, Services, Testimonials and Achievement Stats in the left menu to manage those repeating entries.</p>';
    echo '<form method="post" action="options.php">';
    settings_fields('mp_portfolio_editor_group');
    foreach ($groups as $group=>$items) {
        echo '<h2>'.esc_html($group).'</h2><table class="form-table" role="presentation"><tbody>';
        foreach ($items as $key=>$field) {
            [$label,$default,$type] = $field;
            $value = mp_editor_get($key);
            echo '<tr><th scope="row"><label for="mpc_'.esc_attr($key).'">'.esc_html($label).'</label></th><td>';
            if ($type === 'image') {
                echo '<div class="mp-image-field"><input class="regular-text mp-image-url" id="mpc_'.esc_attr($key).'" name="mp_portfolio_content['.esc_attr($key).']" value="'.esc_attr($value).'" placeholder="Select an image from Media Library" style="width: min(520px,100%)"> <button class="button mp-image-select">Choose image</button> <button class="button mp-image-clear">Clear</button><div class="mp-image-preview">'.($value ? '<img src="'.esc_url($value).'" style="max-width:180px;height:auto;display:block;margin-top:8px">' : '').'</div></div>';
            } elseif ($type === 'textarea') {
                echo '<textarea class="large-text" rows="4" id="mpc_'.esc_attr($key).'" name="mp_portfolio_content['.esc_attr($key).']">'.esc_textarea($value).'</textarea>';
                if (substr($key, -7) === '_skills') echo '<p class="description">Skills must be valid JSON, for example: [{"name":"Planning","percent":90}]</p>';
            } else {
                echo '<input class="regular-text" id="mpc_'.esc_attr($key).'" name="mp_portfolio_content['.esc_attr($key).']" value="'.esc_attr($value).'">';
            }
            echo '</td></tr>';
        }
        echo '</tbody></table>';
    }
    submit_button('Save Portfolio Changes');
    echo '</form><hr><h2>Manage repeating content</h2><p>Use the Projects, Services, Testimonials, and Achievement Stats menus to add, edit, reorder (where supported), or remove those entries. Use Appearance → Menus to edit navigation links.</p></div>';
}
