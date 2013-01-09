<?php /* Template Name: Партнеры */ ?>

<?php get_header(); ?>

<ul class="patners">
<?php
$args = array( 'post_type' => 'partnery', 'posts_per_page' => 1000);
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post(); 
?>
<?php edit_post_link(); ?>
		<li>
			<div class="visual">
				<a href="<?php echo get_field("partner_url");?>"  target="_blank">
					<img src="<?php echo bloginfo('template_url'); ?>/timthumb.php?src=<?php echo the_field('partner_logo');?>&w=135" width="135"  alt="<?php the_title(); ?>" />
				</a>
			</div>
			<div class="info">
				<div class="partner_content">
					<h3><?php the_title(); ?></h3>
					<p><?php the_content(); ?></p>
				</div>
			</div>
		</li>
<?php
endwhile;
?>

</ul>

<?php get_footer(); ?>
