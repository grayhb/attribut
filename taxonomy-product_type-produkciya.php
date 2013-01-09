
<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>
				

		<div class="scroll">
			<a class="prev prev-disable" href="#">Prev</a>
			<a class="next" href="#">Next</a>
			<div class="scroll-holder">
				<ul>
		
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
						// титул продукции
						$product_title = get_field("product_main_title");
						// изображение анонса
						$product_img_url = get_bloginfo('template_url').'/timthumb.php?src='.get_field("product_main_titul").'&w=285&h=299&zc=0';
						// ссылка на категорию
						$product_url = get_field("product_main_link");
					?>
					<li>
						<h3><a href="/product/<? echo $product_url;?>/" title="Просмотреть все записи в <?php echo $product_title;?>" ><?php echo $product_title;?></a>  </h3>
						<div class="text-block">  
							<p>
							<p style="text-align: justify;">
							<a href="/product/<? echo $product_url;?>/">
								<img class="alignnone size-full wp-image-126" title="<?php echo $product_title;?>" src="<?php echo $product_img_url; ?>" alt="" width="287" height="299" />
							</a>
							<?php the_content();?></p>
						</div>
					</li>
					
				<?php endwhile; ?>
		
				</ul>
			</div>
		</div>
			


	<?php else : ?>
	
		страница не найдена
			
		
	<?php endif; ?>	

<?php get_footer(); ?>