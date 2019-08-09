<?php
// Blog Multi-page navigation
function post_page_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation archive-navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li class="next-prev-link">%s</li>' . "\n", get_previous_posts_link('<span class="fa fa-angle-left"></span>') );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : ' class="inactive" ';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : ' class="inactive" ';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : ' class="inactive" ';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li class="next-prev-link">%s</li>' . "\n", get_next_posts_link('<span class="fa fa-angle-right"></span>') );

	echo '</ul></div>' . "\n";

}

// Page Navigation (Next / Prev)
function page_pagination( $echo = 1 ){
    global $page, $numpages, $multipage, $more;
    if( $multipage ) { //probably you should add && $more to this condition.
        $next_text = "Next Page"; $prev_text = "Previous Page";
        if( $page < $numpages ) { $next = _wp_link_page( $i = $page + 1 ); $next_link = '<span class="next-page page-link">' . $next . $next_text . '</a></span>'; }
        else { $next_link = '<span class="next-page page link">' . $next_text . '</span>'; }
        if( $i = ( $page - 1 ) ) { $prev = _wp_link_page( $i ); $prev_link = '<span class="prev-page page-link">' . $prev . $prev_text . '</a></span>'; }
        else { $prev_link = '<span class="prev-page page link">' . $prev_text . '</span>'; }
        $output = "<div class=\"prev-next-page\">" . $prev_link  . "<span class=\"page-counter\">{$page} of {$numpages}</span>" . $next_link . "</div>";
    }
    if( $echo ){ echo $output; }
    return $output;
}