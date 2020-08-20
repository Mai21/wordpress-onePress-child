<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package OnePress
 */

$show_thumbnail = true;
if ( get_theme_mod( 'onepress_hide_thumnail_if_not_exists', false ) ) {
	if ( ! has_post_thumbnail() ) {
		$show_thumbnail = false;
	}
}

?>



<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'list-article', 'clearfix' ) ); ?>>
	<?php if ( $show_thumbnail ) { ?>
	<div class="list-article-thumb">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'onepress-blog-small' );
			} else {
				echo '<img alt="" src="' . get_template_directory_uri() . '/assets/images/placholder2.png">';
			}
			?>
		</a>
	</div>
	<?php } ?>

	<div class="list-article-content">
		<?php
		/**
		 * Hook before article content
		 *
		 * @since 2.1.0
		 */
		do_action( 'onepress_loop_content_before' );
		/**
		 * Condition to show meta
		 *
		 * @since 2.1.0
		 */
		if ( onepress_loop_get_prop( 'show_meta', true ) ) { ?>
			<div class="list-article-meta">
				<?php /*the_category( ' / ' );*/ 
				/**
			 	* get a station from the custom field
			 	*/
				if (rwmb_meta('prefix-textarea_station')){
					$strLines = array();
					$strLines = explode("\n", rwmb_meta('prefix-textarea_station'));
					foreach ($strLines as &$value) { 
						echo '<a>' . $value . '</a>';
					}
				} 
				?>			
			</div>
		<?php } ?>
		<?php
		/**
		 * Condition to show title
		 *
		 * @since 2.1.0
		 */
		if ( onepress_loop_get_prop( 'show_title', true ) ) { ?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->
		<?php } ?>
		<div class="entry-excerpt">
			<?php
			/**
			 * get a caption from the custom field
			 */
			if (rwmb_meta('prefix-textarea_caption')){
				$strLines = array();
				$strLines = explode("\n", rwmb_meta('prefix-textarea_caption'));
				foreach ($strLines as &$value) { 
					echo $value;
				}
			} 
			?>
		</div><!-- .entry-content -->
		<?php
		/**
		 * Hook after article content
		 *
		 * @since 2.1.0
		 */
		do_action( 'onepress_loop_content_after' );
		?>
	</div>

</article><!-- #post-## -->

