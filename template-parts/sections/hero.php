<?php
defined( 'ABSPATH' ) || exit;

$title       = ini_mod( 'hero_title',       'Healthy Teeth' );
$title2      = ini_mod( 'hero_title2',      'Happy Life' );
$desc        = ini_mod( 'hero_description', "At ini dental we combine modern technique with genuinely caring people. Walk in nervous, walk out smiling — that's our whole promise." );
$cta1_label  = ini_mod( 'hero_cta1_label',  'Get Started' );
$cta1_url    = ini_mod( 'hero_cta1_url',    '#appointment' );
$cta2_label  = ini_mod( 'hero_cta2_label',  'Play Video' );
$video_url   = ini_mod( 'hero_video_url',   '#' );
$members     = ini_mod( 'hero_members',     '567 +' );
$members_lbl = ini_mod( 'hero_members_lbl', 'Active Member' );
$hero_img    = ini_mod( 'hero_image',       0 );

$stat1_num   = ini_mod( 'hero_stat1_num', '15+' );
$stat1_lbl   = ini_mod( 'hero_stat1_lbl', 'Years Of Experience' );
$stat2_num   = ini_mod( 'hero_stat2_num', '18+' );
$stat2_lbl   = ini_mod( 'hero_stat2_lbl', 'Dentist Specialist' );
$stat3_num   = ini_mod( 'hero_stat3_num', '86+' );
$stat3_lbl   = ini_mod( 'hero_stat3_lbl', 'Patient Satisfaction' );
?>

<section class="topbar" id="hero">
  <div class="hero">
    <div class="wrap">
      <div class="hero-grid">

        <!-- Copy -->
        <div class="hero-copy">
          <h1>
            <?php echo esc_html( $title ); ?><br>
            <span class="accent"><?php echo esc_html( $title2 ); ?></span>
          </h1>
          <p><?php echo esc_html( $desc ); ?></p>
          <div class="hero-ctas">
            <a href="<?php echo esc_url( $cta1_url ); ?>" class="btn btn-yellow">
              <?php echo esc_html( $cta1_label ); ?>
            </a>
            <a href="<?php echo esc_url( $video_url ); ?>" class="play-btn ini-video-trigger" data-video="<?php echo esc_attr( $video_url ); ?>">
              <span class="play-icon">
                <svg viewBox="0 0 20 20"><path d="M5 3l12 7-12 7z"/></svg>
              </span>
              <?php echo esc_html( $cta2_label ); ?>
            </a>
          </div>
          <div class="members">
            <div class="avatars">
              <span class="av a1"></span>
              <span class="av a2"></span>
              <span class="av a3"></span>
              <span class="av a4"></span>
            </div>
            <div class="lbl">
              <b><?php echo esc_html( $members ); ?></b>
              <?php echo esc_html( $members_lbl ); ?>
            </div>
          </div>
        </div>

        <!-- Portrait -->
        <div class="hero-figure">
          <?php ini_image( $hero_img, 'ini-hero', __( 'Hero dentist portrait', 'ini-dental' ), __( 'Smiling dentist, arms crossed', 'ini-dental' ) ); ?>
        </div>

        <!-- Stats -->
        <div class="stat-stack">
          <div class="stat-card">
            <div class="stat-num"><?php echo esc_html( $stat1_num ); ?></div>
            <div class="stat-lbl"><?php echo esc_html( $stat1_lbl ); ?></div>
          </div>
          <div class="stat-card">
            <div class="stat-num"><?php echo esc_html( $stat2_num ); ?></div>
            <div class="stat-lbl"><?php echo esc_html( $stat2_lbl ); ?></div>
          </div>
          <div class="stat-card">
            <div class="stat-num"><?php echo esc_html( $stat3_num ); ?></div>
            <div class="stat-lbl"><?php echo esc_html( $stat3_lbl ); ?></div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
