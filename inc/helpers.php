<?php
defined( 'ABSPATH' ) || exit;

/**
 * Get a theme mod with the 'ini_' prefix.
 * Usage: ini_mod('hero_title', 'Default')
 */
function ini_mod( string $key, $default = '' ) {
	return get_theme_mod( 'ini_' . $key, $default );
}

/**
 * Get a page-level section override, falling back to the Customizer value.
 * Usage: ini_page_mod($post_id, 'hero_title', 'ini_hero_title', 'Default')
 */
function ini_page_mod( int $post_id, string $meta_key, string $theme_mod_key, $default = '' ) {
	$meta = get_post_meta( $post_id, '_ini_section_' . $meta_key, true );
	if ( $meta !== '' && $meta !== false ) {
		return $meta;
	}
	return get_theme_mod( 'ini_' . $theme_mod_key, $default );
}

/**
 * Render a theme mod as escaped HTML.
 */
function ini_mod_e( string $key, $default = '' ) {
	echo wp_kses_post( ini_mod( $key, $default ) );
}

/**
 * Output an attachment image or a placeholder div.
 *
 * @param int|string $attachment_id  Attachment ID or 0.
 * @param string     $size           Image size.
 * @param string     $alt            Alt text.
 * @param string     $placeholder    Placeholder label for empty state.
 * @param string     $extra_class    Extra CSS classes on the wrapper.
 */
function ini_image( $attachment_id, string $size = 'large', string $alt = '', string $placeholder = 'Image', string $extra_class = '' ) {
	if ( $attachment_id ) {
		$img = wp_get_attachment_image( (int) $attachment_id, $size, false, [
			'alt'   => esc_attr( $alt ),
			'class' => 'ini-img',
		] );
		if ( $img ) {
			echo $img;
			return;
		}
	}
	// Placeholder
	$class = 'ini-img-placeholder' . ( $extra_class ? ' ' . esc_attr( $extra_class ) : '' );
	printf(
		'<div class="%s"><span>%s</span></div>',
		esc_attr( $class ),
		esc_html( $placeholder )
	);
}

/**
 * Get the list of all available sections for the page builder.
 *
 * @return array  [ 'slug' => 'Label', ... ]
 */
function ini_available_sections(): array {
	return [
		'hero'         => __( 'Hero Banner', 'ini-dental' ),
		'features'     => __( 'Features Strip', 'ini-dental' ),
		'about'        => __( 'About Us', 'ini-dental' ),
		'services'     => __( 'Our Services', 'ini-dental' ),
		'testimonials' => __( 'Testimonials', 'ini-dental' ),
		'solutions'    => __( 'Solutions', 'ini-dental' ),
		'steps'        => __( 'Easy Steps', 'ini-dental' ),
		'appointment'  => __( 'Appointment Form', 'ini-dental' ),
		'blog'         => __( 'Blog Posts', 'ini-dental' ),
		'newsletter'   => __( 'Newsletter', 'ini-dental' ),
	];
}

/**
 * Get the enabled + ordered sections for a given post/page.
 * Falls back to all sections in default order if nothing is saved.
 *
 * @param int $post_id
 * @return array  [ 'hero', 'features', ... ]
 */
function ini_get_page_sections( int $post_id ): array {
	$saved = get_post_meta( $post_id, '_ini_page_sections', true );
	if ( ! empty( $saved ) && is_array( $saved ) ) {
		return array_filter( $saved, fn( $s ) => isset( ini_available_sections()[ $s ] ) );
	}
	return array_keys( ini_available_sections() );
}

/**
 * Render a section template part for a given slug.
 *
 * @param string $slug     e.g. 'hero'
 * @param array  $args     Extra context passed to the template.
 */
function ini_render_section( string $slug, array $args = [] ) {
	get_template_part( 'template-parts/sections/' . $slug, null, $args );
}

/**
 * Returns a sanitized list of social links stored as serialized array in theme mod.
 */
function ini_socials(): array {
	return [
		'facebook'  => ini_mod( 'social_facebook', '#' ),
		'twitter'   => ini_mod( 'social_twitter', '#' ),
		'instagram' => ini_mod( 'social_instagram', '#' ),
		'linkedin'  => ini_mod( 'social_linkedin', '#' ),
	];
}
