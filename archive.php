<?php get_header(); ?>

<main class="site-main">
  <!-- Archive header -->
  <div style="background:var(--hero-grad);padding:70px 0 50px;">
    <div class="wrap">
      <h1 style="font-size:42px;font-weight:700;margin:0 0 12px;"><?php the_archive_title(); ?></h1>
      <?php the_archive_description( '<p style="color:var(--muted);max-width:600px;margin:0;">', '</p>' ); ?>
    </div>
  </div>

  <div class="wrap" style="padding:60px 0 80px;">
    <?php if ( have_posts() ) : ?>
      <div class="blog-grid">
        <?php while ( have_posts() ) : the_post(); ?>
          <article class="blog-card" <?php post_class(); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="blog-figure">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'ini-blog' ); ?></a>
              </div>
            <?php endif; ?>
            <div class="blog-meta"><?php echo get_the_date(); ?></div>
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <p><?php the_excerpt(); ?></p>
          </article>
        <?php endwhile; ?>
      </div>
      <?php ini_dental_pagination(); ?>
    <?php else : ?>
      <p><?php esc_html_e( 'No posts found.', 'ini-dental' ); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php
ini_render_section( 'newsletter' );
get_footer();
