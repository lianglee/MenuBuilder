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
class MenuBuilder extends OssnObject {
		/**
		 * Add a menu item
		 * 
		 * @param string $title A title for link
		 * @param string $url 	A link URL
		 * @param string $menu_type Toplevel menu
		 * $param string $menu_subtype Level 1 menu
		 * @param string $icon_name  Fontawesome class 
		 * @param string $icon_unicode Icon unicode
		 * @param string $newtab  Open in new tab or new (yes/no)
		 *
		 * @return boolean
		 */
		public function addMenu($title = '', $url = '', $menu_type = '', $menu_subtype = '', $icon_name = '', $icon_unicode = '', $newtab = '') {
				if (empty($title) || empty($url) || empty($menu_type) || empty($menu_subtype)) {
						return false;
				}
				$this->description        = $url;
				$this->title              = $title;
				$this->owner_guid         = 1;
				$this->type               = 'site';
				$this->subtype            = 'menubuilder:menuitem';
				$this->data->menu_type    = $menu_type;
				$this->data->menu_subtype = $menu_subtype;
				$this->data->icon_name    = $icon_name;
				$this->data->icon_unicode = $icon_unicode;
				$this->data->newtab       = $newtab;
				return $this->addObject();
		}
		/**
		 * Get all Menus
		 *
		 * @param array $params A options
		 *
		 * @return array
		 */
		public function getAll(array $params = array()) {
				$default               = array();
				$default['type']       = 'site';
				$default['subtype']    = 'menubuilder:menuitem';
				$default['page_limit'] = false;
				
				$vars = array_merge($default, $params);
				return $this->searchObject($vars);
		}
		public function buildMenus() {
				$menus = $this->getAll();
				if ($menus) {
						foreach ($menus as $menu) {
								$type = str_replace(array(
										'/',
										'_'
								), '-', $menu->menu_type);
								switch ($menu->menu_type) {
										case 'topbar_admin':
										case 'admin/sidemenu':
										case 'newsfeed':
												$args = array(
														'name' => "menubuilder_item_{$menu->guid}",
														'text' => $menu->title,
														'href' => $menu->description,
														'class' => "menubuilder-item-{$type}",
														'data-menubuilder-icon' => $menu->icon_name,
														'data-menubuilder-icon-unicode' => str_replace('\\', '', $menu->icon_unicode),
														'parent' => $menu->menu_subtype
												);
												if($menu->menu_type == 'admin/sidemenu'){
													$args['parent'] = ossn_print($menu->menu_subtype);
												}
												if (isset($menu->newtab) && $menu->newtab == 'yes') {
														$args['target'] = '_blank';
												}
												ossn_register_menu_item($menu->menu_type, $args);
												break;
										default:
												$args = array(
														'name' => "menubuilder_item_{$menu->guid}",
														'text' => $menu->title,
														'href' => $menu->description,
														'data-menubuilder-icon' => $menu->icon_name,
														'class' => "menubuilder-item-{$type}",
														'data-menubuilder-icon-unicode' => str_replace('\\', '', $menu->icon_unicode)
												);
												if (isset($menu->newtab) && $menu->newtab == 'yes') {
														$args['target'] = '_blank';
												}
												ossn_register_menu_item($menu->menu_type, $args);
								}
						}
				}
		}
		public static function onlyTopLevel() {
				return array(
						'footer',
						'topbar_dropdown'
				);
		}
		public static function ignoreMenus() {
				return array(
						'wall\/container'
				);
		}
		/**
		 * getMenusLevel
		 * There are only two levels,  0 for top menu name,  and 1 for sub menu 
		 *
		 * @param integer $level A level for menu
		 * @param string  $menu  Submenu name
		 *
		 * @return boolean|array
		 */
		public static function getMenusLevel($level = 0, $menu = '') {
				global $Ossn;
				switch ($level) {
						case 0:
								$keys = array_keys($Ossn->menu);
								foreach ($keys as $i => $key) {
										foreach (self::ignoreMenus() as $item) {
												if (preg_match("/{$item}/i", $key)) {
														unset($keys[$i]);
												}
										}
								}
								return $keys;
								break;
						case 1:
								$keys = array_keys($Ossn->menu[$menu]);
								return $keys;
								break;
				}
				return false;
		}
}