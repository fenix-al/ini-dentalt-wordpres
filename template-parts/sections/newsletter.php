<?php
defined( 'ABSPATH' ) || exit;

$title       = ini_mod( 'news_title',       'Subscribe Our Newsletter' );
$desc        = ini_mod( 'news_desc',        'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ut elit tellus, luctus nec ullamcorper mattis.' );
$placeholder = ini_mod( 'news_placeholder', 'Your Email Address' );
$btn_label   = ini_mod( 'news_btn_label',   'Sign Up' );

$subscribed = false;
$sub_error  = '';

if ( isset( $_POST['ini_newsletter_nonce'] ) && wp_verify_nonce( $_POST['ini_newsletter_nonce'], 'ini_newsletter' ) ) {
  $email = sanitize_email( $_POST['newsletter_email'] ?? '' );
  if ( is_email( $email ) ) {
    // Hook for integrations (Mailchimp, etc.)
    do_action( 'ini_dental_newsletter_subscribe', $email );
    $subscribed = true;
  } else {
    $sub_error = __( 'Please enter a valid email address.', 'ini-dental' );
  }
}
?>

<section class="newsletter" id="newsletter">
  <div class="wrap">
    <div class="news-grid">

      <div>
        <h3><?php echo esc_html( $title ); ?></h3>
        <p><?php echo esc_html( $desc ); ?></p>
      </div>

      <div>
        <?php if ( $subscribed ) : ?>
          <div style="background:#fff;padding:18px 24px;border-radius:6px;color:var(--ink);font-weight:600;">
            <?php esc_html_e( 'Thank you for subscribing! 🎉', 'ini-dental' ); ?>
          </div>
        <?php else : ?>
          <?php if ( $sub_error ) : ?>
            <p style="color:#c0392b;margin-bottom:8px;font-size:13px;"><?php echo esc_html( $sub_error ); ?></p>
          <?php endif; ?>
          <form class="news-form" method="post">
            <?php wp_nonce_field( 'ini_newsletter', 'ini_newsletter_nonce' ); ?>
            <input type="email" name="newsletter_email" placeholder="<?php echo esc_attr( $placeholder ); ?>" required>
            <button type="submit">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="#1a1a1a"><path d="M2 4l20 8-20 8 4-8z"/></svg>
              <?php echo esc_html( $btn_label ); ?>
            </button>
          </form>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
