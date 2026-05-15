<?php
defined( 'ABSPATH' ) || exit;

$title         = ini_mod( 'about_title',        'The Best Dental Clinic That Can Help Solve Your Problems' );
$desc          = ini_mod( 'about_description',  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );
$image         = ini_mod( 'about_image',        0 );
$trusted       = ini_mod( 'about_trusted',      '100+' );
$vision_title  = ini_mod( 'about_vision_title', 'Our Vision' );
$vision_desc   = ini_mod( 'about_vision_desc',  'Lorem ipsum dolor sit amet, sed do.' );
$mission_title = ini_mod( 'about_mission_title','Our Mission' );
$mission_desc  = ini_mod( 'about_mission_desc', 'Lorem ipsum dolor sit amet, sed do.' );
$cta_label     = ini_mod( 'about_cta_label',    'More About Us' );
$cta_url       = ini_mod( 'about_cta_url',      '#' );
$ceo_name      = ini_mod( 'about_ceo_name',     'Bill Mcdaniel' );
$ceo_title     = ini_mod( 'about_ceo_title',    'CEO ini dental' );
$ceo_image     = ini_mod( 'about_ceo_image',    0 );
?>

<section class="about" id="about">
  <div class="wrap">
    <div class="about-grid">

      <!-- Image side -->
      <div class="about-figure">
        <div class="trusted-badge">
          <div class="ring">
            <svg viewBox="0 0 24 24" fill="#fff"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 16.8 5.8 21.3l2.4-7.4L2 9.4h7.6z"/></svg>
          </div>
          <p><?php echo sprintf( __( 'Trusted By More Than %s Customers', 'ini-dental' ), esc_html( $trusted ) ); ?></p>
        </div>
        <?php ini_image( $image, 'ini-about', __( 'Dentist treating patient', 'ini-dental' ), __( 'Dentist treating patient — gloves and mask', 'ini-dental' ) ); ?>
      </div>

      <!-- Copy side -->
      <div class="about-copy">
        <h2><?php echo esc_html( $title ); ?></h2>
        <p><?php echo esc_html( $desc ); ?></p>

        <div class="vm-grid">
          <div class="vm">
            <span class="vm-ico y">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="12" r="1" fill="currentColor"/>
              </svg>
            </span>
            <div>
              <h5><?php echo esc_html( $vision_title ); ?></h5>
              <p><?php echo esc_html( $vision_desc ); ?></p>
            </div>
          </div>
          <div class="vm">
            <span class="vm-ico c">
              <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 12l5 5L21 4"/>
              </svg>
            </span>
            <div>
              <h5><?php echo esc_html( $mission_title ); ?></h5>
              <p><?php echo esc_html( $mission_desc ); ?></p>
            </div>
          </div>
        </div>

        <div class="about-foot">
          <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-yellow">
            <?php echo esc_html( $cta_label ); ?>
          </a>
          <div class="ceo">
            <div class="av">
              <?php ini_image( $ceo_image, 'ini-avatar', esc_attr( $ceo_name ), 'CEO portrait' ); ?>
            </div>
            <div>
              <h6><?php echo esc_html( $ceo_name ); ?></h6>
              <small><?php echo esc_html( $ceo_title ); ?></small>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
