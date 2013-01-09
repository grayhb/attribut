
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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
		  
		  
		  
			 if ( $attachments ) 
			 {
				$i=0;
				$iFirst = true;
				foreach ( $attachments as $attachment ) 
				{ 
					//выводим все фотографии кроме первой
					if ($i>0) {
						$publimg = wp_get_attachment_image_src($attachment->ID, 'full');
						//print_r($publimg);
						if ($publimg) {
							$img_url = get_bloginfo('template_url').'/timthumb.php?src='.$publimg[0].'&w=790&h=550&zc=';
							if ($publimg[1]>$publimg[2])
								$img_url.='1';
							else
								$img_url.='2';
							
							$publimg_thumb = wp_get_attachment_image_src($attachment->ID, 'thumbnail');								
							
						?>
							<li <?php if ($iFirst) { echo 'class="active"'; $iFirst = false;}?>>
								<a href="<?php echo  $img_url; ?>">
									<img width="145" height="94" src="<? echo get_bloginfo('template_url').'/timthumb.php?src='.$publimg_thumb[0].'&w=145&h=94&zc=1';?>" class="" alt="" title="" />
								</a>
								</a>
							</li>							
						<?php
						}
					}
					$i++;
				}
			 }	?>
		
<?php endwhile; endif; ?>
