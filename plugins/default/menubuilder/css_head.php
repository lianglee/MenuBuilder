<?php
$menu = new MenuBuilder();
$list = $menu->getAll();
if($list){ 
?>
<style>
	<?php foreach($list as $item){
				if($item->menu_type == 'newsfeed'){
					$class = 'menu-section-item-menubuilder-item-'.$item->guid;
					echo ".{$class}:before { content:'{$item->icon_unicode}' !important; }";
				}
	}
	?>
</style>
<?php } ?>