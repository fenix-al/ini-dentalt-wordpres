<?php
defined( 'ABSPATH' ) || exit;

$title     = ini_mod( 'blog_title',     'Latest Blog & Article' );
$desc      = ini_mod( 'blog_desc',      'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' );
$cta_label = ini_mod( 'blog_cta_label', 'Visit Our Blog' );
$cta_url   = ini_mod( 'blog_cta_url',   get_permalink( get_option( 'page_for_posts' ) ) ?: '#' );
$count     = absint( ini_mod( 'blog_count', 4 ) );

$posts = get_posts( [
  'numberposts'      => $count,
  'post_status'      => 'publish',
  'suppress_filters' => false,
] );
?>

<section class="blog" id="blog">
  <div class="wrap">
    <div class="blog-head">
      <div>
        <h2><?php echo esc_html( $title ); ?></h2>
        <p><?php echo esc_html( $desc ); ?></p>
      </div>
      <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-yellow">
        <?php echo esc_html( $cta_label ); ?>
      </a>
    </div>

    <?php if ( ! empty( $posts ) ) : ?>
    <div class="blog-grid">
      <?php foreach ( $posts as $post ) :
        setup_postdata( $post );
        $thumb = get_the_post_thumbnail( $post->ID, 'ini-blog' );
        ?>
        <article class="blog-card">
          <?php if ( $thumb ) : ?>
            <div class="blog-figure">
              <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
                <?php echo $thumb; ?>
              </a>
            </div>
          <?php endif; ?>
          <div class="blog-meta">
            <?php echo get_the_date( '', $post->ID ); ?>
          </div>
          <h4>
            <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
              <?php echo esc_html( get_the_title( $post->ID ) ); ?>
            </a>
          </h4>
          <p><?php echo esc_html( get_the_excerpt( $post->ID ) ); ?></p>
        </article>
      <?php endforeach; wp_reset_postdata(); ?>
    </div>
    <?php else : ?>
      <p class="no-posts"><?php esc_html_e( 'No blog posts yet. Start publishing to see them here.', 'ini-dental' ); ?></p>
    <?php endif; ?>
  </div>
</section>
