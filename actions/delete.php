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
 $guid = input('guid');
 $object = ossn_get_object($guid);
 if(!$object){
	 		ossn_trigger_message(ossn_print("menubuilder:menuitem:delete:failed"), 'error');
			redirect(REF);		 
 }
 if($object->deleteObject()){
	 		ossn_trigger_message(ossn_print("menubuilder:menuitem:deleted"));
			redirect("administrator/settings/menubuilder?mpage=list");
 } else {
	 		ossn_trigger_message(ossn_print("menubuilder:menuitem:delete:failed"), 'error');
			redirect(REF);	 
 }
 