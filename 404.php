<?php get_header(); ?>

<main class="site-main" style="background:var(--hero-grad);min-height:70vh;display:flex;align-items:center;">
  <div class="wrap" style="text-align:center;padding:80px 0;">
    <h1 style="font-size:120px;font-weight:800;color:var(--cyan-400);line-height:1;margin:0;">404</h1>
    <h2 style="font-size:32px;font-weight:700;margin:16px 0 12px;"><?php esc_html_e( 'Page Not Found', 'ini-dental' ); ?></h2>
    <p style="color:var(--muted);margin:0 0 30px;max-width:480px;margin-left:auto;margin-right:auto;">
      <?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'ini-dental' ); ?>
    </p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-cyan">
      <?php esc_html_e( 'Go to Homepage', 'ini-dental' ); ?>
    </a>
  </div>
</main>

<?php get_footer(); ?>
