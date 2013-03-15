<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _s
 * @since _s 1.0
 */
?>

	</div><!-- #main -->
	<div class="bottom-main">
		<img src="<?php echo get_template_directory_uri(); ?>/images/foot-main.png" />
	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="social-foot"> 
<?php $social_options = get_option ( 'sandbox_theme_social_options' ); $display_options = get_option( 'sandbox_theme_display_options' ); ?>
			<?php echo $social_options['facebook'] ? '<a href="' . $social_options['facebook'] . '" class="opacity tip" data-original-title="Follow Me on Facebook" data-placement="top" target="_blank"><img src="'.get_template_directory_uri().'/images/fb.png" alt="Follow Me on Facebook" /></a>' : ''; ?> 

<?php echo $social_options['googleplus'] ? '<a href="' . $social_options['googleplus'] . '" class="opacity tip" data-original-title="Follow Me on Google+" data-placement="top" target="_blank"><img src="'.get_template_directory_uri().'/images/gp.png" alt="Follow Me on Google+" /></a>' : ''; ?> 

<?php echo $social_options['twitter'] ? '<a href="' . $social_options['twitter'] . '" class="opacity tip" data-original-title="Follow Me on Twitter" data-placement="top" target="_blank"><img src="'.get_template_directory_uri().'/images/tw.png" alt="Follow Me on Twitter" /></a>' : ''; ?> 

<?php if ($display_options [ 'show_rss' ]){ ?><a href="feed" class="opacity tip" data-original-title="Feed RSS" data-placement="top" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/rss.png" alt="Feed RSS" /></a> <?php } ?>
		</div>
		<div class="site-info">
			<?php do_action( '_s_credits' ); ?>
			<span class="theme-info">Instablog v1.1 Free Wordpress Theme</span>
			<div class="author"><a href="http://www.project-eye.com/" rel="designer">@projecteye</a></div>
		</div><!-- .site-info -->
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>