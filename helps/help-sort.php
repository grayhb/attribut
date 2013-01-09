<?php
/*Template Name: Помощь по сортировке записей*/
if ('help-sort.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('');
?>
<style type="text/css"> 
	.tab_help span {
		font-size:14px;
		font-weight:bold;
		display:block;
		padding-bottom:5px;
		padding-top:5px;
		padding-left:20px;
		background: #eee;
		line-height:14px;
		margin-bottom:5px;
	}
	.tab_help hr {
		border: none;
		border-top: solid #eee 2px;
		margin-bottom:10px;
	}	
</style> 

<div class="tab_help">
	
	<span>В каждой категории можно выбрать количество элементов (постов) на страницу:</span>
	<img src="/wp-content/themes/att/helps/img/sort_01.png" >
	<hr>
	<span>Для смены положения достаточно потянуть мышкой запись вверх или вниз:</span>
	<img src="/wp-content/themes/att/helps/img/sort_02.png" >
	<hr>
	<span>Анимация при сохранения положения записи:</span>
	<img src="/wp-content/themes/att/helps/img/sort_03.png" >

</div>