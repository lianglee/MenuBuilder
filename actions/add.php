<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2019 SOFTLAB24 LIMITED
 * @license   SOFTLAB24 LIMITED, COMMERCIAL LICENSE  https://www.softlab24.com/license/commercial-license-v1
 * @link      https://www.softlab24.com/
 */
 $title = input('text');
 $url = input('url');
 $menu_type = input('menu_type');
 $menu_subtype = input('menu_subtype');
 $icon_name = input('icon_name');
 $icon_unicode = input('icon_unicode');
 $newtab	   = input('newtab');
 if(empty($title) || empty($url) || empty($menu_type) || empty($menu_subtype)) {
	 		ossn_trigger_message(ossn_print("menubuilder:fillfields"), 'error');
			redirect(REF);	 
 } 
 if(!filter_var($url, FILTER_VALIDATE_URL)){
		ossn_trigger_message(ossn_print('menubuilder:invalid:url'), 'error'); 
		redirect(REF);	
 }
 $menu = new MenuBuilder();
 if($menu->addMenu($title, $url, $menu_type, $menu_subtype, $icon_name, $icon_unicode, $newtab)){
	 		ossn_trigger_message(ossn_print("menubuilder:menuitem:added"));
			redirect("administrator/settings/menubuilder?mpage=list");
 } else {
	 		ossn_trigger_message(ossn_print("menubuilder:menuitem:failed"), 'error');
			redirect(REF);	 
 }
 