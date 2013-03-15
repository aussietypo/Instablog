<?php
/**
 * Insta functions
 *
 */
if ( ! isset( $content_width ) )
	$content_width = 806; /* pixels */

if ( ! function_exists( '_s_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since _s 1.0
 */
function _s_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', '_s' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // _s_setup
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since _s 1.0
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', '_s' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function _s_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/* hashtag function */

add_filter('the_tags', 'hashtag');

function hashtag($list) {
    $list = str_replace('rel="tag">', 'rel="tag">#', $list);
    return $list;
}

/* pagination function */

function pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


function sandbox_example_theme_menu() {

	add_theme_page(
		'Instablog Theme', 			// The title to be displayed in the browser window for this page.
		'Instablog Theme',			// The text to be displayed for this menu item
		'administrator',			// Which type of users can see this menu item
		'sandbox_theme_options',	// The unique ID - that is, the slug - for this menu item
		'sandbox_theme_display'		// The name of the function to call when rendering this menu's page
	);

} // end sandbox_example_theme_menu
add_action('admin_menu', 'sandbox_example_theme_menu');

function sandbox_theme_display() {
?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">

		<!-- Add the icon to the page -->
		<div id="icon-themes" class="icon32"></div>
		<h2>Instablog Theme Options</h2>

		<!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
		<?php settings_errors(); ?>

		<!-- Create the form that will be used to render our options -->

		<form method="post" action="options.php">
			<?php settings_fields( 'sandbox_theme_display_options' ); ?> 
            		<?php do_settings_sections( 'sandbox_theme_display_options' ); ?> 
			<?php submit_button(); ?>
		</form>

		<form method="post" action="options.php">
			<?php settings_fields( 'sandbox_theme_social_options' ); ?>
			<?php do_settings_sections( 'sandbox_theme_social_options' ); ?>
			<?php submit_button(); ?>
		</form>

	</div><!-- /.wrap -->
<?php
} // end sandbox_theme_display


/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */ 

function sandbox_theme_intialize_social_options() {

	// If the social options don't exist, create them.
	if( false == get_option( 'sandbox_theme_social_options' ) ) {
		add_option( 'sandbox_theme_social_options' );
	} // end if

	add_settings_section(
		'social_settings_section',			// ID used to identify this section and with which to register options
		'Social Options',					// Title to be displayed on the administration page
		'sandbox_social_options_callback',	// Callback used to render the description of the section
		'sandbox_theme_social_options'		// Page on which to add this section of options
	);

	add_settings_field(
		'twitter',
		'Twitter',
		'sandbox_twitter_callback',
		'sandbox_theme_social_options',
		'social_settings_section'
	);

	add_settings_field(
	'facebook',
	'Facebook',
	'sandbox_facebook_callback',
	'sandbox_theme_social_options',
	'social_settings_section'
	);

	add_settings_field(
	'googleplus',
	'Google+',
	'sandbox_googleplus_callback',
	'sandbox_theme_social_options',
	'social_settings_section'
	);

	register_setting(
		'sandbox_theme_social_options',
		'sandbox_theme_social_options',
		'sandbox_theme_sanitize_social_options'
	);


} // end sandbox_theme_intialize_social_options
add_action( 'admin_init', 'sandbox_theme_intialize_social_options' );

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */ 
function sandbox_social_options_callback() {
	echo '<p>Provide the URL to the social networks you\'d like to display.</p>';
} // end sandbox_general_options_callback

/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */ 

function sandbox_twitter_callback() {

	// First, we read the social options collection
	$options = get_option( 'sandbox_theme_social_options' );

	// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	$url = '';
	if( isset( $options['twitter'] ) ) {
		$url = $options['twitter'];
	} // end if

	// Render the output
	echo '<input type="text" id="twitter" name="sandbox_theme_social_options[twitter]" value="' . $options['twitter'] . '" />';

} // end sandbox_twitter_callback
function sandbox_facebook_callback() {

	$options = get_option( 'sandbox_theme_social_options' );

	$url = '';
	if( isset( $options['facebook'] ) ) {
		$url = $options['facebook'];
	} // end if

	// Render the output
	echo '<input type="text" id="facebook" name="sandbox_theme_social_options[facebook]" value="' . $options['facebook'] . '" />';

} // end sandbox_facebook_callback

function sandbox_googleplus_callback() {

	$options = get_option( 'sandbox_theme_social_options' );

	$url = '';
	if( isset( $options['googleplus'] ) ) {
		$url = $options['googleplus'];
	} // end if

	// Render the output
	echo '<input type="text" id="googleplus" name="sandbox_theme_social_options[googleplus]" value="' . $options['googleplus'] . '" />';

} // end sandbox_googleplus_callback

function sandbox_theme_sanitize_social_options( $input ) {

	// Define the array for the updated options
	$output = array();

	// Loop through each of the options sanitizing the data
	foreach( $input as $key => $val ) {

		if( isset ( $input[$key] ) ) {
			$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
		} // end if	

	} // end foreach

	// Return the new collection
	return apply_filters( 'sandbox_theme_sanitize_social_options', $output, $input );

} // end sandbox_theme_sanitize_social_options



function sandbox_initialize_theme_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'sandbox_theme_display_options' ) ) {
		add_option( 'sandbox_theme_display_options' );
	} // end if

	// First, we register a section. This is necessary since all future options must belong to a
	add_settings_section(
		'general_settings_section',			// ID used to identify this section and with which to register options
		'Display Options',					// Title to be displayed on the administration page
		'sandbox_general_options_callback',	// Callback used to render the description of the section
		'sandbox_theme_display_options'		// Page on which to add this section of options
	);

	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field(
		'show_rss',						// ID used to identify the field throughout the theme
		'RSS',							// The label to the left of the option interface element
		'sandbox_toggle_header_callback',	// The name of the function responsible for rendering the option interface
		'sandbox_theme_display_options',	// The page on which this option will be displayed
		'general_settings_section',			// The name of the section to which this field belongs
		array(								// The array of arguments to pass to the callback. In this case, just a description.
			'Activate this setting to display the RSS icon.'
		)
	);

	// Finally, we register the fields with WordPress
	register_setting(
		'sandbox_theme_display_options',
		'sandbox_theme_display_options'
	);

} // end sandbox_initialize_theme_options
add_action('admin_init', 'sandbox_initialize_theme_options');

function sandbox_general_options_callback() {
	echo '<p>Select which social icons you wish to display.</p>';
} // end sandbox_general_options_callback

function sandbox_toggle_header_callback($args) {

	// First, we read the options collection
	$options = get_option('sandbox_theme_display_options');

	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_header element of the options collection in the call to the checked() helper function
	$html = '<input type="checkbox" id="show_rss" name="sandbox_theme_display_options[show_rss]" value="1" ' . checked(1, $options['show_rss'], false) . '/>'; 

	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	$html .= '<label for="show_rss"> '  . $args[0] . '</label>'; 

	echo $html;

} // end sandbox_toggle_header_callback