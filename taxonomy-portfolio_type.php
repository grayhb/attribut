
<?php get_header(); ?>

	

	<?php 

	if ( have_posts() ) : ?>
		
		<div class="portfolio">
		
			<a class="prev" href="#">Prev</a>
			<a class="next" href="#">Next</a>
			
			<div id="frame-portfolio">

				<ul class="portfolio-slide">		
			
				<?php 
					$i=0;
					while ( have_posts() ) : the_post(); 
						$i++;
						
						if ($i==1) echo "<li> ";
					?>

						<div>
							<a href="#">	
								<?php
									$img_url = get_bloginfo('template_url').'/timthumb.php?src='.get_field("portfolio_titul").'&w=306&h=299&zc=1';
								?>
								<img src="<?php echo $img_url;?>" width="306" height="299" alt="" />
								<div class="title"><span><?php echo the_title();?></span></div>
							</a>  
							<strong class="head"><?php echo the_title();?></strong>
							<div class="where-will-be-data" data-link="/portfolio_page/<?php echo $post->post_name;?>"></div>
						</div>
					
				<?php 
					if ($i==2) {
						echo "</li>";
						$i=0;
					}
				endwhile; 
				
					if ($i!=2) echo "</li>";
					
				?>
			
				</ul>
			
			</div>
						
		</div>

	<?php else : ?>
	
		страница не найдена
			
		
	<?php endif; ?>	
	
	

<?php get_footer(); ?>



	<div style="display:none;" class="lightbox-holder">
		<div class="bg">&nbsp;</div>
		<div class="lightbox ajax_loading">
		<h3></h3>
			<a class="close" href="#">Close</a>

			<div class="lightbox-frame">
				<div class="image">
					<a class="prev" href="#">Prev</a>
					<a class="next" href="#">Next</a>
					<ul>
					</ul>
				</div>
				
				<div id="slider_holder">
					
					<div id="frame">
						<ul class="slidee">

						</ul>
					</div>
					
				
					<div class="scrollbar">
						<div class="handle"></div>
					</div>
					
				</div>
				
				
			</div>
		</div>
	</div>