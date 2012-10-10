<?php
/**
 * The Instablog Header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/insta-funct.js" type="text/javascript"></script>
<?php wp_head(); ?>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<div class="top-head">
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		<span class="social"> 
<?php $social_options = get_option ( 'sandbox_theme_social_options' ); $display_options = get_option( 'sandbox_theme_display_options' ); ?>
<?php echo $social_options['facebook'] ? '<a href="' . $social_options['facebook'] . '" class="opacity tip" data-original-title="Follow Me on Facebook" data-placement="bottom" target="_blank"><img src="'.get_template_directory_uri().'/images/fb.png" alt="Follow Me on Facebook" /></a>' : ''; ?> 

<?php echo $social_options['googleplus'] ? '<a href="' . $social_options['googleplus'] . '" class="opacity tip" data-original-title="Follow Me on Google+" data-placement="bottom" target="_blank"><img src="'.get_template_directory_uri().'/images/gp.png" alt="Follow Me on Google+" /></a>' : ''; ?> 

<?php echo $social_options['twitter'] ? '<a href="' . $social_options['twitter'] . '" class="opacity tip" data-original-title="Follow Me on Twitter" data-placement="bottom" target="_blank"><img src="'.get_template_directory_uri().'/images/tw.png" alt="Follow Me on Twitter" /></a>' : ''; ?> 

<?php if ($display_options [ 'show_rss' ]){ ?><a href="feed" class="opacity tip" data-original-title="Feed RSS" data-placement="bottom" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/rss.png" alt="Feed RSS" /></a> <?php } ?>

		</span>
	</div><!-- top-head -->
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
	<?php }else{ ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php echo get_template_directory_uri(); ?>/images/title.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
	<?php } // if ( ! empty( $header_image ) ) ?></h1>
		</hgroup>

		<nav role="navigation" class="site-navigation main-navigation">
			<h1 class="assistive-text"><?php _e( 'Menu', '_s' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', '_s' ); ?>"><?php _e( 'Skip to content', '_s' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav>
	</header><!-- #masthead .site-header -->

	<div id="main">