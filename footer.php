    </main>
    <footer id="zeroTheme-footer">
      <section id="zeroTheme-footerMain">
        <div class="container">
          <div class="footerCol" id="footerCol-one">
            <?php if ( is_active_sidebar( 'footer-sidebar-one' ) && !dynamic_sidebar( 'footer-sidebar-one' ) ) : ?>
              <!-- Footer Sidebar One is missing content -->
            <?php endif; ?>
          </div>
          <div class="footerCol" id="footerCol-two">
            <?php if ( is_active_sidebar( 'footer-sidebar-two' ) && !dynamic_sidebar( 'footer-sidebar-two' ) ) : ?>
              <!-- Footer Sidebar Two is missing content -->
            <?php endif; ?>
          </div>
          <div class="footerCol" id="footerCol-three">
            <?php if ( is_active_sidebar( 'footer-sidebar-three' ) && !dynamic_sidebar( 'footer-sidebar-three' ) ) : ?>
              <!-- Footer Sidebar Three is missing content -->
            <?php endif; ?>
          </div>
          <div class="footerCol" id="footerCol-four">
            <?php if ( is_active_sidebar( 'footer-sidebar-four' ) && !dynamic_sidebar( 'footer-sidebar-four' ) ) : ?>
              <!-- Footer Sidebar Four is missing content -->
            <?php endif; ?>
          </div>
        </div>
      </section>
      <section id="zeroTheme-footerCopyright">
        <div class="container">
          <p>&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></p>
          <p><?php
            if ( is_user_logged_in() ){ ?>
              <a href="<?php echo admin_url(); ?>">Dashboard</a> | <a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
            <?php } else { ?>
              <a href="<?php echo wp_login_url( get_permalink() ); ?>">Login</a>
            <?php } ?></p>
        </div>
      </section>
    </footer>
  </div>
  <?php wp_footer(); ?>
  <!-- Don't forget to add analytics -->
</body>
</html>
