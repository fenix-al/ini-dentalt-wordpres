<?php
defined( 'ABSPATH' ) || exit;

/* =========================================================================
 * SECTION MANAGER
 * =========================================================================
 * Provides:
 *  1. A "Page Sections" meta box on every page/post to:
 *     - Choose which sections appear on that page
 *     - Drag to reorder sections
 *     - Copy sections from another page with one click
 *  2. An admin page at Appearance > Section Library to view and copy
 *     section configurations across all pages.
 * ===================================================================== */

/* -----------------------------------------------------------------------
 * Admin menu
 * -------------------------------------------------------------------- */
add_action( 'admin_menu', function () {
	add_theme_page(
		__( 'Section Library', 'ini-dental' ),
		__( 'Section Library', 'ini-dental' ),
		'edit_pages',
		'ini-dental-section-library',
		'ini_dental_section_library_page'
	);
} );

/* -----------------------------------------------------------------------
 * Meta box: Page Sections
 * -------------------------------------------------------------------- */
add_action( 'add_meta_boxes', function () {
	$screens = [ 'page', 'post' ];
	foreach ( $screens as $screen ) {
		add_meta_box(
			'ini_page_sections',
			__( 'Page Sections', 'ini-dental' ),
			'ini_dental_sections_meta_box',
			$screen,
			'normal',
			'high'
		);
	}
} );

function ini_dental_sections_meta_box( WP_Post $post ) {
	wp_nonce_field( 'ini_save_sections', 'ini_sections_nonce' );

	$all_sections   = ini_available_sections();
	$active_sections = get_post_meta( $post->ID, '_ini_page_sections', true );
	if ( ! is_array( $active_sections ) ) {
		$active_sections = array_keys( $all_sections );
	}

	// All pages list for the "copy from" dropdown
	$pages = get_pages( [ 'exclude' => [ $post->ID ], 'sort_column' => 'post_title' ] );
	?>
	<div class="ini-meta-wrap" id="ini-sections-meta">
		<p class="ini-meta-intro">
			<?php esc_html_e( 'Drag to reorder sections, check/uncheck to show or hide them on this page.', 'ini-dental' ); ?>
		</p>

		<!-- Copy from another page -->
		<div class="ini-copy-bar">
			<label for="ini-copy-source"><strong><?php esc_html_e( 'Copy section order from page:', 'ini-dental' ); ?></strong></label>
			<select id="ini-copy-source" style="margin:0 8px;">
				<option value=""><?php esc_html_e( '— Select a page —', 'ini-dental' ); ?></option>
				<?php foreach ( $pages as $p ) : ?>
					<option value="<?php echo esc_attr( $p->ID ); ?>"><?php echo esc_html( $p->post_title ); ?></option>
				<?php endforeach; ?>
			</select>
			<button type="button" class="button" id="ini-copy-sections-btn">
				<?php esc_html_e( 'Copy', 'ini-dental' ); ?>
			</button>
			<span class="ini-copy-status" style="margin-left:8px;color:green;display:none;"></span>
		</div>

		<ul class="ini-sections-list" id="ini-sections-sortable">
			<?php
			// Render active sections first in order, then inactive
			$inactive = array_diff( array_keys( $all_sections ), $active_sections );
			$ordered  = array_merge( $active_sections, $inactive );
			foreach ( $ordered as $slug ) :
				if ( ! isset( $all_sections[ $slug ] ) ) continue;
				$checked = in_array( $slug, $active_sections, true );
				?>
				<li class="ini-section-item" data-slug="<?php echo esc_attr( $slug ); ?>">
					<span class="ini-drag-handle dashicons dashicons-menu" title="<?php esc_attr_e( 'Drag to reorder', 'ini-dental' ); ?>"></span>
					<label>
						<input type="checkbox"
							   name="ini_sections[]"
							   value="<?php echo esc_attr( $slug ); ?>"
							   <?php checked( $checked ); ?>>
						<?php echo esc_html( $all_sections[ $slug ] ); ?>
					</label>
					<small class="ini-section-slug">(<?php echo esc_html( $slug ); ?>)</small>
				</li>
			<?php endforeach; ?>
		</ul>

		<p class="description" style="margin-top:12px;">
			<?php esc_html_e( 'Content for each section is managed in Appearance → Customize → ini Dental Theme. You can override individual sections per-page through the Customizer or leave them to use global defaults.', 'ini-dental' ); ?>
		</p>
	</div>
	<script>
	jQuery(function($){
		$('#ini-sections-sortable').sortable({ handle: '.ini-drag-handle', axis: 'y' });

		$('#ini-copy-sections-btn').on('click', function(){
			var sourceId = $('#ini-copy-source').val();
			if ( ! sourceId ) { alert('<?php esc_js( __( 'Please select a page to copy from.', 'ini-dental' ) ); ?>'); return; }

			$.post(iniDentalAdmin.ajaxUrl, {
				action: 'ini_get_page_sections',
				page_id: sourceId,
				nonce: iniDentalAdmin.nonce
			}, function(res){
				if ( res.success && res.data.sections ) {
					var sections = res.data.sections;
					var $list    = $('#ini-sections-sortable');
					var $items   = $list.find('.ini-section-item');

					// Reorder items and set checkbox states
					var ordered = [];
					sections.forEach(function(slug){
						var $item = $items.filter('[data-slug="'+slug+'"]');
						if ($item.length) {
							$item.find('input[type=checkbox]').prop('checked', true);
							ordered.push($item[0]);
						}
					});
					// Inactive ones at end
					$items.each(function(){
						if ( !sections.includes($(this).data('slug')) ) {
							$(this).find('input[type=checkbox]').prop('checked', false);
							ordered.push(this);
						}
					});
					$list.append(ordered);
					$('.ini-copy-status').text('<?php esc_js( __( 'Copied!', 'ini-dental' ) ); ?>').show().delay(2000).fadeOut();
				}
			});
		});
	});
	</script>
	<?php
}

/* -----------------------------------------------------------------------
 * Save meta box data
 * -------------------------------------------------------------------- */
add_action( 'save_post', function ( int $post_id ) {
	if ( ! isset( $_POST['ini_sections_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['ini_sections_nonce'], 'ini_save_sections' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	$all_sections = array_keys( ini_available_sections() );
	$submitted    = isset( $_POST['ini_sections'] ) ? (array) $_POST['ini_sections'] : [];
	$clean        = array_values( array_intersect( $all_sections, array_map( 'sanitize_key', $submitted ) ) );

	update_post_meta( $post_id, '_ini_page_sections', $clean );
} );

/* -----------------------------------------------------------------------
 * AJAX: get section order for a given page
 * -------------------------------------------------------------------- */
add_action( 'wp_ajax_ini_get_page_sections', function () {
	check_ajax_referer( 'ini_dental_admin_nonce', 'nonce' );

	$page_id  = absint( $_POST['page_id'] ?? 0 );
	$sections = ini_get_page_sections( $page_id );

	wp_send_json_success( [ 'sections' => array_values( $sections ) ] );
} );

/* -----------------------------------------------------------------------
 * AJAX: copy sections from one page to another
 * -------------------------------------------------------------------- */
add_action( 'wp_ajax_ini_copy_sections_to_page', function () {
	check_ajax_referer( 'ini_dental_admin_nonce', 'nonce' );

	if ( ! current_user_can( 'edit_pages' ) ) {
		wp_send_json_error( __( 'Permission denied.', 'ini-dental' ) );
	}

	$source_id = absint( $_POST['source_id'] ?? 0 );
	$target_id = absint( $_POST['target_id'] ?? 0 );

	if ( ! $source_id || ! $target_id ) {
		wp_send_json_error( __( 'Invalid page IDs.', 'ini-dental' ) );
	}

	$sections = ini_get_page_sections( $source_id );
	update_post_meta( $target_id, '_ini_page_sections', $sections );

	wp_send_json_success( [
		'message'  => sprintf(
			__( 'Sections copied from "%s" to "%s".', 'ini-dental' ),
			get_the_title( $source_id ),
			get_the_title( $target_id )
		),
		'sections' => $sections,
	] );
} );

/* -----------------------------------------------------------------------
 * Admin Page: Section Library
 * -------------------------------------------------------------------- */
function ini_dental_section_library_page() {
	if ( ! current_user_can( 'edit_pages' ) ) {
		wp_die( __( 'You do not have permission to view this page.', 'ini-dental' ) );
	}

	// Handle copy action
	$copy_msg = '';
	if ( isset( $_POST['ini_library_nonce'], $_POST['ini_copy_source'], $_POST['ini_copy_target'] )
		&& wp_verify_nonce( $_POST['ini_library_nonce'], 'ini_section_library' )
		&& current_user_can( 'edit_pages' )
	) {
		$source = absint( $_POST['ini_copy_source'] );
		$target = absint( $_POST['ini_copy_target'] );

		if ( $source && $target && $source !== $target ) {
			$sections = ini_get_page_sections( $source );
			update_post_meta( $target, '_ini_page_sections', $sections );
			$copy_msg = sprintf(
				'<div class="notice notice-success is-dismissible"><p>%s</p></div>',
				esc_html( sprintf(
					__( 'Section order from "%s" successfully applied to "%s".', 'ini-dental' ),
					get_the_title( $source ),
					get_the_title( $target )
				) )
			);
		} else {
			$copy_msg = '<div class="notice notice-error is-dismissible"><p>' . esc_html__( 'Please select different source and target pages.', 'ini-dental' ) . '</p></div>';
		}
	}

	$all_pages    = get_pages( [ 'sort_column' => 'post_title' ] );
	$all_sections = ini_available_sections();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Section Library', 'ini-dental' ); ?></h1>
		<p><?php esc_html_e( 'Here you can see which sections are active on each page, and duplicate a page\'s section configuration to any other page.', 'ini-dental' ); ?></p>

		<?php echo $copy_msg; ?>

		<!-- Duplicate Section Form -->
		<div class="card" style="max-width:600px;padding:20px 24px;margin-bottom:30px;">
			<h2 style="margin-top:0;"><?php esc_html_e( 'Duplicate Section Order to Another Page', 'ini-dental' ); ?></h2>
			<form method="post">
				<?php wp_nonce_field( 'ini_section_library', 'ini_library_nonce' ); ?>
				<table class="form-table">
					<tr>
						<th><?php esc_html_e( 'Copy FROM page:', 'ini-dental' ); ?></th>
						<td>
							<select name="ini_copy_source" style="width:100%;">
								<option value=""><?php esc_html_e( '— Select source —', 'ini-dental' ); ?></option>
								<?php foreach ( $all_pages as $p ) : ?>
									<option value="<?php echo esc_attr( $p->ID ); ?>"><?php echo esc_html( $p->post_title ); ?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Copy TO page:', 'ini-dental' ); ?></th>
						<td>
							<select name="ini_copy_target" style="width:100%;">
								<option value=""><?php esc_html_e( '— Select target —', 'ini-dental' ); ?></option>
								<?php foreach ( $all_pages as $p ) : ?>
									<option value="<?php echo esc_attr( $p->ID ); ?>"><?php echo esc_html( $p->post_title ); ?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
				</table>
				<p class="submit">
					<button type="submit" class="button button-primary">
						<?php esc_html_e( 'Duplicate Section Order', 'ini-dental' ); ?>
					</button>
				</p>
			</form>
		</div>

		<!-- Overview table -->
		<h2><?php esc_html_e( 'Section Overview by Page', 'ini-dental' ); ?></h2>
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<th style="width:220px;"><?php esc_html_e( 'Page', 'ini-dental' ); ?></th>
					<th><?php esc_html_e( 'Active Sections (in order)', 'ini-dental' ); ?></th>
					<th style="width:140px;"><?php esc_html_e( 'Edit', 'ini-dental' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $all_pages as $p ) :
					$sections = ini_get_page_sections( $p->ID );
					?>
					<tr>
						<td><strong><?php echo esc_html( $p->post_title ); ?></strong></td>
						<td>
							<?php foreach ( $sections as $slug ) : ?>
								<span class="ini-section-chip" style="display:inline-block;background:#e3f6f9;border:1px solid #b6e8f3;border-radius:4px;padding:2px 8px;margin:2px;font-size:12px;">
									<?php echo esc_html( $all_sections[ $slug ] ?? $slug ); ?>
								</span>
							<?php endforeach; ?>
							<?php if ( empty( $sections ) ) : ?>
								<em style="color:#999;"><?php esc_html_e( 'Using defaults', 'ini-dental' ); ?></em>
							<?php endif; ?>
						</td>
						<td>
							<a href="<?php echo esc_url( get_edit_post_link( $p->ID ) ); ?>" class="button button-small">
								<?php esc_html_e( 'Edit Page', 'ini-dental' ); ?>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<hr>
		<p>
			<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary button-large">
				<?php esc_html_e( '⚙ Edit All Section Content in Customizer', 'ini-dental' ); ?>
			</a>
		</p>
	</div>
	<?php
}
