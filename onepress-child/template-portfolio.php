<?php
/**
* Template Name: Portfolio
* 
* @package OnePress
*/

get_header();

$layout = onepress_get_layout();

/**
 * @since 2.0.0
 * @see onepress_display_page_title
 */
do_action( 'onepress_page_before_content' );

?>
	<div id="content" class="site-content">
        <?php onepress_breadcrumb(); ?>
		<div id="content-inside" class="container <?php echo esc_attr( $layout ); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php while ( have_posts() ) : the_post();	
					// gallery

					?>
					<div class="gallery-photo mb-5"><!-- gallery-photo -->
					<?php 
					$media_types = ['image_photo_portrait','image_photo_landscape','image_photo_table'];
					
					// loop for images 
					foreach ($media_types as $tp){
						$images = rwmb_meta( 'prefix-' . $tp, array( 'size' => 'large' ) );
					?>
						<div id="carousel-<?php echo $tp ?>" class="carousel-gallery carousel slide d-none px-5" data-ride="carousel">
						<!--Slides-->
							<ul class="carousel-inner" role="listbox">
							<?php
								$indicator = '';
								$cnt = 0;
								foreach ( $images as $image ) {
									if($cnt == 0){
										$spclass = 'active';
									}else{
										$spclass = '';
									}
									echo '<li class="carousel-item '.$spclass.'"><img class="d-block w-100" src="' . $image['url'] . '"></li>';
									/*if($cnt > 4){
										$spclass = 'd-none';
									}*/
									
									$indicator = $indicator . '<li data-target="#carousel-' . $tp .'" data-slide-to="' . $cnt .'" class="'. $spclass .'"></li>';
									$cnt++;
								}
							?>
							</ul>
						<!--/.Slides-->
						<!--Controls-->
							<a class="carousel-control-prev" href="#carousel-<?php echo $tp ?>" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carousel-<?php echo $tp ?>" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						<!--/.Controls-->	
							<ol class="carousel-indicators px-1">
								<?php echo $indicator ?>
							</ol>
						</div>
					<?php } ?>
					</div><!-- ./gallery-photo -->
					<div class="gallery-video d-none mb-5"><!-- gallery-video -->
						<p><svg height="20px" version="1.1" viewBox="0 -5 30 35" width="20px"><use class="ytp-svg-shadow" xlink:href="#ytp-id-23"></use><path d="m 22.53,21.42 0,6.85 5.66,-3.42 -5.66,-3.42 0,0 z m -11.33,0 9.06,0 0,2.28 -9.06,0 0,-2.28 0,0 z m 0,-9.14 13.6,0 0,2.28 -13.6,0 0,-2.28 0,0 z m 0,4.57 13.6,0 0,2.28 -13.6,0 0,-2.28 0,0 z" fill="#111" id="ytp-id-23"></path></svg>アイコンより、プレイリストがご覧いただけます。</p>
						<ul id="video-gallery-list">
							<?php 
							$media_types = ['oembed_video_event','oembed_video_online','oembed_video_promo'];
							// loop for images 
							$cnt = 0;
							foreach ($media_types as $tp){
								if($cnt == 0){
									$spclass = 'active';
								}else{
									$spclass = '';
								}
								echo '<li class="carousel-item ' .$spclass.'">'. rwmb_meta('prefix-' . $tp) .'</li>';
								$cnt++;
							}
							?>
						</ul>
					</div><!-- gallery-video -->
					<div class="gallery-web d-none mb-5"><!-- gallery-web -->
						<p>枠内をスクロールしてご覧ください。</p>
					<?php $images = rwmb_meta( 'prefix-image_web', array( 'size' => 'full' ) );
					?>
						<div id="carousel-image_web" class="carousel-gallery carousel slide" data-ride="carousel">
						<!--Slides-->
							<ul class="carousel-inner pb-3" role="listbox">
								
								<?php
									$indicator = '';
									$caption = '';
									$cnt = 0;
									foreach ( $images as $image ) {
										if($cnt == 0){
											$spclass = 'active';
										}else{
											$spclass = '';
										}
										echo '<li class="carousel-item '.$spclass.'"><div class="inner-web"><img class="d-block w-100" src="' . $image['url'] . '"></div></li>';
										$indicator = $indicator . '<li data-target="#carousel-image_web" data-slide-to="' . $cnt .'" class="'. $spclass .'"></li>';
										if($image['description']){
											$link = '<br><a href="'. $image['description'].'" target="_blank">' . $image['description']. '</a>';
										}else{
											$link = '';
										}
										$caption = $caption . '<p class="'. $spclass .'" data-num="' . $cnt .'">' . $image['caption'] . $link .'</p>';
										$cnt++;
									}
								?>
							</ul>
						<!--/.Slides-->
						<!--Controls-->
							<a class="carousel-control-prev" href="#carousel-image_web" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carousel-image_web" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						<!--/.Controls-->	
							<ol class="carousel-indicators px-1">
								<?php echo $indicator ?>
							</ol>
						</div>
						<div class="caption-list text-center mt-2">
							<?php echo $caption ?>
						</div>
					</div><!-- /.gallery-web -->
					<div class="gallery-design d-none mb-5">
					<?php 
					$media_types = ['image_design_card','image_design_bro','image_design_banner'];
					
					// loop for images 
					foreach ($media_types as $tp){
						$images = rwmb_meta( 'prefix-' . $tp, array( 'size' => 'large' ) );
					?>
						<div id="carousel-<?php echo $tp ?>" class="carousel-gallery carousel slide d-none px-5" data-ride="carousel">
						<!--Slides-->
							<ul class="carousel-inner" role="listbox">
							<?php
								$indicator = '';
								$cnt = 0;
								foreach ( $images as $image ) {
									if($cnt == 0){
										$spclass = 'active';
									}else{
										$spclass = '';
									}
									echo '<li class="carousel-item '.$spclass.'"><img class="d-block w-100" src="' . $image['url'] . '"></li>';
									/*if($cnt > 4){
										$spclass = 'd-none';
									}*/
									
									$indicator = $indicator . '<li data-target="#carousel-' . $tp .'" data-slide-to="' . $cnt .'" class="'. $spclass .'"></li>';
									$cnt++;
								}
							?>
							</ul>
						<!--/.Slides-->
						<!--Controls-->
							<a class="carousel-control-prev" href="#carousel-<?php echo $tp ?>" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carousel-<?php echo $tp ?>" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						<!--/.Controls-->	
							<ol class="carousel-indicators px-1">
								<?php echo $indicator ?>
							</ol>
						</div>
					<?php } ?>
					</div>

						<?php  get_template_part( 'template-parts/content', 'page' ); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // End of the loop. ?>

				</main><!-- #main -->
			</div><!-- #primary -->

            <?php if ( $layout != 'no-sidebar' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>

		</div><!--#content-inside -->
	</div><!-- #content -->

<?php get_footer(); ?>
