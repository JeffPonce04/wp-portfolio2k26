<?php
/* Template Name: Portfolio Contact Page */
get_header();
?>
<main class="container portfolio-inner-page">
<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
<h1><?php the_title(); ?></h1>
<?php the_content(); ?>
</article>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
