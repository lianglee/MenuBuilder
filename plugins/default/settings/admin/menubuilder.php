<?php
$page = input('mpage', '', 'add');
switch($page){
	case 'add':
		echo ossn_view_form('menubuilder/add', array(
    		'action' => ossn_site_url() . 'action/menubuilder/add',
		));
		break;
	case 'edit':
		echo ossn_view_form('menubuilder/edit', array(
    		'action' => ossn_site_url() . 'action/menubuilder/edit',
		));
		break;		
	case 'list':
		echo ossn_plugin_view('menubuilder/list');
		break;		
	case 'edit':
		break;		
}	