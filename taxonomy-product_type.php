
<?php get_header(); ?>

	<?php if ( have_posts() ) : the_post(); 
	
			edit_post_link();
	
			## говно код
			global $post;
			if ($post->post_name == "kuxni") 
			{
				$next_url = '<a href="/product/shkafy/" rel="next">Next</a>';
				$prev_url = '';
			}
			else
			{
				$next_url = '';
				$prev_url = '<a href="/product/kuxni/" rel="next">Next</a>';
			}			
			## /говно код
		?>
			<div class="production">
				<div id="sidebar">
					<div class="heading">
						<div class="next"><?php echo $next_url;?></div>
						<div class="prev"><?php echo $prev_url;?></div>

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
								}	?>
							</div>
						</li>
						<li><a href="#">Описание</a></li>
						<li><a href="#">Комплектация</a></li>
						<li><a href="#">Техническая информация</a></li>
					</ul>
				</div>
				
				<div style="display:block;" class="content tab1">
					<div class="photo"><img src="<? echo $product_firstfoto;?>" alt="image description" style="<?echo $style_size_firstfoto;?>"></div>
				</div>
				
				<div class="content tab2">
					<?php the_content();?>
				</div>
							
				<div class="content tab3">
					<?php echo get_field("product_equip");?>
				</div>
				
				<div class="content tab4">
					<?php echo get_field("product_tehinfo");?>
				</div>
			</div>
	
	<?php else : ?>
	
		Страница Продукции - постов нет
			
		
	<?php endif; ?>	

<?php get_footer(); ?>