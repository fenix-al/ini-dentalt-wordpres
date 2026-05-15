<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$brand     = ini_mod( 'brand_name', 'ini dental' );
$cta_label = ini_mod( 'nav_cta_label', 'Appointment' );
$cta_url   = ini_mod( 'nav_cta_url', '#appointment' );
?>

<header class="topbar" id="masthead">
  <div class="wrap">
    <nav class="nav" aria-label="<?php esc_attr_e( 'Primary', 'ini-dental' ); ?>">

      <!-- Logo -->
      <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span class="logo-mark">
          <svg viewBox="0 0 24 24" fill="none" stroke="#2bb8d0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2c-2.5 0-4 1.5-4 3 0 1.5.5 3 1 5 .3 1.2.5 3 .5 5 0 2 .5 6 2.5 7 2-1 2.5-5 2.5-7 0-2 .2-3.8.5-5 .5-2 1-3.5 1-5 0-1.5-1.5-3-4-3z"/>
          </svg>
        </span>
        <span><?php
          $parts = explode( ' ', $brand, 2 );
          echo esc_html( $parts[0] );
          if ( isset( $parts[1] ) ) {
              echo ' <em style="font-style:normal;color:var(--cyan-500)">' . esc_html( $parts[1] ) . '</em>';
          }
        ?></span>
      </a>

      <!-- Navigation menu -->
      <div class="menu" id="ini-menu">
        <?php
        wp_nav_menu( [
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'fallback_cb'    => function () {
              // Default links if no menu is assigned
              $links = [ 'Home' => '#', 'About' => '#about', 'Services' => '#services', 'Blog' => '#blog', 'Contact' => '#contact' ];
              foreach ( $links as $label => $url ) {
                  printf( '<a href="%s">%s</a>', esc_url( $url ), esc_html( $label ) );
              }
          },
        ] );
        ?>
        <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-cyan" style="margin-top:6px;">
          <?php echo esc_html( $cta_label ); ?>
        </a>
      </div>

      <!-- Desktop CTA button -->
      <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-cyan ini-desktop-cta">
        <?php echo esc_html( $cta_label ); ?>
      </a>

      <!-- Hamburger -->
      <button class="menu-btn" id="ini-menu-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'ini-dental' ); ?>" aria-expanded="false" aria-controls="ini-menu">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <path d="M4 7h16M4 12h16M4 17h16"/>
        </svg>
      </button>
    </nav>
  </div>
</header>
