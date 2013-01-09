<?php /* Template Name: Страница публикаций */ ?>

<?php /* Определяем JS скрипты */ ?>



<?php get_header(); ?>

	<div class="scroll">
		<a class="prev" href="#">Prev</a>
		<a class="next" href="#">Next</a>
		<div class="scroll-holder publication">
			<ul class="publications">	


			<?php
			$titul_size = 296;   //ширина изображения обложки
			$args = array( 'post_type' => 'publications', 'posts_per_page' => 1000);
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); 
				global $post;
								
				$publtitul = get_field("publication_titul");
				
				### Если размер изображения не соответствует режем с помощью timthumb
				$image_attributes = wp_get_attachment_image_src( $publtitul['id'], 'full'); 
				if ($image_attributes[0] != $titul_size) 
					//296px × 374px
					$publtitulimg =get_bloginfo('template_url').'/timthumb.php?src='.$publtitul['url'].'&w='.$titul_size.'&h=374&zc=2';
				else
					$publtitulimg = $publtitul['url'];

				#### ///

			?>
			<li>
				<div class="visual">
					<a href="#" >	
						<img src="<?php echo $publtitulimg; ?>" alt="<?php the_title(); ?>" title="" width="<?php echo $titul_size;?>" height="374"/>
					</a> 
					<strong class="head" ><?php the_title(); ?></strong>
				</div>
				<?php the_content(); ?>		
				<div class="where-will-be-data" data-link="/publications/<?php echo $post->post_name;?>" ></div>				
			</li>
			<?php
			endwhile;
			?>

			</ul>
		</div>
	</div>

<?php get_footer(); ?>

	<div style="display:none;" class="lightbox-holder">
		<div class="bg">&nbsp;</div>
		<div class="lightbox publications-lightbox ajax_loading">
		<h3></h3>
			<a class="close" href="#">Close</a>

			<div class="lightbox-frame">
				<div class="image">
					<a class="prev" href="#">Prev</a>
					<a class="next" href="#">Next</a>
					<ul>
					</ul>
					<div class="bottom">
						
					</div>
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
