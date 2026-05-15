<?php
defined( 'ABSPATH' ) || exit;

$features = [
  1 => [
    'title' => ini_mod( 'feat1_title', 'Service Satisfaction' ),
    'desc'  => ini_mod( 'feat1_desc',  'Reprehenderit in voluptate velit esse cillum dolore.' ),
    'color' => 'cyan',
    'icon'  => '<path d="M12 2c-2.5 0-4 1.5-4 3 0 1.5.5 3 1 5 .3 1.2.5 3 .5 5 0 2 .5 6 2.5 7 2-1 2.5-5 2.5-7 0-2 .2-3.8.5-5 .5-2 1-3.5 1-5 0-1.5-1.5-3-4-3z"/>',
  ],
  2 => [
    'title' => ini_mod( 'feat2_title', 'Latest Technology' ),
    'desc'  => ini_mod( 'feat2_desc',  'Reprehenderit in voluptate velit esse cillum dolore.' ),
    'color' => 'yellow',
    'icon'  => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
  ],
  3 => [
    'title' => ini_mod( 'feat3_title', 'Professional Dentist' ),
    'desc'  => ini_mod( 'feat3_desc',  'Reprehenderit in voluptate velit esse cillum dolore.' ),
    'color' => 'cyan',
    'icon'  => '<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>',
  ],
];
?>

<section class="features" id="features">
  <div class="wrap">
    <div class="features-grid">
      <?php foreach ( $features as $feat ) : ?>
        <div class="feat">
          <span class="feat-ico <?php echo esc_attr( $feat['color'] ); ?>">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="<?php echo $feat['color'] === 'yellow' ? '#1a1a1a' : 'currentColor'; ?>"
                 stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <?php echo $feat['icon']; ?>
            </svg>
          </span>
          <div>
            <h4><?php echo esc_html( $feat['title'] ); ?></h4>
            <p><?php echo esc_html( $feat['desc'] ); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
