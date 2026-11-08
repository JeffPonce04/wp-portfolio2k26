<?php get_header(); ?><main class="container">
<?php while (have_posts()) : the_post(); ?><article <?php post_class(); ?>><h1><?php the_title(); ?></h1><p><?php echo esc_html(get_the_date()); ?></p><?php the_post_thumbnail('large'); ?><div><?php the_content(); ?></div></article><?php endwhile; ?>
</main><?php get_footer(); ?>
