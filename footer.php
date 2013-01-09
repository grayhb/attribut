		</div> <!-- //main -->
</div> <!-- //wrapper -->


<?php
	
	$id_footer = 1056; //ID страницы с данными подвала
	$footer_copyright = get_field('footer_copyright', $id_footer );
	$footer_phone = get_field('footer_phone', $id_footer );
	$footer_email = get_field('footer_email', $id_footer );
	
?>

<div id="footer">
	<span class="copyright"><?php echo $footer_copyright; ?></span>
	<span class="phone"><?php echo $footer_phone; ?></span>
	<a class="mail design" href="mailto:<?php echo $footer_email; ?>"><?php echo $footer_email; ?></a>
</div>

<?php wp_footer(); ?>

</body>
</html>