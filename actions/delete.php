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
 