<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright 2014-2019 OpenTeknik LLC
 * @license   OpenTeknik LLC, COMMERCIAL LICENSE  https://www.openteknik.com/license/commercial-license-v1
 * @link      https://www.openteknik.com/
 */
 $guid = input('guid');
 $title = input('text');
 $url = input('url');
 $menu_type = input('menu_type');
 $menu_subtype = input('menu_subtype');
 $icon_name = input('icon_name');
 $icon_unicode = input('icon_unicode');
 $newtab	   = input('newtab');
 
 $object = menubuilder_get_item($guid);
 if(!$object){
			redirect(REF);		 
 }
$object->description        = $url;
$object->title              = $title;
$object->data->menu_type    = $menu_type;
$object->data->menu_subtype = $menu_subtype;
$object->data->icon_name    = $icon_name;
$object->data->icon_unicode = $icon_unicode;
$object->data->newtab       = $newtab; 
$object->save();
redirect("administrator/settings/menubuilder?mpage=list");
 