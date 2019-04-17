<?php
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
		<input type="text" name="text" autocomplete="off" />
  </div>
  <div>      
        <label><?php echo ossn_print('menubuilder:url');?></label>
        <input type="text" name="url"  autocomplete="off"/>
   </div>
  <div>      
        <label><?php echo ossn_print('menubuilder:newtab');?></label>
        <?php
			echo ossn_plugin_view('input/dropdown', array(
						'name' => 'newtab',
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
						'id' => 'menu-select-type',
						'options' => $PMS,
			));
		?>
   </div>
   <div class="menu-select-sub-container">
   		<label><?php echo ossn_print('menubuilder:submenu');?></label>
        <div class="menu-select-sub">
        		
        </div>
   </div>   
   <div>
   		<input type="button" class="btn btn-success btn-sm " id="menu-builder-next" value="<?php echo ossn_print('menubuilder:next');?>" />
   </div>     
</div>
<div class='menu-builder-icons hidden'>
<label><?php echo ossn_print('menubuilder:selecticon');?></label>
<?php
$icons = menu_builder_read_icons();
if($icons){
		foreach($icons as $key => $unicode){
				echo "<li class='menubuilder-icon-select' data-icon='{$key}' data-key='{$unicode}'><i class='fa {$key}'></i></li>";	
		}
}
?>
<input type="submit" class="btn btn-success btn-sm" value="<?php echo ossn_print('menubuilder:save');?>" />
</div>
<input type="hidden" name="icon_name" value="" />
<input type="hidden" name="icon_unicode" value="" />