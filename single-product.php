
<?php get_header(); ?>

<script type="text/javascript">
	$('.menu-item-437').addClass("current-menu-item");
	$('.menu-item-439').addClass("current-menu-item");
</script>

	<?php if ( have_posts() ) : the_post(); 
	
			edit_post_link();
	
			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'product_type',
						'field' => 'slug',
						'terms' => 'mezhkomnatnye-dveri'
					)
				)
			);
			$loop = new WP_Query( $args );
			global $post;
			$next_link = "";
			$prev_link = "";
			for($i=0; $i<count($loop->posts);$i++) {
				if ($loop->posts[$i]->ID == $post->ID) {
					if ($i > 0) 
						$prev_link = '<a href="/products/'.$loop->posts[$i-1]->post_name.'/" rel="prev">Prev</a>';
					if ($i < count($loop->posts)-1 && count($loop->posts) > 1) 
						$next_link = '<a href="/products/'.$loop->posts[$i+1]->post_name.'/" rel="next">Next</a>';
					break;
				}
			}
		
		?>	
		
			<div class="production">
				<div id="sidebar">
					<div class="heading">
					
						<div class="next"><?php echo $next_link; ?></div>
						<div class="prev"><?php echo $prev_link; ?></div>

						<h2><?php the_title();?></h2>
					</div>
					<ul class="menu">
						<li class="active"><a href="#">Фотографии</a>
							<div>
								<?php
								$args = array(
								   'post_type' => 'attachment',
								   'numberposts' => -1,
								   'post_status' => null,
								   'post_parent' => $post->ID,
								   'post_mime_type' => 'image'
								);

								$attachments = get_posts( $args );
								  
								$image_attr = array(
									'class'	=> "",
									'alt'   => "",
									'title' => ""
								);
								
								$product_firstfoto = "";
								
								if ( $attachments ) 	
								{
									foreach ( $attachments as $attachment ) 
									{ 
										$img_alt = strtolower(trim(get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true)));
										if ( $img_alt == "" && $attachment->menu_order > 1) 
										{
											//выводим фотографии продукции
											$product_img = wp_get_attachment_image_src($attachment->ID, 'full');
											if ($product_img) 
											{
												$product_img_thumburl = get_bloginfo('template_url').'/timthumb.php?src='.$product_img[0].'&w=30&h=25&zc=0';
												?>
													<a href="<?php echo  $product_img[0]; ?>">
														<img src="<?php echo $product_img_thumburl;?>" alt="" height="25" width="30">
													</a>
												<?php
												
												//первая фотография продукции
												//if ($product_firstfoto =="") $product_firstfoto = get_bloginfo('template_url').'/timthumb.php?src='.$product_img[0].'&w=653&h=412&zc=0';
												if ($product_firstfoto =="") { 
													$product_firstfoto = $product_img[0];
													$style_size_firstfoto  = "width: 653px;";
													$h=round(653 / ($product_img[1] / $product_img[2]),0);
													$style_size_firstfoto  .="height:".$h."px;";
												}
											} 
										}
										else if ( $img_alt != "") 
										{
											//массив моделей
											$product_models[]=$attachment;
										}
									}
								}	?>
							</div>
						</li>
						<li><a href="#">Описание</a></li>
						<li><a href="#"><span class="items_count"><? echo count($product_models); ?></span>Модели</a></li>
						<li><a href="#">Комплектация</a></li>
						<li><a href="#">Техническая информация</a></li>
					</ul>
				</div>
				
				<div style="display:block;" class="content">
					<div class="photo"><img src="<? echo $product_firstfoto;?>" alt="image description"></div>
				</div>
				
				<div class="content" style="display:none;">
					<?php the_content();?>
				</div>

				<div class="content hide" style="display:block; ">
				<?if ( $product_models ) 	{?>
				
					<div class="model">
					
						<div class="image">
							<a class="prev" href="#">Prev</a>
							<a class="next" href="#">Next</a>
							<ul>
							
							<?php
							
								$model_first = true;
								foreach ( $product_models as $model ) {
									if ($model_first) 
									{ 
										echo '<li class="active" style="display: list-item;">';
										$model_first = false;
									} 
									else 
										echo '<li style="display: none;">';
										
									$model_title = get_post_meta( $model->ID, '_wp_attachment_image_alt', true);
									$model_img = wp_get_attachment_image_src($model->ID, 'full');
									$model_img_thumburl = get_bloginfo('template_url').'/timthumb.php?src='.$model_img[0].'&w=219&h=510&zc=0';
									?>
										<span class="title"><?php echo $model_title; ?></span>
										<img src="<?php echo $model_img_thumburl;?>" alt="<?php echo  $model_title; ?>" height="510" width="219">
									</li>
							 <?php } ?>
							</ul>
						</div>
						
						<div class="image-list">
						
							<div class="image-holder">
							
								<ul class="slide-list">
									
										<?php
										if ( $product_models ) 	{
											$model_first = true;
											foreach ( $product_models as $model ) { ?>
												<li>
												<?
												if ($model_first) 
												{ 
													echo '<a class="active" href="#">';
													$model_first = false;
												} 
												else 
													echo '<a href="#">';
													
												$model_title = get_post_meta( $model->ID, '_wp_attachment_image_alt', true);
												$model_img = wp_get_attachment_image_src($model->ID, 'full');
												$model_img_thumburl = get_bloginfo('template_url').'/timthumb.php?src='.$model_img[0].'&w=43&h=100&zc=0';
												?>
														<img src="<?php echo $model_img_thumburl;?>" alt="<?php echo  $model_title; ?>" height="100" width="43">
													</a>
												</li>
										 <?php
											}
										}
										?>										
								</ul>
							
							</div>
							
							<div class="scrollbar">
								<div class="handle"></div>
							</div>
							
						</div>
				
				</div>
				<?php } ?>
				</div>
				
				<div class="content" style="display:none;">
					<?php echo get_field("product_equip");?>
				</div>
				
				<div class="content" style="display:none;">
					<?php echo get_field("product_tehinfo");?>
				</div>
			</div>
	
	<?php else : ?>
	
		Страница Продукции - постов нет
			
		
	<?php endif; ?>	

<?php get_footer(); ?>