<?php
$menu = new MenuBuilder();
$list = $menu->getAll();
$count = $menu->getAll(array(
			'count' => true,							
));
?>
<a class="btn btn-success btn-sm"href="<?php echo ossn_site_url('administrator/settings/menubuilder?mpage=add');?>"><?php echo ossn_print('menubuilder:add');?></a>
<table class="table table-striped margin-top-10">
  <tr>
    <th scope="col"><?php echo ossn_print('menubuilder:title');?></th>
    <th scope="col"><?php echo ossn_print('menubuilder:admin:name');?></th>
    <th scope="col"><?php echo ossn_print('menubuilder:submenu');?></th>
    <th scope="col"><?php echo ossn_print('menubuilder:delete');?></th>
  </tr>
  <?php
  	if($list){
		foreach($list  as $menu){  
			$type = str_replace(array('_', '-', '/'), array('', ':', ':'), $menu->menu_type);
			$subtype = str_replace(array('_', '-', '/'), array('', ':', ':'), $menu->menu_subtype);
		?>
  <tr>
    <td><a target="_blank" href="<?php echo $menu->description;?>"><i class="fa <?php echo $menu->icon_name;?>"></i> <?php echo $menu->title;?></a></td>
    <td><?php echo ossn_print("menubuilder:{$type}");?></td>
    <td><?php echo ossn_print("menubuilder:submenu:{$subtype}");?></td>
    <td><a class="btn btn-danger btn-sm" href="<?php echo ossn_site_url("action/menubuilder/delete?guid={$menu->guid}", true);?>"><?php echo ossn_print('menubuilder:delete');?></a></td>
  </tr>
  <?php
		}
	}?>
</table>
