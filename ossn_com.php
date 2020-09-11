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
define('MenuBuilder', ossn_route()->com . 'MenuBuilder/');
require_once(MenuBuilder . 'classes/MenuBuilder.php');
function menu_builder_init() {
		ossn_register_site_settings_page('menubuilder', 'settings/admin/menubuilder');
		ossn_register_admin_sidemenu('admin:menubuilder', 'admin:menubuilder', ossn_site_url('administrator/settings/menubuilder?mpage=list'), ossn_print('admin:sidemenu:settings'));
		
		ossn_extend_view('css/ossn.default', 'menubuilder/css');
		ossn_extend_view('ossn/site/head', 'menubuilder/css_head');
		ossn_extend_view('css/ossn.admin.default', 'menubuilder/css.admin');
		ossn_extend_view('js/opensource.socialnetwork', 'menubuilder/js.main');
		if (ossn_isAdminLoggedin()) {
				ossn_register_page('menubuilder', 'menubuilder_page_handler');
				ossn_register_action('menubuilder/add', MenuBuilder . 'actions/add.php');
				ossn_register_action('menubuilder/delete', MenuBuilder . 'actions/delete.php');
		}
		
		$menu = new MenuBuilder();
		$menu->buildMenus();
}
function menubuilder_page_handler($pages) {
		if (empty($pages[0])) {
				ossn_error_page();
		}
		switch ($pages[0]) {
				case 'submenu':
						global $Ossn;
						$menu        = new MenuBuilder;
						$type        = input('type');
						$parentMenus = $menu->getMenusLevel(1, $type);
						
						//issues if language is not English #1 find a language string from value,
						//its still not a efficent way...
						$lang = ossn_site_settings('language');
						$locale_string = array_flip($Ossn->localestr[$lang]);
						if($parentMenus && !in_array($type, $menu->onlyTopLevel())) {
								$PMS = array(
										""
								);
								foreach ($parentMenus as $pm) {
										if ($type == 'topbar_admin' && ($pm == 'help' || $pm == 'support' || $pm == 'viewsite' || $pm == 'home')) {
												continue;
										}
										$translit = str_replace(array(
												'_',
												'-',
												'/',
												' ',
										), ':', $pm);
										if($type == 'admin/sidemenu'){
											$PMS[$locale_string[$pm]] = $pm;
										} else {
											$translation = ossn_print("menubuilder:submenu:{$translit}");
											if($translation == "menubuilder:submenu:{$translit}"){
												$PMS[$pm]    = ucfirst($pm);
											} else {
												$PMS[$pm]    = ossn_print("menubuilder:submenu:{$translit}");												
											}
										}
								}
								echo ossn_plugin_view('input/dropdown', array(
										'name' => 'menu_subtype',
										'id' => 'menu-select-subtype',
										'options' => $PMS
								));
						}
						if (in_array($type, $menu->onlyTopLevel())) {
								echo ossn_plugin_view('input/dropdown', array(
										'name' => 'menu_subtype',
										'id' => 'menu-select-subtype',
										'options' => array(
												'__only_top_level__' => ossn_print('menubuilder:main')
										)
								));
						}
						break;
		}
}
function menu_builder_read_icons() {
		$file = MenuBuilder . 'vendors/icons.json';
		if (!$file) {
				return false;
		}
		return json_decode(file_get_contents($file), true);
}
ossn_register_callback('ossn', 'init', 'menu_builder_init');