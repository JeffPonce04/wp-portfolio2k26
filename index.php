<?php get_header(); ?>
<div id="portfolio2k26-editable-root">
<main class="portfolio2k26-fallback">
<?php if (have_posts()) : while (have_posts()) : the_post(); the_content(); endwhile; endif; ?>
</main>
</div>
<?php get_footer(); ?>
