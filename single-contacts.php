<?php /* Template Name: Контакты */ ?>

<?php get_header(); ?>

<script type="text/javascript">
	$('.menu-item-137').addClass("current-menu-item");
</script>

<div class="contacts">
	
		
	<?php while ( have_posts() ) : the_post(); ?>
			<?php edit_post_link(); ?>
			
	<div class="contacts-holder">	
	
		<?php wp_nav_menu('menu=menucontacts'); ?>

		
		<div style="display:block;" class="tab">
			<div class="top">
				<ul class="info">
					<li>
						<address><?php echo get_field("contact_address");?></address> 
						<?php echo get_field("contact_timework");?>
					</li>
					<li>E-mail: <a href="mailto:<?php echo get_field("contact_email");?>"><?php echo get_field("contact_email");?></a></li>
					<li>
						<dl>
							<dt>Тел.:</dt>
							<dd><?php echo get_field("contact_phone");?></dd>
						</dl>
					</li>
				</ul>
			</div>
		</div>
			
		<div class="map">
		<?php echo get_field("contact_map");?>
		</div> <!-- //map -->		

		</div> <!-- //contacts-holder -->
	
	<?php endwhile; // end of the loop. ?>


</div> <!-- //contacts -->

<?php get_footer(); ?>
