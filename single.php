<?php get_header(); ?>

<main class="site-main wrap" style="padding:80px 0;min-height:60vh;">
	<div style="max-width:800px;margin:0 auto;">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div style="border-radius:8px;overflow:hidden;margin-bottom:36px;">
						<?php the_post_thumbnail( 'large', [ 'style' => 'width:100%;height:auto;display:block;' ] ); ?>
					</div>
				<?php endif; ?>

				<div class="blog-meta" style="margin-bottom:14px;">
					<?php echo get_the_date(); ?> &bull; <?php the_category( ', ' ); ?>
				</div>

				<h1 style="font-size:36px;font-weight:700;margin:0 0 28px;line-height:1.2;"><?php the_title(); ?></h1>

				<div class="entry-content" style="color:#4a5868;line-height:1.8;">
					<?php the_content(); ?>
				</div>

				<div style="margin-top:40px;padding-top:30px;border-top:1px solid var(--line);">
					<?php the_tags( '<div style="font-size:13px;color:var(--muted);margin-bottom:16px;">' . __( 'Tags: ', 'ini-dental' ), ', ', '</div>' ); ?>
					<?php
					the_post_navigation( [
						'prev_text' => '&larr; %title',
						'next_text' => '%title &rarr;',
					] );
					?>
				</div>
			</article>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<div style="margin-top:50px;">
					<?php comments_template(); ?>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
</main>

<?php
// Newsletter section after article
ini_render_section( 'newsletter' );
get_footer();
