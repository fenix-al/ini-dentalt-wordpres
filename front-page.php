<?php
get_header();

// Determine which sections to render for the front page
$post_id  = get_queried_object_id();
$sections = ini_get_page_sections( $post_id );

foreach ( $sections as $slug ) {
	ini_render_section( $slug );
}

get_footer();
