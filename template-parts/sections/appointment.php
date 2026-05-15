<?php
defined( 'ABSPATH' ) || exit;

$title    = ini_mod( 'appt_title',    'Make Appointment' );
$image    = ini_mod( 'appt_image',    0 );
$email_to = ini_mod( 'appt_email_to', get_option( 'admin_email' ) );
$services_raw = ini_mod( 'appt_services', "Root Canal Treatment\nOral Surgery\nCosmetic Dentistry" );
$services = array_filter( array_map( 'trim', explode( "\n", $services_raw ) ) );

// Handle form submission
$form_sent  = false;
$form_error = '';

if ( isset( $_POST['ini_appt_nonce'] ) && wp_verify_nonce( $_POST['ini_appt_nonce'], 'ini_appointment' ) ) {
  $name    = sanitize_text_field( $_POST['appt_name']    ?? '' );
  $email   = sanitize_email( $_POST['appt_email']        ?? '' );
  $date    = sanitize_text_field( $_POST['appt_date']    ?? '' );
  $service = sanitize_text_field( $_POST['appt_service'] ?? '' );
  $message = sanitize_textarea_field( $_POST['appt_msg'] ?? '' );

  if ( $name && $email && is_email( $email ) ) {
    $subject = sprintf( __( 'New Appointment Request — %s', 'ini-dental' ), $name );
    $body    = sprintf(
      "Name: %s\nEmail: %s\nDate: %s\nService: %s\n\nMessage:\n%s",
      $name, $email, $date, $service, $message
    );
    wp_mail( $email_to, $subject, $body, [ 'Reply-To: ' . $email ] );
    $form_sent = true;
  } else {
    $form_error = __( 'Please fill in your name and a valid email address.', 'ini-dental' );
  }
}
?>

<section class="appointment" id="appointment">
  <div class="wrap">
    <div class="appt-grid">

      <!-- Portrait -->
      <div class="appt-figure">
        <?php ini_image( $image, 'ini-hero', __( 'Dentist portrait', 'ini-dental' ), __( 'Female dentist portrait, full body', 'ini-dental' ) ); ?>
      </div>

      <!-- Form -->
      <div>
        <div class="appt-form">
          <h3><?php echo esc_html( $title ); ?></h3>

          <?php if ( $form_sent ) : ?>
            <div style="background:#e6f9ec;border:1px solid #b2e5bf;color:#1d6832;padding:18px;border-radius:6px;margin-bottom:20px;">
              <?php esc_html_e( 'Thank you! Your appointment request has been sent. We will contact you shortly.', 'ini-dental' ); ?>
            </div>
          <?php endif; ?>

          <?php if ( $form_error ) : ?>
            <div style="background:#fdecea;border:1px solid #f4b8b2;color:#8b1a0e;padding:18px;border-radius:6px;margin-bottom:20px;">
              <?php echo esc_html( $form_error ); ?>
            </div>
          <?php endif; ?>

          <form method="post" action="<?php echo esc_url( get_permalink() ); ?>#appointment">
            <?php wp_nonce_field( 'ini_appointment', 'ini_appt_nonce' ); ?>

            <div class="form-row">
              <input class="input" type="text"  name="appt_name"  placeholder="<?php esc_attr_e( 'Your Name', 'ini-dental' ); ?>" required
                     value="<?php echo esc_attr( sanitize_text_field( $_POST['appt_name'] ?? '' ) ); ?>">
              <input class="input" type="email" name="appt_email" placeholder="<?php esc_attr_e( 'Your Email', 'ini-dental' ); ?>" required
                     value="<?php echo esc_attr( sanitize_email( $_POST['appt_email'] ?? '' ) ); ?>">
            </div>

            <div class="form-row">
              <input class="input" type="date" name="appt_date" placeholder="<?php esc_attr_e( 'Date', 'ini-dental' ); ?>">
              <select class="select" name="appt_service">
                <option value=""><?php esc_html_e( 'Select Service', 'ini-dental' ); ?></option>
                <?php foreach ( $services as $svc ) : ?>
                  <option value="<?php echo esc_attr( $svc ); ?>"
                    <?php selected( sanitize_text_field( $_POST['appt_service'] ?? '' ), $svc ); ?>>
                    <?php echo esc_html( $svc ); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <textarea class="textarea" name="appt_msg" placeholder="<?php esc_attr_e( 'Send Message', 'ini-dental' ); ?>"><?php echo esc_textarea( sanitize_textarea_field( $_POST['appt_msg'] ?? '' ) ); ?></textarea>

            <button class="btn btn-yellow" type="submit">
              <?php esc_html_e( 'Appointment', 'ini-dental' ); ?>
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
