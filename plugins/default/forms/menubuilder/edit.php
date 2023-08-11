<?php
	$guid = input('guid');
	$menuitem = menubuilder_get_item($guid);
	if(!$menuitem){
		return;	
	}
	$parentMenus = (new MenuBuilder)->getMenusLevel(0);
	$PMS = array("");
	foreach($parentMenus as $pm){
			$translation = str_replace(array('_', '-', '/'), ':', $pm);
			$PMS[$pm] = ossn_print("menubuilder:{$translation}");
	}
?>
<div class="menubuilder-main-form">
  <div>
        <label><?php echo ossn_print('menubuilder:title');?></label>
		<input value="<?php echo $menuitem->title;?>" type="text" name="text" autocomplete="off" />
  </div>
  <div>      
        <label><?php echo ossn_print('menubuilder:url');?></label>
        <input  value="<?php echo $menuitem->description;?>" type="text" name="url"  autocomplete="off"/>
   </div>
  <div>      
        <label><?php echo ossn_print('menubuilder:newtab');?></label>
        <?php
			echo ossn_plugin_view('input/dropdown', array(
						'name' => 'newtab',
						'value' => $menuitem->newtab,
						'options' => array(
							'yes' => ossn_print('menubuilder:yes'),				   
							'no' => ossn_print('menubuilder:no'),				   
						 ),
			));
		?>        
   </div>   
   <div>
        <label><?php echo ossn_print('menubuilder:name');?></label>
        <?php
			echo ossn_plugin_view('input/dropdown', array(
						'name' => 'menu_type',
						'value' => $menuitem->menu_type,
						'id' => 'menu-select-type',
						'options' => $PMS,
			));
		?>
   </div>
   <div class="menu-select-sub-container">
   		<label><?php echo ossn_print('menubuilder:submenu');?></label>
        <div class="menu-select-sub">
        		<?php if(isset($menuitem->menu_type)){ ?>
                	<script>
						$(document).ready(function(){
								$('#menu-select-type').trigger('change');
								$('.menu-select-sub').on('DOMNodeInserted', function(){
											$('#menu-select-subtype').val("<?php echo $menuitem->menu_subtype;?>");													 
								});
								$('.menubuilder-icon-select[data-icon="<?php echo $menuitem->icon_name;?>"]').addClass('menu-builder-icons-selected');
						});
					</script>
                
                <?php } ?>
        </div>
   </div>   
   <div>
   		<input type="button" class="btn btn-success btn-sm " id="menu-builder-next" value="<?php echo ossn_print('menubuilder:next');?>" />
   </div>     
</div>
<div class='menu-builder-icons d-none'>
<label><?php echo ossn_print('menubuilder:selecticon');?></label>
<?php
$icons = menu_builder_read_icons();
if($icons){
		foreach($icons as $data){
				echo "<li class='menubuilder-icon-select' data-icon='{$data['type']} fa-{$data['name']}' data-key='{$data['unicode']}'><i class='{$data['type']} fa-{$data['name']}'></i></li>";	
		}
}
?>
<input type="submit" class="btn btn-success btn-sm" value="<?php echo ossn_print('menubuilder:save');?>" />
</div>
<input type="hidden" name="icon_name" value="<?php echo $menuitem->icon_name;?>" />
<input type="hidden" name="icon_unicode" value="<?php echo $menuitem->icon_unicode;?>" />
<input type="hidden" name="guid" value="<?php echo $menuitem->guid;?>" />