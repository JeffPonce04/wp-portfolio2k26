<?php get_header(); ?>
<main class="container">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>><h1><?php the_title(); ?></h1><div><?php the_content(); ?></div></article>
<?php endwhile; the_posts_pagination(); else : ?><p><?php esc_html_e('No content found.', 'my-portfolio'); ?></p><?php endif; ?>
</main><?php get_footer(); ?>
