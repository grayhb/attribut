<?php 	get_header(); ?>

<div class="text-block">
        
<?php 
	global $post;
	print_r($post);
	echo "index.php <br>";
 ?>
		
	<?php if ( have_posts() ) : ?>
				
		
		<?php while ( have_posts() ) : the_post(); ?>

		
			<?php get_template_part( 'content', get_post_format() ); ?>

			
		<?php endwhile; ?>

	<?php else : ?>

		страница не найдена
			
		
	<?php endif; ?>	
	
	</div>
	
	
<?php	get_footer(); ?>