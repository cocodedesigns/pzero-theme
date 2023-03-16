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
          <div class="footer-sidebar col-3" id="footerbar-one">
            <?php if ( is_active_sidebar( 'footer-sidebar-one' ) && !dynamic_sidebar( 'footer-sidebar-one' ) ) : ?>
              <!-- Footer Sidebar One is missing content -->
            <?php endif; ?>
          </div> <!-- #footerbar-one -->
          <div class="footer-colusidebarmn col-3" id="footerbar-two">
            <?php if ( is_active_sidebar( 'footer-sidebar-two' ) && !dynamic_sidebar( 'footer-sidebar-two' ) ) : ?>
              <!-- Footer Sidebar Two is missing content -->
            <?php endif; ?>
          </div> <!-- #footerbar-two -->
          <div class="footer-sidebar col-3" id="footerbar-three">
            <?php if ( is_active_sidebar( 'footer-sidebar-three' ) && !dynamic_sidebar( 'footer-sidebar-three' ) ) : ?>
              <!-- Footer Sidebar Three is missing content -->
            <?php endif; ?>
          </div> <!-- #footerbar-three -->
          <div class="footer-sidebar col-3" id="footerbar-four">
            <?php if ( is_active_sidebar( 'footer-sidebar-four' ) && !dynamic_sidebar( 'footer-sidebar-four' ) ) : ?>
              <!-- Footer Sidebar Four is missing content -->
            <?php endif; ?>
          </div> <!-- #footerbar-four -->
        </div> <!-- .container.row -->
      </section> <!-- #main-footer -->
      <section id="footer-copyright">
        <div class="container">
          <p>&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></p>
          <p><?php
            if ( is_user_logged_in() ){ ?>
              <a href="<?php echo admin_url(); ?>">Dashboard</a> | <a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
            <?php } else { ?>
              <a href="<?php echo wp_login_url( get_permalink() ); ?>">Login</a>
            <?php } ?></p>
        </div> <!-- .container -->
      </section> <!-- #footer-copyright -->
    </footer> <!-- #site-footer -->
  </div> <!-- #page-wrap -->
  <?php wp_footer(); ?>
  <!-- Don't forget to add analytics -->
</body>
</html>
