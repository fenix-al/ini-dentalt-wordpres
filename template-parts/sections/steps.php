<?php
defined( 'ABSPATH' ) || exit;

$title = ini_mod( 'steps_title', 'Easy Steps To Find The Best Solutions' );
$desc  = ini_mod( 'steps_desc',  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );

$step_icons = [
  1 => '<path d="M5 4h10l4 4v12H5z" fill="none" stroke="#1a1a1a" stroke-width="1.8" stroke-linejoin="round"/><path d="M8 12h8M8 16h6" stroke="#1a1a1a" stroke-width="1.8" stroke-linecap="round"/>',
  2 => '<circle cx="9" cy="8" r="3"/><path d="M3 20c0-3 2.7-5 6-5s6 2 6 5"/><circle cx="17" cy="6" r="2"/><path d="M14 13c1-1 2-1.5 3-1.5s2 .5 3 1.5"/>',
  3 => '<path d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7z"/><path d="M9 12l2 2 4-4"/>',
  4 => '<path d="M4 14h4l3 6 4-16 3 10h2"/>',
];

$steps = [];
for ( $i = 1; $i <= 4; $i++ ) {
  $steps[] = [
    'num'   => str_pad( $i, 2, '0', STR_PAD_LEFT ),
    'title' => ini_mod( "step{$i}_title", [ 'Make Appointment', 'Meet Our Dentist', 'Get The Solutions', 'Perform Treatment' ][ $i - 1 ] ),
    'desc'  => ini_mod( "step{$i}_desc",  'Voluptate velit esse cillum dolore eu fugiat nulla.' ),
    'icon'  => $step_icons[ $i ],
  ];
}
?>

<section class="steps" id="steps">
  <div class="wrap">
    <div class="steps-head">
      <h2><?php echo esc_html( $title ); ?></h2>
      <p><?php echo esc_html( $desc ); ?></p>
    </div>
    <div class="steps-grid">
      <?php foreach ( $steps as $step ) : ?>
        <div class="step">
          <span class="step-ico">
            <svg viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <?php echo $step['icon']; ?>
            </svg>
          </span>
          <h5><?php echo esc_html( $step['title'] ); ?></h5>
          <p><?php echo esc_html( $step['desc'] ); ?></p>
          <span class="num"><?php echo esc_html( $step['num'] ); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
