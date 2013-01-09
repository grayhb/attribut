<?php /* Template Name: Главная страница */ 

get_header();

if ( have_posts() )  {

	edit_post_link();

	the_post();
	
	$args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => $post->ID
	);

	$attachments = get_posts( $args );
}
?>

<div class="slider-wrapper theme-default">
	<div id="slider" class="nivoSlider">
		<?php 
			 if ( $attachments ) {
				foreach ( $attachments as $attachment ) {
				?>
					<img width="933" height="607" src="<?php echo bloginfo('template_url'); ?>/timthumb.php?src=<?php echo $attachment->guid;?>&w=933&h=607"  data-thumb="<?php echo bloginfo('template_url'); ?>/timthumb.php?src=<?php echo $attachment->guid;?>&w=933&h=607" border="0">
				 <?
				}
			 }
		?>	
	</div>
	<div id="htmlcaption" class="nivo-html-caption">
	</div>
</div>
	
<?php get_footer(); ?>
