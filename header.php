
<!DOCTYPE HTML PUBLIC  "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head >
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>
<?php bloginfo('name'); ?>
<?php if(is_page('Главная')) { ?> - <?php bloginfo('description'); ?><?php } ?>
<?php if(is_single()) { ?><?php wp_title(); ?><?php } ?>
<?php if(is_404()) { ?> - Страница не найдена<?php } ?>
<?php if(is_search()) { ?> - Результаты поиска: <?php echo wp_specialchars($s, 1); ?><?php } ?>
</title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/my_style.css" type="text/css" media="screen" />

<?php 
	
	wp_enqueue_script('my_console', get_template_directory_uri() . '/js/console.js');
	
	wp_enqueue_script('att_jquery', get_template_directory_uri() . '/js/jquery-1.8.2.min.js');
	
	//определение наименования файла шаблона
	$debugbacktrace = debug_backtrace();
	$pagetpl = basename($debugbacktrace[3]['file']);
	
	
	//подгрузка слайдера
	if ($pagetpl != "single-partnery.php" && $pagetpl != "single-contacts.php" && $pagetpl != "page.php" ) 
	{
		addjs_sly();
	}	
	
	
	//главная страница
	if( $pagetpl == 'page-home.php') { 
	
		wp_enqueue_script('nivo_slider',     get_template_directory_uri() . '/js/jquery.nivo.slider.js');
		wp_enqueue_style('nivo_css', get_template_directory_uri() . '/css/nivo-slider/nivo-slider.css', false, false, 'all');
		wp_enqueue_style('nivo_default', get_template_directory_uri() . '/css/nivo-slider/default/default.css', false, false, 'all');
		
		wp_enqueue_script('att_home',     get_template_directory_uri() . '/js/att_home.js');
		wp_enqueue_style('att_home', get_template_directory_uri() . '/css/att_home.css', false, false, 'all');
	} 
	
	//продукция
	if( $pagetpl == 'single-product.php' || $pagetpl == 'taxonomy-product_type-mezhkomnatnye-dveri.php' || $pagetpl == 'taxonomy-product_type.php') { 
		wp_enqueue_script('att_product',     get_template_directory_uri() . '/js/att_product.js');	
	}
	
	//портфолио
	if( $pagetpl == 'taxonomy-portfolio_type.php') {
		wp_enqueue_script('att_portfolio',     get_template_directory_uri() . '/js/att_portfolio.js', false, false, true);	
		wp_enqueue_style('att_portfolio', get_template_directory_uri() . '/lightbox.css', false, false, 'all');
	}
	
	//публикации
	if( $pagetpl == 'publications.php') {
		wp_enqueue_script('att_publications',     get_template_directory_uri() . '/js/att_publications.js', false, false, true);	
		wp_enqueue_style('att_portfolio', get_template_directory_uri() . '/lightbox.css', false, false, 'all');
	}
	
	wp_enqueue_script('att_main', get_template_directory_uri() . '/js/att_main.js');

		
	wp_head(); ?>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1 class="logo"><a href="<?php bloginfo('url'); ?>">ATTRIBUTE</a></h1>
		<?php wp_nav_menu('menu=menu'); ?>
	</div> 
	
	<div id="main">
<?  
  ///echo $pagetpl;
?>