<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<header class="da-page-header"><div class="da-container"><h1><?php the_title(); ?></h1></div></header><div class="da-container da-content"><article <?php post_class(); ?>><?php the_content(); ?></article></div>
<?php endwhile; ?>
<?php get_footer(); ?>
