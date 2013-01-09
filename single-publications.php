
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
					$img_url = get_bloginfo('template_url').'/timthumb.php?src='.$publimg[0].'&h=550&w=790&zc=2';
					
					if ($publimg) {
					
						$publimg_thumb = wp_get_attachment_image_src($attachment->ID, 'thumbnail');
						$img_thumb_url = get_bloginfo('template_url').'/timthumb.php?src='.$publimg_thumb[0].'&h=127&w=145&zc=2';
						
					?>
							<li <?php if ($iFirst) { echo 'class="active"'; $iFirst = false;}?>>
								<a href="<?php echo  $img_url; ?>">
									<img width="145" height="130" src="<? echo $img_thumb_url;?>" class="" alt="" title="" />
								</a>
							</li>	
					<?php
				}
			}
			$i++;
			}
		 }	?>
		
<?php endwhile; endif; ?>
