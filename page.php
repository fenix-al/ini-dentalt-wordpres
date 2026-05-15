<?php
get_header();

$post_id  = get_the_ID();
$sections = get_post_meta( $post_id, '_ini_page_sections', true );

// If the page has custom sections configured, render them
if ( ! empty( $sections ) && is_array( $sections ) ) {
	foreach ( $sections as $slug ) {
		ini_render_section( $slug );
	}
} else {
	// Default: render standard page content
	?>
	<main class="site-main wrap" style="padding:80px 0;min-height:60vh;">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<h1 class="page-title"><?php the_title(); ?></h1>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</main>
	<?php
}

get_footer();
