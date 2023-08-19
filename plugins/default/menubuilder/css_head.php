<?php
$menu = new MenuBuilder();
$list = $menu->getAll();
if($list){ 
?>
<style>
	<?php foreach($list as $item){
				if($item->menu_type == 'newsfeed'){
					$class = 'menu-section-item-menubuilder-item-'.$item->guid;
					$bold  = '';
					if(str_starts_with($item->icon_name, 'fab')){
						$bold = "font-family:'Font Awesome 5 Brands' !important;";	
					}
					echo ".{$class}:before { content:'{$item->icon_unicode}' !important; {$bold}}";
				}
	}
	?>
</style>
<?php } ?>