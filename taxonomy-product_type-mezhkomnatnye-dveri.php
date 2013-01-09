
<?php get_header(); 

	global $post;
?>

<div class="dveri">
	<a class="prev" href="#">Prev</a>
	<a class="next" href="#">Next</a>
	<div id="dveri-frame">
		<ul class="dveri-slidee">
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

				$dveri_img_url = get_bloginfo('template_url').'/timthumb.php?src='.get_field("product_dveri_titul").'&w=285&h=299&zc=1';
			?>

				<li>
					<div class="photo">
					<a href="/products/<?php echo $post->post_name;?>"><img src="<?php echo $dveri_img_url;?>" alt="" height="299" width="285"></a>	
					</div>

					<h3><a href="/products/<?php echo $post->post_name;?>"><?php the_title();?></a></h3>
				</li>

			<?php endwhile; ?>

		</ul>
	</div>
</div>

<div class="text-block border">
<?
	$query = new WP_Query( 'pagename=dveri_anons' );
	if ($query->post)
	{
		edit_post_link('Редактировать', '','',$query->post->ID);
		echo $query->post->post_content;
	}
?>
</div>

	
<?php  else : ?>

	Страница Продукции - Межкомнатные двери - постов нет
	
<?php endif; ?>	


<?php get_footer(); ?>