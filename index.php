<?php get_header(); ?>

<main class="site-main wrap" style="padding:80px 0;min-height:60vh;">
	<?php if ( have_posts() ) : ?>
		<div class="blog-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<article class="blog-card">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="blog-figure">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'ini-blog' ); ?></a>
						</div>
					<?php endif; ?>
					<div class="blog-meta"><?php echo get_the_date(); ?></div>
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<p><?php the_excerpt(); ?></p>
				</article>
			<?php endwhile; ?>
		</div>
		<?php ini_dental_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No posts found.', 'ini-dental' ); ?></p>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
