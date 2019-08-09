<ul>
<?php
  $args = array(
    'post_type' => 'testimonial',
    'orderby' => 'rand',
    'posts_per_page' => 6,
    'post_status' => 'publish'
  );
  $testimonials = new WP_Query( $args );
  if ( $testimonials->have_posts() ) {
    while ( $testimonials->have_posts() ) {
      $testimonials->the_post();
      ?>
      <li>
        <article id="testimonial-<?php echo get_the_ID(); ?>">
          <div class="quote wrapped-content">
            <p title="<?php echo get_post_meta( get_the_ID(), 'testimonial', true ); ?>"><?php echo get_post_meta( get_the_ID(), 'testimonial', true ); ?></p>
          </div>
          <div class="who-by wrapped-content">
            <p><?php echo get_post_meta( get_the_ID(), 'person_from', true ); ?>, <?php echo get_post_meta(get_the_ID(), 'company_from', true ); ?></p>
          </div>
        </article>
      </li>
      <?php
    } wp_reset_postdata();
  }
  else {
    echo 'No one likes us!';
  }
?>
</ul>
<script>
  jQuery.fn.verticalAlign = function () {
    return this
        .css("padding-top",(($(this).parent().height()/2) - $(this).height()/2) + 'px' );
        alert(($(this).parent().height() - $(this).height()/2) + 'px');
  };
  $('#testimonials article .quote p').verticalAlign();
$('#testimonials').unslider({
	speed: 700,               //  The speed to animate each slide (in milliseconds)
	delay: 6000,              //  The delay between slide animations (in milliseconds)
	complete: function() {},  //  A function that gets called after every slide animation
	keys: false,               //  Enable keyboard (left, right) arrow shortcuts
	dots: true,               //  Display dot navigation
	fluid: true              //  Support responsive design. May break non-responsive designs
});
</script>
<div class="clear"></div>