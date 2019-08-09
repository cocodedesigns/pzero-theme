<?php
/***** Custom Tag Cloud Code without the need of a Plugin. 
       Tested up to WordPress version 3.1.2 *****/
 
/** Function that generates Tag colors based on their weight (number of posts per Tag)
If nothing gets passed in to the function for $min_color and $max_color, it skips the function
and uses the defined link color in the CSS.  If only one color is passed, it is used for both.
Function is based on Version 5.2 of the Configurable Tag Cloud plugin **/
 
function color_weight($weight, $min_color, $max_color) {
    if ($min_color == "" && $max_color == "")
        return;
 
    if ($min_color == "") {
        $color = $max_color;
        return $color;
    }
    if ($max_color == "") {
        $color = $min_color;
        return $color;
    }
    if ($weight) {
        $weight = $weight/100;
 
        //hack to handle CSS shorthand color definitions (i.e., #000 instead of #000000)
        //strlen — Get string length (http://php.net/manual/en/function.strlen.php)
        if (strlen($min_color) == 4) {
            //substr — Return part of a string (http://php.net/manual/en/function.substr.php)
            $r = substr($min_color, 1, 1);
            $g = substr($min_color, 2, 1);
            $b = substr($min_color, 3, 1);
 
            $min_color = "#$r$r$g$g$b$b";
        }
        if (strlen($max_color) == 4) {
            $r = substr($max_color, 1, 1);
            $g = substr($max_color, 2, 1);
            $b = substr($max_color, 3, 1);
 
            $max_color = "#$r$r$g$g$b$b";
        }
        //hexdec — Hexadecimal to decimal (http://php.net/manual/en/function.hexdec.php)
        $minr = hexdec(substr($min_color, 1, 2));
        $ming = hexdec(substr($min_color, 3, 2));
        $minb = hexdec(substr($min_color, 5, 2));
 
        $maxr = hexdec(substr($max_color, 1, 2));
        $maxg = hexdec(substr($max_color, 3, 2));
        $maxb = hexdec(substr($max_color, 5, 2));
 
        //intval — Get the integer value (http://php.net/manual/en/function.intval.php)
        $r = dechex(intval((($maxr - $minr) * $weight) + $minr));
        $g = dechex(intval((($maxg - $ming) * $weight) + $ming));
        $b = dechex(intval((($maxb - $minb) * $weight) + $minb));
 
        if (strlen($r) == 1) $r = "0".$r;
        if (strlen($g) == 1) $g = "0".$g;
        if (strlen($b) == 1) $b = "0".$b;
 
        $color = "#$r$g$b";
        $color = substr($color,0,7);
         
        return $color;
    }
}
 
/*** Function that Generates an HTML string that makes the Tag Cloud ****/
//See Reference: http://codex.wordpress.org/Template_Tags/wp_generate_tag_cloud
//This function is similar as 'wp_generate_tag_cloud()' located in: 'wp-includes/category-template.php'
//Major difference: This function COLORS the Tags in the cloud based on their 
//weight (number of posts attached to the Tag) as shown in the short code. 
  
function bac_generate_tag_cloud( $tags, $args = '' ) {
    global $wp_rewrite;
    $defaults = array( //***KEEP THE DEFAULTS DON'T TOUCH.***
        'smallest' => 8, 'largest' => 22, 'unit' => 'pt', 'number' => 0,
        'format' => 'flat', 'separator' => "\n", 'orderby' => 'name', 'order' => 'ASC',
        'topic_count_text_callback' => 'default_topic_count_text',
        'topic_count_scale_callback' => 'default_topic_count_scale', 'filter' => 1,
    );
    //!isset — Determine if a variable is NOT set or is NULL (http://php.net/manual/en/function.isset.php)
    if ( !isset( $args['topic_count_text_callback'] ) && isset( $args['single_text'] ) && isset( $args['multiple_text'] ) ) {
        //var_export — returns a parsable string representation of a variable (http://php.net/manual/en/function.var-export.php)
        $body = 'return sprintf (
            _n(' . var_export($args['single_text'], true) . ', ' . var_export($args['multiple_text'], true) . ', $count),
            number_format_i18n( $count ));';
        //create_function — Create an anonymousfunction (http://php.net/manual/en/function.create-function.php)
        $args['topic_count_text_callback'] = create_function('$count', $body);
    }
    $args = wp_parse_args( $args, $defaults );
    //extract — Import variables into the current symbol table from an array (http://php.net/manual/en/function.extract.php)
    extract( $args );
 
    if ( empty( $tags ) )
        return;
 
    $tags_sorted = apply_filters( 'tag_cloud_sort', $tags, $args );
    if ( $tags_sorted != $tags  ) { // the tags have been sorted by a plugin
        $tags = $tags_sorted;
        unset($tags_sorted);
    } else {
        if ( 'RAND' == $order ) {
            shuffle($tags);
        } else {
            // SQL cannot save you; this is a second (potentially different) sort on a subset of data.
            if ( 'name' == $orderby )
                uasort( $tags, create_function('$a, $b', 'return strnatcasecmp($a->name, $b->name);') );
            else
                uasort( $tags, create_function('$a, $b', 'return ($a->count > $b->count);') );
 
            if ( 'DESC' == $order )
                $tags = array_reverse( $tags, true );
        }
    }
    if ( $number > 0 )
        $tags = array_slice($tags, 0, $number);
 
    $counts = array();
    $real_counts = array(); // For the alt Tag
    foreach ( (array) $tags as $key => $tag ) {
        $real_counts[ $key ] = $tag->count;
        $counts[ $key ] = $topic_count_scale_callback($tag->count);
    }
    $min_count = min( $counts );
    $spread = max( $counts ) - $min_count;
    if ( $spread <= 0 )
        $spread = 1;
    $font_spread = $largest - $smallest;
    if ( $font_spread < 0 )
        $font_spread = 1;
    $font_step = $font_spread / $spread;
 
    $a = array();
 
    foreach ( $tags as $key => $tag ) {
        $count = $counts[ $key ];
        $real_count = $real_counts[ $key ];
        $tag_link = '#' != $tag->link ? esc_url( $tag->link ) : '#';
        $tag_id = isset($tags[ $key ]->id) ? $tags[ $key ]->id : $key;
        $tag_name = $tags[ $key ]->name;
         
        /* Short code that changes the Tag color based on its weight (how many posts are attached to each Tag.) */
        //Define Variable: Beginning color for Tag. format" "#xxx" or "#xxxxxx" where x = [0-9,a-f]
        //If both variables are not defined it uses the Tag color as defined in the CSS document.
        $min_color = "#5679B9"; //***MODIFY TO WHAT YOU LIKE***
          
        //Define Variable: Ending color for Tag. format" "#xxx or "#xxxxxx"
        $max_color = "#AF1410"; //***MODIFY TO WHAT YOU LIKE***
         
        if ($largest == $smallest)
            $tag_weight = $largest;
        else
            $tag_weight = ($smallest+(($count-$min_count)*$font_step));
             
        $diff = $largest-$smallest;
         
        if ($diff <= 0)
            $diff = 1;
        //round — Rounds a float (http://php.net/manual/en/function.round.php)  
        $color_weight = round(99*($tag_weight-$smallest)/($diff)+1);
         
        //this is the color_weight() functions defined above. 
        $tag_color = color_weight($color_weight, $min_color, $max_color);
                 
        //Modified to include Tag Link color.
        //call_user_func — Call a user function given by the first parameter (http://php.net/manual/en/function.call-user-func.php) 
        $a[] = "<a href='$tag_link' class='tag-link-$tag_id' title='" . esc_attr( call_user_func( $topic_count_text_callback, $real_count ) ) . "' style='font-size: " . 
            ( $smallest + ( ( $count - $min_count ) * $font_step ) )
            . "$unit;  color: $tag_color; background-color: inherit;'>$tag_name</a>"; //background-color is added for validation purposes.
        /*** End of short code ***/     
    }   
    switch ( $format ) :
    case 'array' :
        $return =& $a;
        break;
    case 'list' :
        $return = "<ul class='wp-tag-cloud'>\n\t<li>";
        //join — Alias of implode() (http://php.net/manual/en/function.join.php)
        $return .= join( "</li>\n\t<li>", $a );
        $return .= "</li>\n</ul>\n";
        break;
    default :
        $return = join( $separator, $a );
        break;
    endswitch;
         
        //Function to create a new filter hook (http://codex.wordpress.org/Function_Reference/apply_filters)
        return apply_filters( 'bac_generate_tag_cloud', $return, $tags, $args );
}
 
/*** Function that Displays the Tag Cloud ****/
//See Reference: http://codex.wordpress.org/Template_Tags/wp_tag_cloud 
//This function is similar as 'wp_tag_cloud()' located in: 'wp-includes/category-template.php'
//Major difference: This function excludes Tags in the cloud based on their weight as shown in the short code. 
function bac_tag_cloud($args) {
 
$defaults = array( // ***MODIFY TO WHAT YOU LIKE***
 
    'smallest' => 12,   //The smallest Tag (lowest count) is shown at size 12
    'largest' => 30,    //The largest Tag (highest count) is shown at size 30 
    'unit' => 'px',     //Unit of measure for the smallest and largest values. Can be any CSS value (pt, px, em, %). 
    'number' => 50,     //set how many tags to show (default is 45 tags in the Tag cloud list).
    'format' => 'flat', // Format of the cloud display (flat, list, array) 
    'separator' => "\n", //The text/space between tags. 
    'orderby' => 'name', //argument will accept 'name' or 'count' and defaults to 'name'.
    'order' => 'ASC',   //sort order, defaults to 'ASC' and can be 'DESC'
    'exclude' => '',   //Exclude a specific Tag by its Tag ID separated by commas.
    'include' =>'',   //Include a specific Tag by Tag ID separated by commas. Use 'exclude' or 'include', but not both.
    'link' => 'view',  //Set link to allow edit of a particular Tag.
    'taxonomy' => 'post_tag', //Taxonomy or array of taxonomies to use in generating the cloud. 
    'echo' => true //DO NOT TOUCH THIS.
); //***End Of MODIFY SECTION***
 
//wp_parse_args() is a generic utility for merging together an array of arguments and an array of default values. 
/*http://codex.wordpress.org/Function_Reference/wp_parse_args*/
$args = wp_parse_args( $args, $defaults );
//Retrieve the terms in taxonomy or list of taxonomies. 
/*http://codex.wordpress.org/Function_Reference/get_terms  ;    http://php.net/manual/en/function.array-merge.php*/
// Always query top tags
$tags = get_terms( $args['taxonomy'], array_merge( $args, array( 'orderby' => 'count', 'order' => 'DESC' ) ) ); 
 
//If there are no tags
if ( empty( $tags ))
    return; //ends execution of the current function
 
/***** Short Code that gives the user the option not to display Tags in the Cloud 
based on the Tag's weight (number of posts attached to the Tag.)  *****/
 
//Minimum number of posts per tags. ***MODIFY TO WHAT YOU LIKE***
$min_num = 1;  // Tags with less than this number of posts will not be displayed.
 
//maximum number of posts per tags. ***MODIFY TO WHAT YOU LIKE***
$max_num = 65; //Tags with more than this number of posts will not be displayed.
 
foreach($tags as $key => $tag)
    {   //If the post count of Tag is outside the range
        if($tag->count < $min_num || $tag->count > $max_num)
        {
            /*unset()-destroy a single element of an array - http://php.net/manual/en/function.unset.php*/
            unset($tags[$key]);
        }
    }
/*** End of short code ***/
 
foreach ( $tags as $key => $tag ) {
        if ( 'edit' == $args['link'] )
         
            //Displays a link to edit the current Tag, if the user is logged in and allowed to edit the Tag.
            /*http://codex.wordpress.org/Function_Reference/edit_tag_link*/
            $link = get_edit_tag_link( $tag -> term_id, $args['taxonomy'] );
        else
            //Returns permalink for a taxonomy term archive. 
            /*http://codex.wordpress.org/Function_Reference/get_term_link*/
            $link = get_term_link( intval($tag -> term_id), $args['taxonomy'] );
         
        //Check whether variable is a WordPress Error. 
        /*http://codex.wordpress.org/Function_Reference/is_wp_error*/
        if ( is_wp_error( $link ) )
            return false;
 
    $tags[ $key ] -> link = $link;
    $tags[ $key ] -> id = $tag -> term_id;
}
//Generates a Tag cloud (heatmap) from provided data. Located at: 
$return = bac_generate_tag_cloud( $tags, $args ); // Here is where those top tags get sorted according to $args
 
//Function to create a new filter hook.
/*http://codex.wordpress.org/Function_Reference/apply_filters*/
$return = apply_filters( 'bac_tag_cloud', $return, $args );
 
if ( 'array' == $args['format'] || empty($args['echo']) )
    return $return;
 
echo $return;
}
//Hooks a function to a specific filter action.
/*http://codex.wordpress.org/Function_Reference/add_filter*/
add_filter('wp_tag_cloud', 'bac_tag_cloud');