<?php
defined( 'ABSPATH' ) || exit;

$title     = ini_mod( 'sol_title',    'We Will Help You Find The Best Solutions' );
$desc      = ini_mod( 'sol_desc',     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );
$check1    = ini_mod( 'sol_check1',   'Quality In Dental Health' );
$check2    = ini_mod( 'sol_check2',   'Professional Dentist' );
$check3    = ini_mod( 'sol_check3',   'Services Satisfaction' );
$image     = ini_mod( 'sol_image',    0 );
$wh_title  = ini_mod( 'sol_wh_title', 'Work Hours' );
$wh_desc   = ini_mod( 'sol_wh_desc',  'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' );
$wh_h1     = ini_mod( 'sol_wh_h1',    'Mon - Thu : 05.00 - 06.00' );
$wh_h2     = ini_mod( 'sol_wh_h2',    'Fri - Sat : 03.00 - 10.00' );
$wh_cta    = ini_mod( 'sol_wh_cta',   'Appointment' );
$wh_url    = ini_mod( 'sol_wh_url',   '#appointment' );
$video_url = ini_mod( 'sol_video_url','#' );

$check_icon = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>';
?>

<section class="solutions" id="solutions">
  <div class="wrap">
    <div class="sol-grid">

      <!-- Copy + checklist -->
      <div class="sol-copy">
        <h2><?php echo esc_html( $title ); ?></h2>
        <p><?php echo esc_html( $desc ); ?></p>
        <div class="bars">
          <div class="check-row">
            <span class="tick"><?php echo $check_icon; ?></span>
            <span class="lbl"><?php echo esc_html( $check1 ); ?></span>
          </div>
          <div class="check-row">
            <span class="tick y"><?php echo $check_icon; ?></span>
            <span class="lbl"><?php echo esc_html( $check2 ); ?></span>
          </div>
          <div class="check-row">
            <span class="tick"><?php echo $check_icon; ?></span>
            <span class="lbl"><?php echo esc_html( $check3 ); ?></span>
          </div>
        </div>
      </div>

      <!-- Image with overlays -->
      <div class="sol-figure">
        <?php ini_image( $image, 'large', __( 'Dentist with patient', 'ini-dental' ), __( 'Dentist with young patient on chair', 'ini-dental' ) ); ?>

        <div class="work-hours">
          <h5><?php echo esc_html( $wh_title ); ?></h5>
          <p><?php echo esc_html( $wh_desc ); ?></p>
          <ul class="hrs">
            <?php if ( $wh_h1 ) : ?>
              <li><?php echo esc_html( $wh_h1 ); ?></li>
            <?php endif; ?>
            <?php if ( $wh_h2 ) : ?>
              <li><?php echo esc_html( $wh_h2 ); ?></li>
            <?php endif; ?>
          </ul>
          <a href="<?php echo esc_url( $wh_url ); ?>" class="btn btn-yellow">
            <?php echo esc_html( $wh_cta ); ?>
          </a>
        </div>

        <?php if ( $video_url && $video_url !== '#' ) : ?>
        <a href="<?php echo esc_url( $video_url ); ?>" class="sol-play ini-video-trigger" data-video="<?php echo esc_attr( $video_url ); ?>">
          <span class="play-icon">
            <svg viewBox="0 0 20 20"><path d="M5 3l12 7-12 7z"/></svg>
          </span>
          <?php esc_html_e( 'Play Video', 'ini-dental' ); ?>
        </a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
