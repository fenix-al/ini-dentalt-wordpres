<?php
defined( 'ABSPATH' ) || exit;

add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {

	/* ===== MAIN PANEL ===== */
	$wp_customize->add_panel( 'ini_dental', [
		'title'       => __( 'ini Dental Theme', 'ini-dental' ),
		'description' => __( 'Edit all website sections, colors, and content from here. Changes are previewed live on the right.', 'ini-dental' ),
		'priority'    => 30,
	] );

	/* -----------------------------------------------------------------------
	 * Helper: register a setting + image control
	 * -------------------------------------------------------------------- */
	$add_image = function ( $id, $section, $label, $desc = '' ) use ( $wp_customize ) {
		$wp_customize->add_setting( "ini_{$id}", [ 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ] );
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "ini_{$id}", [
			'label'       => $label,
			'description' => $desc,
			'section'     => $section,
			'mime_type'   => 'image',
		] ) );
	};

	$add_text = function ( $id, $section, $label, $default = '', $desc = '' ) use ( $wp_customize ) {
		$wp_customize->add_setting( "ini_{$id}", [ 'default' => $default, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
		$wp_customize->add_control( "ini_{$id}", [ 'label' => $label, 'description' => $desc, 'section' => $section, 'type' => 'text' ] );
	};

	$add_textarea = function ( $id, $section, $label, $default = '', $desc = '' ) use ( $wp_customize ) {
		$wp_customize->add_setting( "ini_{$id}", [ 'default' => $default, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ] );
		$wp_customize->add_control( "ini_{$id}", [ 'label' => $label, 'description' => $desc, 'section' => $section, 'type' => 'textarea' ] );
	};

	$add_url = function ( $id, $section, $label, $default = '#', $desc = '' ) use ( $wp_customize ) {
		$wp_customize->add_setting( "ini_{$id}", [ 'default' => $default, 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ] );
		$wp_customize->add_control( "ini_{$id}", [ 'label' => $label, 'description' => $desc, 'section' => $section, 'type' => 'url' ] );
	};

	$add_color = function ( $id, $section, $label, $default ) use ( $wp_customize ) {
		$wp_customize->add_setting( "ini_{$id}", [ 'default' => $default, 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ] );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "ini_{$id}", [ 'label' => $label, 'section' => $section ] ) );
	};

	/* ===================================================================
	 * SECTION: Global Colors
	 * ================================================================= */
	$wp_customize->add_section( 'ini_colors', [
		'title'    => __( 'Global Colors', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 10,
	] );
	$add_color( 'color_cyan',   'ini_colors', __( 'Primary Color (Cyan)', 'ini-dental' ),   '#3dc8de' );
	$add_color( 'color_yellow', 'ini_colors', __( 'Accent Color (Yellow)', 'ini-dental' ),  '#ffd60a' );
	$add_color( 'color_ink',    'ini_colors', __( 'Text / Ink Color', 'ini-dental' ),       '#0f1b2d' );
	$add_color( 'color_muted',  'ini_colors', __( 'Muted Text Color', 'ini-dental' ),       '#6a7a8c' );

	/* ===================================================================
	 * SECTION: Header & Navigation
	 * ================================================================= */
	$wp_customize->add_section( 'ini_header', [
		'title'    => __( 'Header & Navigation', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 20,
	] );
	$add_text( 'brand_name',     'ini_header', __( 'Brand Name', 'ini-dental' ),              'ini dental' );
	$add_text( 'nav_cta_label',  'ini_header', __( 'Header Button Label', 'ini-dental' ),     'Appointment' );
	$add_url(  'nav_cta_url',    'ini_header', __( 'Header Button URL', 'ini-dental' ),       '#appointment' );

	/* ===================================================================
	 * SECTION: Hero
	 * ================================================================= */
	$wp_customize->add_section( 'ini_hero', [
		'title'       => __( '1. Hero Section', 'ini-dental' ),
		'description' => __( 'The large banner at the top of the page.', 'ini-dental' ),
		'panel'       => 'ini_dental',
		'priority'    => 30,
	] );
	$add_text(     'hero_title',        'ini_hero', __( 'Headline Line 1', 'ini-dental' ),      'Healthy Teeth' );
	$add_text(     'hero_title2',       'ini_hero', __( 'Headline Line 2 (yellow underline)', 'ini-dental' ), 'Happy Life' );
	$add_textarea( 'hero_description',  'ini_hero', __( 'Sub-headline text', 'ini-dental' ),    'At ini dental we combine modern technique with genuinely caring people. Walk in nervous, walk out smiling — that\'s our whole promise.' );
	$add_text(     'hero_cta1_label',   'ini_hero', __( 'Button 1 Label', 'ini-dental' ),       'Get Started' );
	$add_url(      'hero_cta1_url',     'ini_hero', __( 'Button 1 URL', 'ini-dental' ),         '#appointment' );
	$add_text(     'hero_cta2_label',   'ini_hero', __( 'Play Video Label', 'ini-dental' ),     'Play Video' );
	$add_url(      'hero_video_url',    'ini_hero', __( 'Video URL', 'ini-dental' ),            '#' );
	$add_text(     'hero_members',      'ini_hero', __( 'Member Count', 'ini-dental' ),         '567 +' );
	$add_text(     'hero_members_lbl',  'ini_hero', __( 'Member Label', 'ini-dental' ),         'Active Member' );
	$add_image(    'hero_image',        'ini_hero', __( 'Hero Portrait Image', 'ini-dental' ),  __( 'Smiling dentist, arms crossed, light background', 'ini-dental' ) );
	// Stats
	$add_text( 'hero_stat1_num', 'ini_hero', __( 'Stat 1 — Number', 'ini-dental' ),  '15+' );
	$add_text( 'hero_stat1_lbl', 'ini_hero', __( 'Stat 1 — Label', 'ini-dental' ),   'Years Of Experience' );
	$add_text( 'hero_stat2_num', 'ini_hero', __( 'Stat 2 — Number', 'ini-dental' ),  '18+' );
	$add_text( 'hero_stat2_lbl', 'ini_hero', __( 'Stat 2 — Label', 'ini-dental' ),   'Dentist Specialist' );
	$add_text( 'hero_stat3_num', 'ini_hero', __( 'Stat 3 — Number', 'ini-dental' ),  '86+' );
	$add_text( 'hero_stat3_lbl', 'ini_hero', __( 'Stat 3 — Label', 'ini-dental' ),   'Patient Satisfaction' );

	/* ===================================================================
	 * SECTION: Features Strip
	 * ================================================================= */
	$wp_customize->add_section( 'ini_features', [
		'title'       => __( '2. Features Strip', 'ini-dental' ),
		'description' => __( '3 short feature highlights below the hero.', 'ini-dental' ),
		'panel'       => 'ini_dental',
		'priority'    => 40,
	] );
	for ( $i = 1; $i <= 3; $i++ ) {
		$add_text( "feat{$i}_title", 'ini_features', sprintf( __( 'Feature %d — Title', 'ini-dental' ), $i ),
			[ 'Service Satisfaction', 'Latest Technology', 'Professional Dentist' ][ $i - 1 ] );
		$add_textarea( "feat{$i}_desc", 'ini_features', sprintf( __( 'Feature %d — Description', 'ini-dental' ), $i ),
			'Reprehenderit in voluptate velit esse cillum dolore.' );
	}

	/* ===================================================================
	 * SECTION: About
	 * ================================================================= */
	$wp_customize->add_section( 'ini_about', [
		'title'    => __( '3. About Section', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 50,
	] );
	$add_text(     'about_title',       'ini_about', __( 'Title', 'ini-dental' ),                'The Best Dental Clinic That Can Help Solve Your Problems' );
	$add_textarea( 'about_description', 'ini_about', __( 'Description', 'ini-dental' ),         'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );
	$add_image(    'about_image',       'ini_about', __( 'About Image', 'ini-dental' ),          __( 'Dentist treating patient', 'ini-dental' ) );
	$add_text(     'about_trusted',     'ini_about', __( 'Trusted By (number)', 'ini-dental' ),  '100+' );
	$add_text(     'about_vision_title','ini_about', __( 'Vision Title', 'ini-dental' ),         'Our Vision' );
	$add_textarea( 'about_vision_desc', 'ini_about', __( 'Vision Description', 'ini-dental' ),  'Lorem ipsum dolor sit amet, sed do.' );
	$add_text(     'about_mission_title','ini_about',__( 'Mission Title', 'ini-dental' ),        'Our Mission' );
	$add_textarea( 'about_mission_desc','ini_about', __( 'Mission Description', 'ini-dental' ), 'Lorem ipsum dolor sit amet, sed do.' );
	$add_text(     'about_cta_label',   'ini_about', __( 'Button Label', 'ini-dental' ),         'More About Us' );
	$add_url(      'about_cta_url',     'ini_about', __( 'Button URL', 'ini-dental' ),           '#' );
	$add_text(     'about_ceo_name',    'ini_about', __( 'CEO Name', 'ini-dental' ),             'Bill Mcdaniel' );
	$add_text(     'about_ceo_title',   'ini_about', __( 'CEO Title', 'ini-dental' ),            'CEO ini dental' );
	$add_image(    'about_ceo_image',   'ini_about', __( 'CEO Portrait', 'ini-dental' ) );

	/* ===================================================================
	 * SECTION: Services
	 * ================================================================= */
	$wp_customize->add_section( 'ini_services', [
		'title'    => __( '4. Services Section', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 60,
	] );
	$add_text(     'services_title', 'ini_services', __( 'Section Title', 'ini-dental' ),       'What Services Do We Provide For You?' );
	$add_textarea( 'services_desc',  'ini_services', __( 'Section Description', 'ini-dental' ), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.' );

	$svc_defaults = [
		1 => [ 'Root Canal Treatment', 'Voluptate velit esse cillum dolore eu fugiat nulla pariatur.' ],
		2 => [ 'Oral Surgery',          'Voluptate velit esse cillum dolore eu fugiat nulla pariatur.' ],
		3 => [ 'Cosmetic Dentistry',    'Voluptate velit esse cillum dolore eu fugiat nulla pariatur.' ],
	];
	foreach ( $svc_defaults as $i => [ $t, $d ] ) {
		$add_text(     "svc{$i}_title", 'ini_services', sprintf( __( 'Service %d — Title', 'ini-dental' ), $i ),       $t );
		$add_textarea( "svc{$i}_desc",  'ini_services', sprintf( __( 'Service %d — Description', 'ini-dental' ), $i ), $d );
		$add_url(      "svc{$i}_url",   'ini_services', sprintf( __( 'Service %d — Learn More URL', 'ini-dental' ), $i ), '#' );
		$add_image(    "svc{$i}_image", 'ini_services', sprintf( __( 'Service %d — Image', 'ini-dental' ), $i ) );
	}

	/* ===================================================================
	 * SECTION: Testimonials
	 * ================================================================= */
	$wp_customize->add_section( 'ini_testimonials', [
		'title'    => __( '5. Testimonials', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 70,
	] );
	$add_text(     'testi_title', 'ini_testimonials', __( 'Section Title', 'ini-dental' ),       'What People Say' );
	$add_textarea( 'testi_desc',  'ini_testimonials', __( 'Section Description', 'ini-dental' ), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' );
	$add_text(     'testi_cta',   'ini_testimonials', __( 'Button Label', 'ini-dental' ),        'Feedback' );
	$add_url(      'testi_url',   'ini_testimonials', __( 'Button URL', 'ini-dental' ),          '#' );

	$testi_defaults = [
		1 => [ 'Damian Stevens', 'Manager' ],
		2 => [ 'Jillian Nichols', 'Web Design' ],
		3 => [ 'Damian Stevens', 'Manager' ],
		4 => [ 'Jillian Nichols', 'Web Design' ],
	];
	foreach ( $testi_defaults as $i => [ $name, $role ] ) {
		$add_text(     "testi{$i}_name",  'ini_testimonials', sprintf( __( 'Review %d — Name', 'ini-dental' ), $i ),    $name );
		$add_text(     "testi{$i}_role",  'ini_testimonials', sprintf( __( 'Review %d — Role', 'ini-dental' ), $i ),    $role );
		$add_textarea( "testi{$i}_quote", 'ini_testimonials', sprintf( __( 'Review %d — Quote', 'ini-dental' ), $i ),   'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.' );
		$add_image(    "testi{$i}_image", 'ini_testimonials', sprintf( __( 'Review %d — Avatar', 'ini-dental' ), $i ) );
	}

	/* ===================================================================
	 * SECTION: Solutions
	 * ================================================================= */
	$wp_customize->add_section( 'ini_solutions', [
		'title'    => __( '6. Solutions Section', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 80,
	] );
	$add_text(     'sol_title',    'ini_solutions', __( 'Section Title', 'ini-dental' ),         'We Will Help You Find The Best Solutions' );
	$add_textarea( 'sol_desc',     'ini_solutions', __( 'Section Description', 'ini-dental' ),   'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );
	$add_text(     'sol_check1',   'ini_solutions', __( 'Checklist Item 1', 'ini-dental' ),      'Quality In Dental Health' );
	$add_text(     'sol_check2',   'ini_solutions', __( 'Checklist Item 2 (yellow tick)', 'ini-dental' ), 'Professional Dentist' );
	$add_text(     'sol_check3',   'ini_solutions', __( 'Checklist Item 3', 'ini-dental' ),      'Services Satisfaction' );
	$add_image(    'sol_image',    'ini_solutions', __( 'Section Image', 'ini-dental' ) );
	$add_text(     'sol_wh_title', 'ini_solutions', __( 'Work Hours — Card Title', 'ini-dental' ), 'Work Hours' );
	$add_textarea( 'sol_wh_desc',  'ini_solutions', __( 'Work Hours — Description', 'ini-dental' ), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' );
	$add_text(     'sol_wh_h1',    'ini_solutions', __( 'Work Hours — Row 1', 'ini-dental' ),    'Mon - Thu : 05.00 - 06.00' );
	$add_text(     'sol_wh_h2',    'ini_solutions', __( 'Work Hours — Row 2', 'ini-dental' ),    'Fri - Sat : 03.00 - 10.00' );
	$add_text(     'sol_wh_cta',   'ini_solutions', __( 'Work Hours — Button Label', 'ini-dental' ), 'Appointment' );
	$add_url(      'sol_wh_url',   'ini_solutions', __( 'Work Hours — Button URL', 'ini-dental' ), '#appointment' );
	$add_url(      'sol_video_url','ini_solutions', __( 'Play Video URL', 'ini-dental' ),        '#' );

	/* ===================================================================
	 * SECTION: Steps
	 * ================================================================= */
	$wp_customize->add_section( 'ini_steps', [
		'title'    => __( '7. Easy Steps Section', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 90,
	] );
	$add_text(     'steps_title', 'ini_steps', __( 'Section Title', 'ini-dental' ),       'Easy Steps To Find The Best Solutions' );
	$add_textarea( 'steps_desc',  'ini_steps', __( 'Section Description', 'ini-dental' ), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' );

	$step_defaults = [
		1 => [ 'Make Appointment',  'Voluptate velit esse cillum dolore eu fugiat nulla.' ],
		2 => [ 'Meet Our Dentist',  'Voluptate velit esse cillum dolore eu fugiat nulla.' ],
		3 => [ 'Get The Solutions', 'Voluptate velit esse cillum dolore eu fugiat nulla.' ],
		4 => [ 'Perform Treatment', 'Voluptate velit esse cillum dolore eu fugiat nulla.' ],
	];
	foreach ( $step_defaults as $i => [ $t, $d ] ) {
		$add_text(     "step{$i}_title", 'ini_steps', sprintf( __( 'Step %d — Title', 'ini-dental' ), $i ), $t );
		$add_textarea( "step{$i}_desc",  'ini_steps', sprintf( __( 'Step %d — Description', 'ini-dental' ), $i ), $d );
	}

	/* ===================================================================
	 * SECTION: Appointment Form
	 * ================================================================= */
	$wp_customize->add_section( 'ini_appointment', [
		'title'    => __( '8. Appointment Form', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 100,
	] );
	$add_text(  'appt_title',    'ini_appointment', __( 'Form Title', 'ini-dental' ),           'Make Appointment' );
	$add_image( 'appt_image',    'ini_appointment', __( 'Dentist Portrait beside form', 'ini-dental' ) );
	$add_text(  'appt_email_to', 'ini_appointment', __( 'Send form submissions to (email)', 'ini-dental' ), get_option( 'admin_email' ) );
	// Services in dropdown
	$add_textarea( 'appt_services', 'ini_appointment',
		__( 'Appointment Services (one per line)', 'ini-dental' ),
		"Root Canal Treatment\nOral Surgery\nCosmetic Dentistry",
		__( 'Each line becomes one option in the service dropdown.', 'ini-dental' )
	);

	/* ===================================================================
	 * SECTION: Blog Section
	 * ================================================================= */
	$wp_customize->add_section( 'ini_blog_section', [
		'title'    => __( '9. Blog Section', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 110,
	] );
	$add_text(     'blog_title',     'ini_blog_section', __( 'Section Title', 'ini-dental' ),     'Latest Blog & Article' );
	$add_textarea( 'blog_desc',      'ini_blog_section', __( 'Section Description', 'ini-dental' ), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' );
	$add_text(     'blog_cta_label', 'ini_blog_section', __( 'Button Label', 'ini-dental' ),      'Visit Our Blog' );
	$add_url(      'blog_cta_url',   'ini_blog_section', __( 'Button URL', 'ini-dental' ),        '#' );
	$add_text(     'blog_count',     'ini_blog_section', __( 'Number of posts to show', 'ini-dental' ), '4' );

	/* ===================================================================
	 * SECTION: Newsletter
	 * ================================================================= */
	$wp_customize->add_section( 'ini_newsletter', [
		'title'    => __( '10. Newsletter Section', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 120,
	] );
	$add_text(     'news_title',       'ini_newsletter', __( 'Section Title', 'ini-dental' ),       'Subscribe Our Newsletter' );
	$add_textarea( 'news_desc',        'ini_newsletter', __( 'Section Description', 'ini-dental' ), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ut elit tellus, luctus nec ullamcorper mattis.' );
	$add_text(     'news_placeholder', 'ini_newsletter', __( 'Input Placeholder', 'ini-dental' ),   'Your Email Address' );
	$add_text(     'news_btn_label',   'ini_newsletter', __( 'Button Label', 'ini-dental' ),        'Sign Up' );

	/* ===================================================================
	 * SECTION: Footer
	 * ================================================================= */
	$wp_customize->add_section( 'ini_footer', [
		'title'    => __( '11. Footer', 'ini-dental' ),
		'panel'    => 'ini_dental',
		'priority' => 130,
	] );
	$add_textarea( 'footer_about',     'ini_footer', __( 'Brand Description', 'ini-dental' ),   'Purus viverra accumsan in nisl nisi scelerisque eu ultrices.' );
	$add_url(      'social_facebook',  'ini_footer', __( 'Facebook URL', 'ini-dental' ),         '#' );
	$add_url(      'social_twitter',   'ini_footer', __( 'Twitter / X URL', 'ini-dental' ),      '#' );
	$add_url(      'social_instagram', 'ini_footer', __( 'Instagram URL', 'ini-dental' ),        '#' );
	$add_url(      'social_linkedin',  'ini_footer', __( 'LinkedIn URL', 'ini-dental' ),         '#' );
	$add_text(     'footer_address',   'ini_footer', __( 'Address', 'ini-dental' ),              'Busy Building W 13th, Postal Suite 559, Denver' );
	$add_text(     'footer_phone',     'ini_footer', __( 'Phone', 'ini-dental' ),                '+1 (555) 123 45 67' );
	$add_text(     'footer_email',     'ini_footer', __( 'Email', 'ini-dental' ),                'hello@ini-dental.support' );
	$add_text(     'footer_copyright', 'ini_footer', __( 'Copyright Text', 'ini-dental' ),       '© 2026 ini dental. All rights reserved.' );
	$add_text(     'footer_cta_text',  'ini_footer', __( 'Footer Top Banner Text', 'ini-dental' ), '' );
} );
