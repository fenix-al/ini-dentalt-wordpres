<?php
defined( 'ABSPATH' ) || exit;

$section_title = ini_mod( 'services_title', 'What Services Do We Provide For You?' );
$section_desc  = ini_mod( 'services_desc',  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.' );

$services = [
  1 => [
    'title' => ini_mod( 'svc1_title', 'Root Canal Treatment' ),
    'desc'  => ini_mod( 'svc1_desc',  'Voluptate velit esse cillum dolore eu fugiat nulla pariatur.' ),
    'url'   => ini_mod( 'svc1_url',   '#' ),
    'image' => ini_mod( 'svc1_image', 0 ),
    'icon'  => '<path d="M12 2c-2.5 0-4 1.5-4 3 0 1.5.5 3 1 5 .3 1.2.5 3 .5 5 0 2 .5 6 2.5 7 2-1 2.5-5 2.5-7 0-2 .2-3.8.5-5 .5-2 1-3.5 1-5 0-1.5-1.5-3-4-3z"/>',
  ],
  2 => [
    'title' => ini_mod( 'svc2_title', 'Oral Surgery' ),
    'desc'  => ini_mod( 'svc2_desc',  'Voluptate velit esse cillum dolore eu fugiat nulla pariatur.' ),
    'url'   => ini_mod( 'svc2_url',   '#' ),
    'image' => ini_mod( 'svc2_image', 0 ),
    'icon'  => '<path d="M6 14l3-3 3 3 6-6 3 3-9 9-6-6z" opacity=".7"/><circle cx="9" cy="11" r="2"/>',
  ],
  3 => [
    'title' => ini_mod( 'svc3_title', 'Cosmetic Dentistry' ),
    'desc'  => ini_mod( 'svc3_desc',  'Voluptate velit esse cillum dolore eu fugiat nulla pariatur.' ),
    'url'   => ini_mod( 'svc3_url',   '#' ),
    'image' => ini_mod( 'svc3_image', 0 ),
    'icon'  => '<path d="M12 4c-4 0-7 2-7 5 0 2.5 2 4.5 3 5l1 6 3-2 3 2 1-6c1-.5 3-2.5 3-5 0-3-3-5-7-5z"/>',
  ],
];
?>

<section class="services" id="services">
  <div class="wrap">
    <div class="svc-head">
      <h2><?php echo esc_html( $section_title ); ?></h2>
      <p><?php echo esc_html( $section_desc ); ?></p>
    </div>
    <div class="svc-grid">
      <?php foreach ( $services as $svc ) : ?>
        <article class="svc-card">
          <div class="svc-figure">
            <?php ini_image( $svc['image'], 'ini-service', esc_attr( $svc['title'] ), $svc['title'] ); ?>
            <span class="svc-badge">
              <svg viewBox="0 0 24 24" fill="#1a1a1a"><?php echo $svc['icon']; ?></svg>
            </span>
          </div>
          <div class="svc-body">
            <h4><?php echo esc_html( $svc['title'] ); ?></h4>
            <p><?php echo esc_html( $svc['desc'] ); ?></p>
            <a href="<?php echo esc_url( $svc['url'] ); ?>" class="learn">
              <?php esc_html_e( 'LEARN MORE', 'ini-dental' ); ?>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
