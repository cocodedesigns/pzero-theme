<?php
/**
 * Comments display - List and Form
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * This template is used when calling comments_template().
 * If this file does not exist, WordPress will default to its fallback file in /wp-includes/theme-compat/comments.php.
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/reference/functions/comments_template/
 */

/**
 * Check if the script is being called directly and end the connection.
 * Protects against some script injection attacks.
 * DO NOT remove this function.
 */
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

/**
 * Checks if a password is required on the post and hides the comments.
 * DO NOT remove this function.
 */
  if ( post_password_required() ) { ?>
    <p class="nocomments">This post is password protected. Enter the password to view comments.</p>
  <?php
    return;
  }
?>

<?php 
/**
 * Displays comments list.
 */
if ( have_comments() ) : 

  /**
   * Displayed if there are comments.
   */
?>
  <h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

  <nav id="postnav_before" class="post-nextprev post-nav">
    <div><?php previous_comments_link() ?></div>
    <div><?php next_comments_link() ?></div>
  </nav> <!-- #postnav_before -->

  <ol id="commentlist" class="commentlist">
    <?php wp_list_comments( 'avatar_size=64' ); ?>
  </ol> <!-- #commentlist -->

  <nav id="postnav_after" class="post-nextprev post-nav">
    <div><?php previous_comments_link() ?></div>
    <div><?php next_comments_link() ?></div>
  </nav> <!-- #postnav_after -->

  <?php 
    /**
     * Displayed if there are no comments.
     */
    else : 
    
    /**
     * Displayed if comments are open, but there are no comments.
     */
    if ( comments_open() ) : 
  ?>

  <?php 
    /**
     * Displayed if comments are closed.
     */
    else : ?>
    <p class="nocomments">Comments are closed.</p>
  <?php endif; ?>
<?php endif; ?>

<?php 
/**
 * Displays comment form.
 */
if ( comments_open() ) : ?>
<section id="respond">

  <h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>

  <div class="cancel-comment-reply">
    <small><?php cancel_comment_reply_link(); ?></small>
  </div> <!-- .cancel-comment-reply -->

  <?php 
  /**
   * Checks if the user is logged in, and whether comment registration is open.
   */
  if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
  <p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
  <?php else : ?>

  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

  <?php 
  /**
   * If the registered user is logged in.
   */
  if ( is_user_logged_in() ) : ?>

  <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

  <?php else : ?>

  <p id="comment-author">
    <label for="author">Name <?php if ($req) echo "(required)"; ?></label>
    <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
  </p> <!-- #comment-author -->

  <p id="comment-email">
    <label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label>
    <input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
  </p> <!-- #comment-email -->

  <p id="comment-url">
    <label for="url">Website</label>
    <input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
  </p> <!-- #comment-url -->

  <?php endif; ?>

  <p id="comment-text">
    <label for="comment">Your comment</label>
    <textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
  </p> <!-- #comment-text -->

  <p id="allowed_tags"><strong>XHTML:</strong> You can use these tags: <?php 
      global $allowedtags;

      foreach ( $allowedtags as $tag => $attributes ){
        echo '<code class="tag-' . $tag . ' tag allowed-tag">&lt;' . $tag;
        if ( count( $attributes ) > 0 ){
          foreach ( $attributes as $attribute => $limits ){
            echo ' ' . $attribute . '=&quot;&quot;';
          }
        }
        echo '&gt;</code> ';
      }
    ?></p> <!-- #allowed_tags -->

  <p id="comment-submit">
    <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
    <?php comment_id_fields(); ?>
  </p> <!-- #comment-submit -->
  <?php do_action('comment_form', $post->ID); ?>

  </form> <!-- #commentform -->

  <?php 
  /**
   * If registration required and not logged in
   */
    endif;
  ?>
</section> <!-- #respond -->
<?php 
/**
 * if you delete this, the sky will fall on your head.
 */
  endif; 
?>
