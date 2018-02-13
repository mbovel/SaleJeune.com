<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
		<time datetime="<?= esc_attr( get_the_date( 'c' ) ); ?>"
		      itemprop="datePublished"><?php the_date(); ?></time>

		<h1><a href="<?php the_permalink() ?>" itemprop="url"><?php the_title(); ?></a></h1>

		<?php the_content( 'Lire la suite...' ); ?>
	</article>

<?php endwhile; endif; ?>
<?php get_footer(); ?>
