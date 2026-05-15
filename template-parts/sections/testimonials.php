<?php
defined( 'ABSPATH' ) || exit;

$title    = ini_mod( 'testi_title', 'What People Say' );
$desc     = ini_mod( 'testi_desc',  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );
$cta      = ini_mod( 'testi_cta',   'Feedback' );
$cta_url  = ini_mod( 'testi_url',   '#' );

$reviews = [];
for ( $i = 1; $i <= 4; $i++ ) {
  $reviews[] = [
    'name'  => ini_mod( "testi{$i}_name",  "Reviewer {$i}" ),
    'role'  => ini_mod( "testi{$i}_role",  'Patient' ),
    'quote' => ini_mod( "testi{$i}_quote", 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.' ),
    'image' => ini_mod( "testi{$i}_image", 0 ),
  ];
}
?>

<section class="testimonials" id="testimonials">
  <div class="wrap">
    <div class="testi-grid">

      <!-- 2×2 cards -->
      <div class="testi-cards">
        <?php foreach ( $reviews as $r ) : ?>
          <div class="testi-card">
            <div class="testi-head">
              <div class="av">
                <?php ini_image( $r['image'], 'ini-avatar', esc_attr( $r['name'] ), $r['name'] ); ?>
              </div>
              <div>
                <h6><?php echo esc_html( $r['name'] ); ?></h6>
                <small><?php echo esc_html( $r['role'] ); ?></small>
              </div>
            </div>
            <p><?php echo esc_html( $r['quote'] ); ?></p>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Copy -->
      <div class="testi-copy">
        <h2><?php echo esc_html( $title ); ?></h2>
        <p><?php echo esc_html( $desc ); ?></p>
        <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-yellow">
          <?php echo esc_html( $cta ); ?>
        </a>
      </div>

    </div>
  </div>
</section>
