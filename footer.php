<?php
/**
 * Footer Template
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * This file is called with get_footer().
 * Save this file as footer-{filename}.php to save a specialised footer. You can call it with get_footer('filename').
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/reference/functions/get_footer/
 */
?>
    </main> <!-- #main-body -->
    <footer id="site-footer">
      <section id="main-footer">
        <div class="container row clearfix">
          <aside class="footer-sidebar col-3" id="footerbar-one">
            <?php if ( is_active_sidebar( 'footerbar-one' ) && dynamic_sidebar( 'footerbar-one' ) ) : ?>
            <?php else : ?>
              <!-- Footer Sidebar One is missing content -->
            <?php endif; ?>
          </aside> <!-- #footerbar-one -->
          <aside class="footer-sidebar col-3" id="footerbar-two">
            <?php if ( is_active_sidebar( 'footerbar-two' ) && dynamic_sidebar( 'footerbar-two' ) ) : ?>
            <?php else : ?>
              <!-- Footer Sidebar Two is missing content -->
            <?php endif; ?>
          </aside> <!-- #footerbar-two -->
          <aside class="footer-sidebar col-3" id="footerbar-three">
            <?php if ( is_active_sidebar( 'footerbar-three' ) && dynamic_sidebar( 'footerbar-three' ) ) : ?>
            <?php else : ?>
              <!-- Footer Sidebar Three is missing content -->
            <?php endif; ?>
          </aside> <!-- #footerbar-three -->
          <aside class="footer-sidebar col-3" id="footerbar-four">
            <?php if ( is_active_sidebar( 'footerbar-four' ) && dynamic_sidebar( 'footerbar-four' ) ) : ?>
            <?php else : ?>
              <!-- Footer Sidebar Four is missing content -->
            <?php endif; ?>
          </aside> <!-- #footerbar-four -->
        </div> <!-- .container.row -->
      </section> <!-- #main-footer -->
      <section id="footer-copyright">
        <div class="container">
          <p class="copyright">
            <?php echo '&copy; ' . date("Y") . " " . get_bloginfo('name') . '. All rights reserved.'; ?>
          </p>
          <p class="login"><?php
            if ( is_user_logged_in() ){ ?>
              <a href="<?php echo admin_url(); ?>">Dashboard</a> | <a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
            <?php } else { ?>
              <a href="<?php echo wp_login_url( home_url() ); ?>">Login</a>
            <?php } ?></p>
        </div> <!-- .container -->
      </section> <!-- #footer-copyright -->
    </footer> <!-- #site-footer -->
  </div> <!-- #page-wrap -->
  <?php wp_footer(); ?>
  <!-- Don't forget to add analytics -->
</body>
</html>
