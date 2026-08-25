<?php get_header(); ?>
<header class="da-page-header"><div class="da-container"><h1><?php echo is_home() ? 'المدونة' : esc_html( get_the_archive_title() ?: 'المحتوى' ); ?></h1></div></header>
<div class="da-container da-content">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><article <?php post_class(); ?>><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?></article><?php endwhile; the_posts_pagination(); else : ?><p>لا يوجد محتوى حاليًا.</p><?php endif; ?>
</div>
<?php get_footer(); ?>
