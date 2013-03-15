<?php
/**
 * @package _s
 * @since _s 1.0
 */
?>
<?php set_post_thumbnail_size(450,450,true); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box">
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		</header><!-- .entry-header -->
		<footer class="entry-meta">
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', '_s' ), __( '1 Comment', '_s' ), __( '% Comments', '_s' ) ); ?></span>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', '_s' ), '<span class="sep"> &bull; </span><span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
	
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary excerpt">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content excerpt">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php
	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', __( ' ', '_s' ) );
	if ( $tags_list ) :
	?>
	<span class="tag-links">
		<?php printf( __( '%1$s', '_s' ), $tags_list ); ?>
	</span>
	<?php endif; // End if $tags_list ?>
	<div class="share-bottom">
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
		<g:plusone size="small" href="<?php the_permalink(); ?>"></g:plusone>
	</div>	
	</div>
	<?php $attr = array(
		'alt'	=> the_title_attribute( 'echo=0' ),
		'title'	=> the_title_attribute( 'echo=0' ),
	); ?>
	<div class="featured">
		<span class="top"></span>
		<a href="<?=get_permalink($post->ID)?>" title="<?php printf( esc_attr__( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php if (has_post_thumbnail()) {the_post_thumbnail('full',$attr);}?></a>
		<span class="bottom"></span>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->