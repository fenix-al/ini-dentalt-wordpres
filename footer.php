<?php
$socials   = ini_socials();
$copyright = ini_mod( 'footer_copyright', '© ' . date( 'Y' ) . ' ini dental. All rights reserved.' );
$cta_text  = ini_mod( 'footer_cta_text', '' );
?>

<footer id="colophon">
  <?php if ( $cta_text ) : ?>
  <div class="foot-cta"><?php echo esc_html( $cta_text ); ?></div>
  <?php endif; ?>

  <div class="wrap">
    <div class="foot-grid">

      <!-- Brand column -->
      <div class="foot-col">
        <div class="foot-brand">
          <span class="logo-mark">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2c-2.5 0-4 1.5-4 3 0 1.5.5 3 1 5 .3 1.2.5 3 .5 5 0 2 .5 6 2.5 7 2-1 2.5-5 2.5-7 0-2 .2-3.8.5-5 .5-2 1-3.5 1-5 0-1.5-1.5-3-4-3z"/>
            </svg>
          </span>
          <?php
            $brand = ini_mod( 'brand_name', 'ini dental' );
            $parts = explode( ' ', $brand, 2 );
            echo esc_html( $parts[0] );
            if ( isset( $parts[1] ) ) {
                echo ' <em style="font-style:normal;color:var(--cyan-400)">' . esc_html( $parts[1] ) . '</em>';
            }
          ?>
        </div>
        <p><?php ini_mod_e( 'footer_about', 'Purus viverra accumsan in nisl nisi scelerisque eu ultrices.' ); ?></p>
        <div class="socials">
          <?php if ( $socials['facebook'] && $socials['facebook'] !== '#' ) : ?>
          <a href="<?php echo esc_url( $socials['facebook'] ); ?>" aria-label="Facebook">
            <svg viewBox="0 0 24 24"><path d="M13 22V12h3l1-4h-4V6c0-1 .3-2 2-2h2V0h-3c-3 0-5 2-5 5v3H6v4h3v10z"/></svg>
          </a>
          <?php endif; ?>
          <?php if ( $socials['twitter'] && $socials['twitter'] !== '#' ) : ?>
          <a href="<?php echo esc_url( $socials['twitter'] ); ?>" aria-label="Twitter / X">
            <svg viewBox="0 0 24 24"><path d="M22 5.8c-.7.3-1.5.5-2.4.6.9-.5 1.5-1.3 1.9-2.3-.9.5-1.8.9-2.8 1-.8-.9-2-1.4-3.3-1.4-2.5 0-4.5 2-4.5 4.5 0 .4 0 .7.1 1-3.7-.2-7-2-9.2-4.7-.4.7-.6 1.5-.6 2.3 0 1.6.8 3 2 3.8-.7 0-1.5-.2-2-.5 0 2.2 1.6 4 3.7 4.5-.4.1-.8.2-1.2.2-.3 0-.6 0-.8-.1.6 1.8 2.3 3.2 4.3 3.2-1.6 1.2-3.5 2-5.7 2H1c2 1.3 4.4 2 7 2 8.4 0 13-7 13-13v-.6c.9-.6 1.6-1.4 2.2-2.3z"/></svg>
          </a>
          <?php endif; ?>
          <?php if ( $socials['instagram'] && $socials['instagram'] !== '#' ) : ?>
          <a href="<?php echo esc_url( $socials['instagram'] ); ?>" aria-label="Instagram">
            <svg viewBox="0 0 24 24"><path d="M12 2c-5.5 0-10 4.5-10 10s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm6 6h-2c-.5 0-1 .3-1 1v2h3l-.5 3H15v7h-3v-7H10v-3h2V8.5c0-1.7 1.3-3 3-3h3z"/></svg>
          </a>
          <?php endif; ?>
          <?php if ( $socials['linkedin'] && $socials['linkedin'] !== '#' ) : ?>
          <a href="<?php echo esc_url( $socials['linkedin'] ); ?>" aria-label="LinkedIn">
            <svg viewBox="0 0 24 24"><path d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm3.5 17v-9H6v9zm-1.2-10.3a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM20 20v-5c0-2.7-1.5-4-3.5-4-1.6 0-2.3.9-2.7 1.5V11h-3v9h3v-5c0-.3 0-.5.1-.7.2-.5.7-1 1.5-1 1 0 1.5.8 1.5 1.9V20z"/></svg>
          </a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="foot-col">
        <h5><?php esc_html_e( 'Quick Links', 'ini-dental' ); ?></h5>
        <?php
        wp_nav_menu( [
          'theme_location' => 'footer',
          'container'      => false,
          'fallback_cb'    => function () {
              echo '<ul><li><a href="#">Home</a></li><li><a href="#">Services</a></li><li><a href="#">Our Dentist</a></li><li><a href="#">Contact</a></li></ul>';
          },
        ] );
        ?>
      </div>

      <!-- Features Page links -->
      <div class="foot-col">
        <h5><?php esc_html_e( 'Features Page', 'ini-dental' ); ?></h5>
        <ul>
          <li><a href="<?php echo esc_url( ini_mod( 'nav_cta_url', '#' ) ); ?>"><?php esc_html_e( 'Appointment', 'ini-dental' ); ?></a></li>
          <li><a href="#"><?php esc_html_e( 'Dental Profile', 'ini-dental' ); ?></a></li>
          <li><a href="#"><?php esc_html_e( 'Terms &amp; Services', 'ini-dental' ); ?></a></li>
          <li><a href="#"><?php esc_html_e( 'Privacy Policy', 'ini-dental' ); ?></a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="foot-col">
        <h5><?php esc_html_e( 'Contact Info', 'ini-dental' ); ?></h5>
        <ul>
          <?php $address = ini_mod( 'footer_address', '' ); if ( $address ) : ?>
          <li class="contact-li">
            <svg viewBox="0 0 24 24"><path d="M12 2C8 2 5 5 5 9c0 5 7 13 7 13s7-8 7-13c0-4-3-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/></svg>
            <?php echo esc_html( $address ); ?>
          </li>
          <?php endif; ?>
          <?php $phone = ini_mod( 'footer_phone', '' ); if ( $phone ) : ?>
          <li class="contact-li">
            <svg viewBox="0 0 24 24"><path d="M20 15.5c-1.2 0-2.5-.2-3.6-.6a1 1 0 00-1 .2l-2.2 2.2a15.1 15.1 0 01-6.6-6.6l2.2-2.2a1 1 0 00.2-1A11.4 11.4 0 018.5 4a1 1 0 00-1-1H4a1 1 0 00-1 1A17 17 0 0020 21a1 1 0 001-1v-3.5a1 1 0 00-1-1z"/></svg>
            <a href="tel:<?php echo esc_attr( preg_replace( '/\D/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
          </li>
          <?php endif; ?>
          <?php $email = ini_mod( 'footer_email', '' ); if ( $email ) : ?>
          <li class="contact-li">
            <svg viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zm0 4l-8 5-8-5V6l8 5 8-5z"/></svg>
            <a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( $email ); ?></a>
          </li>
          <?php endif; ?>
        </ul>
      </div>

    </div>
  </div>

  <div class="foot-base">
    <?php echo wp_kses_post( $copyright ); ?>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
