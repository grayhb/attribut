<?php 

if (function_exists('add_theme_support')) {
 add_theme_support('menus');
}

function addjs_sly() {
	wp_enqueue_script('att_sly',     get_template_directory_uri() . '/js/jquery.sly.min.js');
	wp_enqueue_script('att_easing',     get_template_directory_uri() . '/js/jquery.easing.1.3.js');
}


if (is_admin_bar_showing()) 
{
	### Верхняя панель / фикс
	function fb_move_admin_bar() {
		 echo '
		 <style type="text/css">
		 body {
			/*margin-top: -28px;*/
		 }

		 </style>';
	}
	
	add_action( 'wp_head', 'fb_move_admin_bar' );
	
}


### Настройка админки для редактора сайта
if (!is_super_admin() || !is_admin_bar_showing() )
{



	//Закрываем лишние пункты меню в админке для редактора
	function remove_menus() {
	  global $menu;
	  
	  $restricted = array(
		'profile.php', // Профиль
		'tools.php', // Инструменты
		'ql-home'    //локализация
	  );
	  
	  foreach ($menu as $k => $item) {
		if (in_array($item[2] , $restricted)) {
		  unset($menu[$k]);
		}
	  }
	}
	add_action('admin_menu', 'remove_menus');

	//скрываем кнопку настройка экрана
	function remove_screen_options(){
		return false;
	}
	add_filter('screen_options_show_screen', 'remove_screen_options');

	//меняем Футер
	function remove_footer_admin () {
		echo "Создано специально для компании <a href='http://attribut.ru' target=_blank>Атрибутэ</a>";
	} 
	add_filter('admin_footer_text', 'remove_footer_admin');

}



### Настройка блока Прямо сейчас
function my_remove_admin_right_now_info() {
?>
	<script type="text/javascript">
	
		(function($){ 
		
			$(".md-rnr-paragraph").hide(); 
			$(".md-rnr-stranica").hide();
			$(".md-rnr-widget").hide();
			$(".md-rnr-link").hide();
			$(".md-rnr-rubrika").hide();
			$(".md-rnr-link-category").hide();
			
			$("#md-rnr-widget .hndle span").text("Прямо сейчас");
			$("#md-rnr-column-primary .md-rnr-section h5").text("Контент");
			$("#md-rnr-column-secondary .md-rnr-section h5").text("Таксономия");

			var cnt_draft=0;
			$("a.md-rnr-action-draft").each(function(){
				cnt_draft = parseInt($(this).html().replace('draft',''));
				if (cnt_draft==1)
				{
					$(this).html($(this).html().replace('draft','черновик')); 
				}
				else if ((cnt_draft > 20) && ((cnt_draft % 10) == 1)) {
					$(this).html($(this).html().replace('draft','черновик')); 
				}
				else if (((cnt_draft >= 2) && (cnt_draft <= 4)) || (((cnt_draft % 10) >= 2) && ((cnt_draft % 10) <= 4)) && (cnt_draft > 20)) {
					$(this).html($(this).html().replace('draft','черновика')); 
				}			
				else
					$(this).html($(this).html().replace('draft','черновиков'));
			});
			
		})(jQuery);

	</script>
<?php
}
add_action('admin_footer', 'my_remove_admin_right_now_info');	

### Удаляем виджеты из dashboard
function my_remove_dashboard_widgets() {
  global $wp_meta_boxes;
 
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Свежие комментарии
  
  
  //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // Прямо сейчас
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // Плагины
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // Входящие ссылки
  
   
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // Быстрая публикация
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // Свежие черновики
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // Блог WordPress
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // Другие новости WordPress
}
add_action('wp_dashboard_setup', 'my_remove_dashboard_widgets' );

### Кол-во постов по категориям в консоли
add_action( 'right_now_content_table_end' , 'add_right_now_info' );  
function add_right_now_info() {  
    $args = array( 'public' => true, '_builtin' => false );  
  
    $output = 'object';  
    $operator = 'and';  
  
    $post_types = get_post_types( $args, $output, $operator );  
    foreach( $post_types as $post_type ){  
        $num_posts = wp_count_posts( $post_type->name );  
        $num = number_format_i18n( $num_posts->publish );  
        $text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );  
        if ( current_user_can( 'edit_posts' ) ) {  
            $num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";  
            $text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";  
        }  
        echo '<tr><td class="first b b-' . $post_type->name . '">' . $num . '</td>';  
        echo '<td class="t ' . $post_type->name . '">' . $text . '</td></tr>';  
    }  
    // сюда вставляем код для таксономий, если нужно  
  
}  





/// Настройка разделов:

### Раздел Продукция
function product_custom_init() {
  $labels = array(
    'name' => _x('Продукция', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Продукция', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Добавить', 'book', 'your_text_domain'),
    'add_new_item' => __('Добавить продукцию', 'your_text_domain'),
    'edit_item' => __('Редактировать', 'your_text_domain'),
    'new_item' => __('Создать', 'your_text_domain'),
    'all_items' => __('Вся продукция', 'your_text_domain'),
    'view_item' => __('Просмотр', 'your_text_domain'),
    'search_items' => __('Поиск продукции', 'your_text_domain'),
    'not_found' =>  __('Не найдено', 'your_text_domain'),
    'not_found_in_trash' => __('Не найдено в корзине', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Продукция', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'products', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor')
  ); 
  register_post_type('product', $args);
}
add_action( 'init', 'product_custom_init' );

### Раздел Портфолио
function portfolio_custom_init() {
  $labels = array(
    'name' => _x('Портфолио', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Портфолио', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Добавить', 'book', 'your_text_domain'),
    'add_new_item' => __('Добавить Портфолио', 'your_text_domain'),
    'edit_item' => __('Редактировать', 'your_text_domain'),
    'new_item' => __('Создать', 'your_text_domain'),
    'all_items' => __('Все портфолио', 'your_text_domain'),
    'view_item' => __('Просмотр', 'your_text_domain'),
    'search_items' => __('Поиск портфолио', 'your_text_domain'),
    'not_found' =>  __('Не найдено', 'your_text_domain'),
    'not_found_in_trash' => __('Не найдено в корзине', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Портфолио', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'portfolio_page', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor')
  ); 
  register_post_type('portfolio', $args);
}
add_action( 'init', 'portfolio_custom_init' );

### Раздел Публикации
function publications_custom_init() {
  $labels = array(
    'name' => _x('Публикации', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Публикации', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Добавить', 'book', 'your_text_domain'),
    'add_new_item' => __('Добавить Публикацию', 'your_text_domain'),
    'edit_item' => __('Редактировать', 'your_text_domain'),
    'new_item' => __('Создать', 'your_text_domain'),
    'all_items' => __('Все публикации', 'your_text_domain'),
    'view_item' => __('Просмотр', 'your_text_domain'),
    'search_items' => __('Поиск публикации', 'your_text_domain'),
    'not_found' =>  __('Не найдено', 'your_text_domain'),
    'not_found_in_trash' => __('Не найдено в корзине', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Публикации', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'publications', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor')
  ); 
  register_post_type('publications', $args);
}
add_action( 'init', 'publications_custom_init' );

### Раздел Партнеры
function partnery_custom_init() {
  $labels = array(
    'name' => _x('Партнеры', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Партнеры', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Добавить', 'book', 'your_text_domain'),
    'add_new_item' => __('Добавить партнера', 'your_text_domain'),
    'edit_item' => __('Редактировать', 'your_text_domain'),
    'new_item' => __('Создать', 'your_text_domain'),
    'all_items' => __('Все партнеры', 'your_text_domain'),
    'view_item' => __('Просмотр', 'your_text_domain'),
    'search_items' => __('Поиск партнера', 'your_text_domain'),
    'not_found' =>  __('Не найдено', 'your_text_domain'),
    'not_found_in_trash' => __('Не найдено в корзине', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Партнеры', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'partnery', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'custom-fields')
  ); 
  register_post_type('partnery', $args);
}
add_action( 'init', 'partnery_custom_init' );

### Раздел Контакты
function contacts_custom_init() {
  $labels = array(
    'name' => _x('Контакты', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Контакты', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Добавить', 'book', 'your_text_domain'),
    'add_new_item' => __('Добавить контакт', 'your_text_domain'),
    'edit_item' => __('Редактировать', 'your_text_domain'),
    'new_item' => __('Создать', 'your_text_domain'),
    'all_items' => __('Все контакты', 'your_text_domain'),
    'view_item' => __('Просмотр', 'your_text_domain'),
    'search_items' => __('Поиск контакта', 'your_text_domain'),
    'not_found' =>  __('Не найдено', 'your_text_domain'),
    'not_found_in_trash' => __('Не найдено в корзине', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Контакты', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'contacts', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'custom-fields')
  ); 
  register_post_type('contacts', $args);
}
add_action( 'init', 'contacts_custom_init' );




### Таксономия Продукции
// регистрирующая новые таксономии product
add_action( 'init', 'create_product_taxonomies', 0 );

function create_product_taxonomies(){

  $labels = array(
    'name' => _x( 'Категории продукции', 'taxonomy general name' ),
    'singular_name' => _x( 'Категории', 'taxonomy singular name' ),
    'search_items' =>  __( 'Поиск' ),
    'all_items' => __( 'Все' ),
    'parent_item' => __( 'Родитель' ),
    'parent_item_colon' => __( 'Родитель:' ),
    'edit_item' => __( 'Редактировать' ),
    'update_item' => __( 'Обновить' ),
    'add_new_item' => __( 'Добавить категорию' ),
    'new_item_name' => __( 'Наименование' ),
    'menu_name' => __( 'Категории' ),
  );

  // Добавляем древовидную таксономию (как категории)
  register_taxonomy('product_type', array('product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product' ),
  ));

}


### Таксономия Портфолио
// регистрирующая новые таксономии portfolio
add_action( 'init', 'create_portfolio_taxonomies', 0 );

function create_portfolio_taxonomies(){

  $labels = array(
    'name' => _x( 'Категории портфолио', 'taxonomy general name' ),
    'singular_name' => _x( 'Категории', 'taxonomy singular name' ),
    'search_items' =>  __( 'Поиск' ),
    'all_items' => __( 'Все' ),
    'parent_item' => __( 'Родитель' ),
    'parent_item_colon' => __( 'Родитель:' ),
    'edit_item' => __( 'Редактировать' ),
    'update_item' => __( 'Обновить' ),
    'add_new_item' => __( 'Добавить категорию' ),
    'new_item_name' => __( 'Наименование' ),
    'menu_name' => __( 'Категории' ),
  );

  // Добавляем древовидную таксономию (как категории)
  register_taxonomy('portfolio_type', array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio' ),
  ));

}

### Настройка редактора в зависимости от типа поста

//hide editor if adding a new post of sermon type
add_action('admin_head', 'hide_post_box');

function hide_post_box() {

global $current_screen;
	if ($current_screen->post_type == "portfolio") {
?>
 <style>
	.switch-html{ display:none; }
	.switch-tmce{ display:none; }
	.wp-editor-container { display:none;}
	table.mceLayout {display:none;}
	table#post-status-info {display:none;}
	.thickbox.add_media {
		border:solid 1px #eee;
		padding-top:3px;
		padding-bottom: 3px;
		padding-left:5px;
		border-radius: 3px 3px 3px 3px;
		-webkit-box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.5);
		box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.5);		
	}
 </style>
<?php
	}
}



### Настройка помощи

function my_plugin_help($contextual_help) {
	$screen = get_current_screen();
	
	$restricted = array(
		'portfolio',
		'product',
		'publications',
		'partnery'
		
	);
	//'contacts'
	
	if (strpos($screen->id , 'edit-') === false && in_array($screen->post_type , $restricted) ) {
		$my_text_help = file_get_contents(dirname(__FILE__)."/helps/help-".$screen->post_type.".php");
		$screen->add_help_tab( array('id' => 'help_tab_'.$screen->post_type,
		'title'=> __('Добавление записи'),
		'content' => '<p>' . __($my_text_help) . '</p>',) );
	}
	
	//Помощь по сортировке
	if (strspn($screen->id , 'edit-')>0) {
		$my_text_help = file_get_contents(dirname(__FILE__)."/helps/help-sort.php");
		$screen->add_help_tab( array('id' => 'help_tab_sort',
		'title'=> __('Сортировка записей'),
		'content' => '<p>' . __($my_text_help) . '</p>',) );
	}
}
add_filter('contextual_help', 'my_plugin_help');
	


?>