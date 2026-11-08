<?php
/**
 * Run once: wp eval-file wp-content/themes/my-portfolio-theme/inc/migrate.php
 * Seeds starter CPT records. Existing titles are skipped.
 */
if (!defined('ABSPATH')) exit;
$seed = [
 'project' => [
  ['Inventory Management System','Java','A desktop application for managing stock, suppliers, and sales.',"Real-time stock monitoring\nSupplier management\nSales reporting"],
  ['AI Chatbot Assistant','Python','An NLP chatbot for answering customer queries.',"Natural language understanding\nFAQ automation\nConversation tracking"],
  ['E-Commerce Landing Page','HTML/CSS/JS','A responsive landing page for a fashion brand.',"Responsive layout\nInteractive galleries\nSEO structure"],
  ['Task Management Dashboard','React JS','A dashboard for tracking tasks and workflows.',"Task tracking\nDrag-and-drop workflow\nResponsive dashboard"],
 ],
 'service' => [
  ['Web Development','fa-globe','Building responsive web applications.','HTML/CSS, JavaScript, React, Node.js, PHP'],
  ['Mobile Development','fa-mobile-alt','Creating cross-platform mobile applications.','React Native, Flutter, Swift, Kotlin'],
  ['Game Development','fa-gamepad','Designing engaging 2D and 3D games.','Unity, C#, C++, Godot'],
  ['Backend & API','fa-server','Building server-side logic and REST APIs.','Python, Java, Node.js, MySQL'],
 ],
 'achievement_stat' => [
  ['Projects Completed','120','','fa-project-diagram'],
  ['Happy Clients','85','','fa-smile'],
  ['Awards Won','15','','fa-award'],
  ['Lines of Code','500000','+','fa-code'],
 ],
 'testimonial' => [
  ['Sarah Jenkins','CEO, TrendStore','The team delivered our e-commerce platform ahead of schedule. Their attention to detail and coding standards are top-notch.'],
  ['Mark Villanueva','Founder, FoodieApp','Working with Jefferson and his team was a breeze. They understood our vision and built a mobile app that exceeded our expectations.'],
  ['Emily Chen','CTO, InnovateLab','Their technical documentation and testing process are incredibly thorough. We felt confident from start to finish.'],
 ],
];
foreach ($seed as $type => $items) {
 foreach ($items as $item) {
  if (get_page_by_title($item[0], OBJECT, $type)) continue;
  $id = wp_insert_post(['post_type'=>$type,'post_status'=>'publish','post_title'=>$item[0]]);
  if (!$id || is_wp_error($id)) continue;
  if ($type === 'project') {
   update_post_meta($id, '_mp_language_icon', $item[1]);
   update_post_meta($id, '_mp_description', $item[2]);
   update_post_meta($id, '_mp_features', $item[3]);
  } elseif ($type === 'service') {
   update_post_meta($id, '_mp_icon_class', $item[1]);
   update_post_meta($id, '_mp_service_title', $item[0]);
   update_post_meta($id, '_mp_service_desc', $item[2]);
   update_post_meta($id, '_mp_tech_tags', $item[3]);
  } elseif ($type === 'achievement_stat') {
   update_post_meta($id, '_mp_label', $item[0]);
   update_post_meta($id, '_mp_count', $item[1]);
   update_post_meta($id, '_mp_suffix', $item[2]);
   update_post_meta($id, '_mp_icon', $item[3]);
  } else {
   update_post_meta($id, '_mp_author', $item[0]);
   update_post_meta($id, '_mp_role', $item[1]);
   update_post_meta($id, '_mp_quote', $item[2]);
  }
 }
}
echo "Portfolio starter content imported.\n";
