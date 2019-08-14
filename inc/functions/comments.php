<?php
add_action('comment_form_logged_in_after','sr_comment_fields');
add_action('comment_form_after_fields','sr_comment_fields');
function sr_comment_fields(){
    if ( is_singular('chapter') ){
    ?>
    <input type="hidden" name="redirect_to" id="recirect_to" value="<?php the_permalink(); ?>" />
    <?php
    }
}

function sr_comment_redirect( $location ) {
    if ( isset( $_POST['redirect_to'] ) ) // Don't use "redirect_to", internal WP var
        $location = $_POST['redirect_to'].'#comments';
    return $location;
}

add_filter( 'comment_post_redirect', 'sr_comment_redirect' );

function comment_args(){
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? ' aria-required="true"' : '' );
    $args = array(
        'fields' => apply_filters(
            'comment_form_default_fields', array(
                'author' =>'<div class="comment-field single-text dual-col">' .
                            '<label for="author">Name ' .
                             ( $req ? '<span class="required-field">*</span>' : '' ) .
                             '</label>' .
                             '<input type="text" placeholder="Your name" name="author" id="author" value="' .
                             esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />' .
                           '</div>',
                'email'  => '<div class="comment-field single-text single-col">' .
                              '<label for="email">Email ' .
                              ( $req ? '<span class="required-field">*</span>' : '' ) .
                              '</label>' .
                              '<input id="email" placeholder="your-real-email@example.com" name="email" type="text" value="' . 
                              esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />' .
                            '</div>',
                'url'    => '<div class="comment-field single-text single-col">' .
                              '<label for="url">Website (if you have one) ' .
                              '</label>' .
                              '<input id="url" name="url" placeholder="http://your-site-name.com" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />' .
                            '</div>'
            )
        ),
        'comment_field' => '<div class="comment-field textarea dual-col">' .
                             '<label for="comment">Comment ' .
                             '</label>'.
                             '<textarea id="comment" name="comment" placeholder="Express your thoughts, idea or write feedback by clicking here & start an awesome comment" aria-required="true"></textarea>'.
                           '</div>',
        'title_reply' => 'Please Post Your Comments & Reviews',
        'class_submit' => 'comment-submit',
        'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <strong>%1$s</strong>. <a href="%2$s" title="Log out of this account">Log out?</a>' ), wp_get_current_user()->display_name, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
        'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
        'comment_notes_after' => ''
    );
    return $args;
}

function epic_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><span class="comment-type ">Pingback</span> <?php comment_author_link(); ?>[Edit]</p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class( array('clearfix') ); ?> id="comment-<?php comment_ID(); ?>">
      <div class="comment-grav"><?php echo get_avatar( $comment->comment_author_email, 48); ?></div>
      <div class="comment-data">
        <div class="comment-author"><p><?php echo $comment->comment_author; ?></p></div>
        <p class="comment-time"><span class="far fa-clock comment-time-icon"></span> <span class="comment-time-text"><?php printf(__('%1$s at %2$s'), get_comment_date(),get_comment_time()) ?></span></p>
        <?php echo apply_filters( 'the_content', $comment->comment_content ); ?>
        <?php echo ( $comment->comment_approved != "1" ? '<p class="awaiting-approval">Your commment is awaiting approval.</p>' : '' ); ?>
        <div class="reply">
          <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div><!-- .reply -->
      </div>
    </li>
    <?php
            break;
    endswitch;
}

function move_comment_field_to_bottom( $fields ){
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'move_comment_field_to_bottom' );

/*
 * Change the comment reply link to use 'Reply to &lt;Author First Name>'
 */
function add_comment_author_to_reply_link($link, $args, $comment){
 
    $comment = get_comment( $comment );
 
    // If no comment author is blank, use 'Anonymous'
    if ( empty($comment->comment_author) ) {
        if (!empty($comment->user_id)){
            $user=get_userdata($comment->user_id);
            $author=$user->user_login;
        } else {
            $author = __('Anonymous');
        }
    } else {
        $author = $comment->comment_author;
    }
 
    // If the user provided more than a first name, use only first name
    if(strpos($author, ' ')){
        $author = substr($author, 0, strpos($author, ' '));
    }
 
    // Replace Reply Link with "Reply to &lt;Author First Name>"
    $reply_link_text = $args['reply_text'];
    $link = str_replace($reply_link_text, 'Reply to <span class="comment-author-name">' . $author . '</span> <span class="comment-reply-icon fa fa-angle-right"></span>', $link);
 
    return $link;
}
add_filter('comment_reply_link', 'add_comment_author_to_reply_link', 10, 3);