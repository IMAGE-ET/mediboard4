<?php
/**
 * $Id: mnt_module_actions.php 24615 2014-09-01 10:52:44Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage developpement
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 24615 $
 */

CCanDo::checkRead();

$locales = CAppUI::flattenCachedLocales(CAppUI::$lang);

$tabs = array();
foreach ($modules = CModule::getInstalled() as $module) {
  CAppUI::requireModuleFile($module->mod_name, "index");
  if (is_array($module->_tabs)) {
    foreach ($module->_tabs as $tab) {
      $tabs[$tab]["name"]   = "mod-$module->mod_name-tab-$tab";
      $tabs[$tab]["locale"] = CValue::read($locales, $tabs[$tab]["name"]);
    }
  }
}

// Cr�ation du template
$smarty = new CSmartyDP();

$smarty->assign("module", $modules);
$smarty->assign("tabs"  , $tabs);

$smarty->display("mnt_module_actions.tpl");
